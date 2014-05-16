<?php

namespace RogerioLino\Doctrine\GeoJson;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Geometry
 *
 * @author Rogério Lino <rogeriolino@gmail.com>
 * 
 * @ORM\Entity
 * @ORM\Table(name="geojson_geometry")
 */
class Geometry extends GeoJson
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @var integer
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Coordinate", mappedBy="geometry", cascade={"all"}, orphanRemoval=true)
     * @var Coordinate[]
     */
    private $coordinates;
    
    public function __construct($type) {
        parent::__construct($type);
        $this->coordinates = new ArrayCollection();
    }

    public function getId() 
    {
        return $this->id;
    }

    /**
     * @return Coordinate[]
     */
    public function getCoordinates() 
    {
        return $this->coordinates;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCoordinates($coordinates) 
    {
        $this->coordinates = $coordinates;
    }
    
    public function add(Coordinate $coordinate) 
    {
        $coordinate->setGeometry($this);
        $this->coordinates[] = $coordinate;
    }
    
    /**
     * {@inheritdoc}
     * @see http://php.net/manual/en/jsonserializable.jsonserialize.php
     */
    public function jsonSerialize() 
    {
        $coords = array();
        switch ($this->getType()) {
            case 'Point';
                if (sizeof($this->getCoordinates())) {
                    $coords = $this->getCoordinates()[0]->jsonSerialize();
                }
                break;
            default:
                foreach ($this->getCoordinates() as $coordinate) {
                    $coords[] = $coordinate->jsonSerialize();
                }
                break;
        }
        return array_merge(parent::jsonSerialize(), array(
            "coordinates" => $coords
        ));
    }

}
