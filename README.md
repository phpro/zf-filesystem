# zf-filesystem
This module adds the Symfony Filesystem component to the ZF2 servicemanager.
By using the `FilesystemAwareInterface`, the filesystem component is automatically added to your objects by the serviceManager.

It contains following features:
- Symfony Filesystem component
- Lookup cache provider
- Exif service
- getimagesize() service
- IPTC service
- MD5 fuke service
- FileUpload class