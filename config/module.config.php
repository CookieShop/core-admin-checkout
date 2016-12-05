<?php
$path=  realpath((__DIR__).'/../').'/src/';

return [
    'adteam_core_admin_checkout'=>[
        'test'=>$path
    ],
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'charset' => 'utf8',
                ],
            ],
        ],
        'driver' => [
            'Doctrine_driver_admin_checkout' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    0 => $path.'/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Adteam\\Core\\Admin\\Checkout' => 'Doctrine_driver_admin_checkout',
                ],
            ],
        ],
    ],  
    'configuration' => [
        'orm_default' => [
            'datetime_functions' => [
                'DATE_FORMAT' => 'Adteam\Core\Admin\Checkout\Functionsmysql\DateFormat'
            ],
        ],
    ],    
];
