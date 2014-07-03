<?php

namespace Phpro\Filesystem\File;
use Phpro\Filesystem\File\Feature\Moveable;
use Zend\Stdlib\ArraySerializableInterface;
use Zend\Stdlib\Hydrator;

/**
 * Class UploadedFile
 * Note: this is not a doctrine Entity, but an entity used to handle uploaded files with code completion etc.
 *
 * @package Filesystem\Entity
 */
class UploadedFile
    implements
    ArraySerializableInterface,
    Moveable,
    FileInterface
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $tmpName;

    /**
     * @var string
     */
    protected $error;

    /**
     * @var int
     */
    protected $size;

    /**
     * This constructor will hydrate itself using the $_FILES data.
     *
     * @param array $fileData
     */
    public function __construct($fileData)
    {
        $this->exchangeArray($fileData);
    }

    /**
     * @param string $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $tmpName
     */
    public function setTmpName($tmpName)
    {
        $this->tmpName = $tmpName;
    }

    /**
     * @return string
     */
    public function getTmpName()
    {
        return $this->tmpName;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->getTmpName();
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Exchange internal values from provided array
     *
     * @param  array $array
     *
     * @return void
     */
    public function exchangeArray(array $array)
    {
        $hydrator = new Hydrator\ClassMethods();
        $hydrator->hydrate($array, $this);
    }

    /**
     * Return an array representation of the object
     * Do not use ClassMethods hydrator here: this will create a loop because of GET-ArrayCopy
     * TODO: use better extrator
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'name' => $this->getName(),
            'tmp_name' => $this->getTmpName(),
            'type' => $this->getType(),
            'error' => $this->getError(),
            'size' => $this->getSize(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function move($targetPath)
    {
        $this->tmpName = $targetPath;
    }

}
