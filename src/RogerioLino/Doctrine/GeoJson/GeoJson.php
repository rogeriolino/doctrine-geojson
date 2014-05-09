<?php

namespace RogerioLino\Doctrine\GeoJson;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoJson
 * 
 * @see http://geojson.org/geojson-spec.html#geojson-objects
 *
 * @author Rogério Lino <rogeriolino@gmail.com>
 * 
 * @ORM\MappedSuperclass
 */
abstract class GeoJson implements \JsonSerializable
{
    
    /**
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     * @var string
     */
    private $type;
    
    public function getType() 
    {
        return $this->type;
    }

    public function setType($type) 
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     * @see http://php.net/manual/en/jsonserializable.jsonserialize.php
     */
    public function jsonSerialize() 
    {
        return array(
            "type" => $this->getType()
        );
    }

}
