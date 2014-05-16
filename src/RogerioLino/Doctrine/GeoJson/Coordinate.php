<?php

namespace RogerioLino\Doctrine\GeoJson;

use Doctrine\ORM\Mapping as ORM;

/**
 * Property
 *
 * @author Rogério Lino <rogeriolino@gmail.com>
 * 
 * @ORM\Entity
 * @ORM\Table(name="geojson_coordinate")
 */
class Coordinate implements \JsonSerializable
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @var integer
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Geometry")
     * @ORM\JoinColumn(name="geometry_id", referencedColumnName="id", nullable=false)
     * @var Geometry
     */
    private $geometry;
    
    /**
     * @ORM\Column(name="latitude", type="decimal", scale=12, precision=18, nullable=false)
     * @var float
     */
    private $latitude;
    
    /**
     * @ORM\Column(name="longitude", type="decimal", scale=12, precision=18, nullable=false)
     * @var float
     */
    private $longitude;
    
    /**
     * @ORM\Column(name="altitude", type="decimal", scale=12, precision=18, nullable=false)
     * @var float
     */
    private $altitude = 0;
    
    function __construct($latitude = 0, $longitude = 0, $altitude = 0) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->altitude = $altitude;
    }

        
    public function getId() {
        return $this->id;
    }
        
    /**
     * @return Geometry
     */
    public function getGeometry() 
    {
        return $this->geometry;
    }

    public function getLatitude() 
    {
        return $this->latitude;
    }

    public function getLongitude() 
    {
        return $this->longitude;
    }

    public function getAltitude() 
    {
        return $this->altitude;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setGeometry(Geometry $geometry) 
    {
        $this->geometry = $geometry;
    }

    public function setLatitude($latitude) 
    {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude) 
    {
        $this->longitude = $longitude;
    }

    public function setAltitude($altitude) 
    {
        $this->altitude = $altitude;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() 
    {
        return array(
            (float) $this->getLongitude(), 
            (float) $this->getLatitude(), 
            (float) $this->getAltitude()
        );
    }

}
