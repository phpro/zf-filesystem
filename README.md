# zf-filesystem

This module contains of:
 
- a wrapper for filesystem actions
- a wrapper for files with specific features
- a metadata layer which makes it possible to query for specific file metadata like IPTC, EXIF, XMP, ...

# Installation
## Add to composer.json
```
"phpro/zf-filesystem": "~0.2.0"
```

## Add to application config
```php
return array(
    'modules' => array(
        'Phpro\\Filesystem',
        // other libs...
    ),
    // Other config
);
```

## Configuration
Copy the file `config/phpro_filesystem.local.php.dist` to the autoload folder of your application.

## Configuration options:
*Exiftool*
- executable: The location of exiftool on your machine
- allowed_tags: The tags that can be queried with exiftool. This list is automatically generated, but could be manually overwritten. Check `config/exiftool-tags.php` for a full list.

# Features

## Filesystem wrapper
This module adds the Symfony Filesystem component to the ZF2 servicemanager.
By using the `FilesystemAwareInterface`, the filesystem component is automatically added to your objects by the serviceManager.

## File wrapper
By implementing the `FileInterface` it is easy and straight forward to pass file objects to custom objects and services in your application.
There are already 2 implementations available:

- LocalFile
- UploadedFile

It is possible to apply certain features to these file objects. For example:

- Moveable


## Metadata
This module provides some tools to query for metadata on a file.
Following metadata providers are available:

*General*
- Md5

*Images*
- ExifTool
- Identify
- ImageInfo

### Md5:
The MD5 metadata tool provides the MD5 hash of a file and is a wrapper for the php `md5_file()` command..

Usage:
```php
$md5 = $serviceLocator->get('Phpro\Filesystem\Metadata\Md5');
$hash = $md5->getMetadataForFile($file, []);
```

### ExifTool
The ExifTool metadata tool provides a wrapper for the `exiftool` command.
It is possible to return all data or specify a specific tag.

Usage:
```
$exiftool = $serviceLocator->get('Phpro\Filesystem\Metadata\Image\ExifTool');
$meta = $exiftool->getMetadataForFile($file, []);
$meta = $exiftool->getMetadataForFile($file, ['tag' => 'exif']);
$meta = $exiftool->getMetadataForFile($file, ['tag' => 'iptc']);
$meta = $exiftool->getMetadataForFile($file, ['tag' => 'xmp']);
```

### Identify
The Identify metadata tool provides a wrapper for the `identify` command of `ImageMagick`.
It is possible to ask for the regular information or some extended configurations.
Extended configuration consist of:

- spotColors


Usage:
```
$identify = $serviceLocator->get('Phpro\Filesystem\Metadata\Image\Identify');
$meta = $identify->getMetadataForFile($file, []);
$meta = $identify->getMetadataForFile($file, ['extended' => true]);
```

### ImageInfo
The ExifTool metadata tool provides a wrapper for the php `getImageSize()` command.
It is possible to return the regular data or the regular + extended data:

Usage:
```
$imageInfo = $serviceLocator->get('Phpro\Filesystem\Metadata\Image\ImageInfo');
$meta = $imageInfo->getMetadataForFile($file, []);
$meta = $imageInfo->getMetadataForFile($file, ['extended' => true]);
```
