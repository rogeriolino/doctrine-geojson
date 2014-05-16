<?php

namespace RogerioLino\Doctrine\GeoJson;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Feature
 *
 * @author Rogério Lino <rogeriolino@gmail.com>
 * 
 * @ORM\Entity
 * @ORM\Table(name="geojson_feature")
 */
class Feature extends GeoJson
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @var integer
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Geometry", cascade={"all"})
     * @ORM\JoinColumn(name="geometry_id", referencedColumnName="id", nullable=false)
     * @var Geometry
     */
    private $geometry;
    
    /**
     * @ORM\OneToMany(targetEntity="Property", mappedBy="feature", cascade={"all"}, orphanRemoval=true)
     * @var Property[]
     */
    private $properties;
    
    
    public function __construct() {
        parent::__construct('Feature');
        $this->properties = new ArrayCollection();
    }
    
    public function getId() 
    {
        return $this->id;
    }

    /**
     * @return Geometry
     */
    public function getGeometry() 
    {
        return $this->geometry;
    }

    /**
     * @return Property[]
     */
    public function getProperties() 
    {
        return $this->properties;
    }
    
    public function setId($id) 
    {
        $this->id = $id;
    }

    public function setGeometry(Geometry $geometry) 
    {
        $this->geometry = $geometry;
    }

    public function setProperties($properties) 
    {
        $this->properties = $properties;
    }

    public function add(Property $property) 
    {
        $property->setFeature($this);
        $this->properties[] = $property;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() 
    {
        $props = array();
        foreach ($this->getProperties() as $property) {
            $props[$property->getName()] = $property->getValue();
        }
        return array_merge(parent::jsonSerialize(), array(
            "id" => $this->getId(),
            "geometry" => $this->getGeometry() ? $this->getGeometry()->jsonSerialize() : null,
            "properties" => $props,
        ));
    }

}
