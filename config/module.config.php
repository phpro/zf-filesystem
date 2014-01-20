<?php
return array(

    'service_manager' => [
        'invokables' => [
            'Symfony\Component\Filesystem\Filesystem' => 'Symfony\Component\Filesystem\Filesystem',

            'Phpro\Filesystem\Service\ExifService' => 'Phpro\Filesystem\Service\ExifService',
            'Phpro\Filesystem\Service\ImageInfoService' => 'Phpro\Filesystem\Service\ImageInfoService',
            'Phpro\Filesystem\Service\Md5Service' => 'Phpro\Filesystem\Service\Md5Service',
        ],
        'factories' => [
            'Phpro\Filesystem\Service\IptcService' => 'Phpro\Filesystem\Service\IptcService',
        ],
    ],

);