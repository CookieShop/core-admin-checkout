<?php

namespace Adteam\Core\Admin\Checkout\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthAccessTokens
 *
 * @ORM\Table(name="oauth_access_tokens")
 * @ORM\Entity
 */
class OauthAccessTokens
{
    /**
     * @var string
     *
     * @ORM\Column(name="access_token", type="string", length=40, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $accessToken;

    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $expires;

    /**
     * @var string
     *
     * @ORM\Column(name="scope", type="string", length=2000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $scope;


    /**
     * Get accessToken
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set clientId
     *
     * @param string $clientId
     *
     * @return OauthAccessTokens
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set userId
     *
     * @param string $userId
     *
     * @return OauthAccessTokens
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set expires
     *
     * @param \DateTime $expires
     *
     * @return OauthAccessTokens
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set scope
     *
     * @param string $scope
     *
     * @return OauthAccessTokens
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope
     *
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }
}

