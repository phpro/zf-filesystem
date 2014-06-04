<?php

namespace Phpro\Filesystem\Hydrator;
use Zend\Stdlib\Exception;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Class Iptc
 *
 * Based on Pear Image_Iptc
 * @link https://github.com/agutoli/Image_Iptc/blob/master/Iptc.php
 */
class IptcHydrator extends ClassMethods
{

    /**
     * @return array
     */
    public static function getFieldMapper()
    {
        // Mapped values:
        $mapper = [
            'object_name' => 5,
            'edit_status' => 7,
            'priority' => 10,
            'category' => 15,
            'supplementary_category' => 20,
            'fixture_identifier' => 22,
            'keywords' => 25,
            'release_date' => 30,
            'release_time' => 35,
            'special_instructions' => 40,
            'reference_date' => 50,
            'created_date' => 55,
            'originating_program' => 65,
            'program_version' => 70,
            'object_cycly' => 75,
            'byline' => 80,
            'byline_title' => 85,
            'city' => 90,
            'province_state' => 95,
            'country_code' => 101,
            'original_transmission_reference' => 103,
            'headline' => 105,
            'credit' => 110,
            'source' => 115,
            'copyright_string' => 116,
            'caption' => 120,
            'local_caption' => 121,
        ];

        // Add values in right syntax: 2#000
        foreach ($mapper as $field => $tag) {
            $mapper[$field] = sprintf('2#%03d', $tag);
        }

        return $mapper;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function mapToIptcTags(array $data)
    {
        $result = [];
        foreach ($this->getFieldMapper() as $readable => $iptc) {
            $result[$iptc] = [null];
            if (isset($data[$readable])) {
                $value = is_array($data[$readable]) ? $data[$readable] : [$data[$readable]];
                $result[$iptc] = $value;
            }
        }
        return $result;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function mapToReadableTags(array $data)
    {
        $result = [];
        foreach ($this->getFieldMapper() as $readable => $iptc) {
            $result[$readable] = null;
            if (isset($data[$iptc])) {
                $value = (count($data[$iptc]) == 1) ? $data[$iptc][0] : $data[$iptc];
                $result[$readable] = $value;
            }
        }
        return $result;
    }

    /**
     * @param object $object
     *
     * @return array
     */
    public function extract($object)
    {
        $data = parent::extract($object);
        $iptcData = $this->mapToIptcTags($data);
        return $iptcData;
    }

    /**
     * @param array  $data
     * @param object $object
     *
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        $readableData = $this->mapToReadableTags($data);
        return parent::hydrate($readableData, $object);
    }

}
