<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Adteam\Core\Admin\Checkout\Repository;

use Doctrine\ORM\EntityRepository;
use Adteam\Core\Admin\Checkout\Entity\CoreConfigs;
use Adteam\Core\Admin\Checkout\Entity\OauthUsers;
use Adteam\Core\Admin\Checkout\Entity\CoreCheckoutActivationLog;

class CoreCheckoutActivationLogRepository extends EntityRepository
{
    /**
     * Fetch all config values
     *
     * @return array
     */
    public function fetchLast()
    {
        $config = $this->_em->getRepository(CoreConfigs::class)->getCheckoutRange();

        $currentTime = time();
        $rangeStart = isset($config['checkout.date.start']) ? (int)$config['checkout.date.start'] : 0;
        $rangeEnd = isset($config['checkout.date.end']) ? (int)$config['checkout.date.end'] : 0;

        $checkoutIsActive = $rangeStart <= $currentTime && $currentTime <= $rangeEnd;

        $checkout['version'] = '1';
        $checkout['enabled'] = $checkoutIsActive;
        $checkout['dateStart'] = $rangeStart;
        $checkout['dateEnd'] = $rangeEnd;

        return $checkout;
    }

    /**
     * verifica si esta vacio log
     *
     * @return boolean
     */
    private function hasInit()
    {
        $isInit = false;
        $result = $this->createQueryBuilder('B')
            ->select("B.id, B.createdAt, R.id as userId, R.displayName, B.status")
            ->innerJoin('B.requestedBy', 'R')
            ->getQuery()->getResult();
        if (count($result) <= 0) {
            $isInit = true;
        }
        return $isInit;

    }

    /**
     * @param object $data
     * @param string $identity
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function create($data, $identity)
    {
        $user = $this->getUserByUsername($identity['user_id']);

        // Obtener los parámetros
        $dateStart = property_exists($data, 'date.start') ? $data->{"date.start"} : null;
        $dateEnd = property_exists($data, 'date.end') ? $data->{"date.end"} : null;

        // Al menos un parámetro debe existir
        if (is_null($dateStart) && is_null($dateEnd)) {
            throw new \InvalidArgumentException('Missing_Arguments');
        }

        // Validar rangos correctos
        if (!is_null($dateStart) && !is_null($dateEnd) && (int)$dateStart >= (int)$dateEnd) {
            throw new \InvalidArgumentException('Invalid_Range');
        }

        $currentTime = time();

        // Colocar rangos que vienen nulos
        $dateStart = is_null($dateStart) ? 0 : $dateStart;
        $dateEnd = is_null($dateEnd) ? (pow(2, 32) - 1) : $dateEnd;

        // Determinar si el canje será activado (dateStart enviado y fecha actual mayor o igual a fecha de canje)
        $enabled = !is_null($dateStart) && $currentTime >= $dateStart;
        $enabled = $enabled && (is_null($dateEnd) ? true : $currentTime < $dateEnd);

        return $this->insertLog($user, $dateStart, $dateEnd);
    }

    /**
     * Obtiene usuario mediante username
     *
     * @param string $username
     * @return array|mixed
     */
    public function getUserByUsername($username)
    {
        return $this->_em->getRepository(OauthUsers::class)
            ->createQueryBuilder('U')
            ->select('U.id,U.displayName')
            ->where('U.username = :username')
            ->setParameter('username', $username)
            ->getQuery()->getSingleResult();
    }

    /**
     * Inserta log de apertura y cierre
     * de canje
     *
     * @param string $user
     * @param int $dateStart
     * @param int $dateEnd
     */
    public function insertLog($user, $dateStart = null, $dateEnd = null)
    {
        $currentRepo = $this;
        return $this->_em->transactional(
            function ($em) use ($dateStart, $dateEnd, $user, $currentRepo) {
                $log = new CoreCheckoutActivationLog();
                $UserReference = $em->getReference(OauthUsers::class, $user['id']);

                $status = (!is_null($dateStart) || $dateStart <= time())
                    && (!is_null($dateEnd) || time() < $dateEnd);

                $log->setRequestedBy($UserReference);
                $log->setStatus($status);
                $em->persist($log);
                $currentRepo->updateCheckoutEnabled($dateStart, $dateEnd);

                return $status;
            }
        );
    }

    /**
     * update estatus core config
     *
     * @param int $dateStart
     * @param int $dateEnd
     * @return array|mixed
     */
    private function updateCheckoutEnabled($dateStart, $dateEnd)
    {
        if (!is_null($dateStart)) {
            $dql = "UPDATE Adteam\Core\Checkout\Entity\CoreConfigs U SET U.value = "
                . $dateStart . " WHERE U.key like 'checkout.date.start'";
            $this->_em->createQuery($dql)->execute();
        }

        if (!is_null($dateEnd)) {
            $dql = "UPDATE Adteam\Core\Checkout\Entity\CoreConfigs U SET U.value = "
                . $dateEnd . " WHERE U.key like 'checkout.date.end'";
            $this->_em->createQuery($dql)->execute();
        }
    }
}