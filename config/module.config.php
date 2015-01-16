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
        'initializers' => [
            'Phpro\Filesystem\Initializer\Filesystem' => 'Phpro\Filesystem\Initializer\Filesystem',
        ],
    ],

    'phpro_filesystem' => [
        'exiftool' => [
            'executable' => '/usr/bin/exiftool',
            'allowed_tags' => require_once(__DIR__ . '/exiftool-tags.php'),
        ],
    ],

);