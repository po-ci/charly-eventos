<?php

return array(
    'doctrine' => array(
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'user' => 'eventos',
                    'password' => '123eventos',
                    'dbname' => 'db_eventos',
                )
            ), 
          
        ),

        'eventmanager' => array(
            'orm_default' => array(
                'subscribers' => array(
                    // pick any listeners you need
                    'Gedmo\Timestampable\TimestampableListener',

                ),
            ),
        ),
    )
);
