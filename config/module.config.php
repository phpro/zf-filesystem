<?php
return array(

    'service_manager' => [
        'invokables' => [
            'Symfony\Component\Filesystem\Filesystem' => 'Symfony\Component\Filesystem\Filesystem',
        ],
        'factories' => [
            'Phpro\Filesystem\Metadata\Image\ExifTool' => 'Phpro\Filesystem\Factory\MetadataExifToolFactory',
            'Phpro\Filesystem\Metadata\Image\Identify' => 'Phpro\Filesystem\Factory\MetadataIdentifyFactory',
            'Phpro\Filesystem\Metadata\Image\ImageInfo' => 'Phpro\Filesystem\Factory\MetadataImageInfoFactory',
            'Phpro\Filesystem\Metadata\Md5' => 'Phpro\Filesystem\Factory\MetadataMd5Factory',
            'Phpro\Filesystem\Options\ExifToolOptions' => 'Phpro\Filesystem\Factory\ExifToolOptionsFactory',
            'Phpro\Filesystem\Process\ExifTool' => 'Phpro\Filesystem\Factory\ExifToolProcessFactory',
        ],
        'initializers' => [
            'Phpro\Filesystem\Initializer\Filesystem' => 'Phpro\Filesystem\Initializer\Filesystem',
        ],
        'aliases' => [
            'Filesystem' => 'Symfony\Component\Filesystem\Filesystem',
        ],
    ],

    'phpro_filesystem' => [
        'exiftool' => [
            'executable' => '/usr/bin/exiftool',
            'allowed_tags' => require_once(__DIR__ . '/exiftool-tags.php'),
        ],
    ],

);