<?php

namespace RogerioLino\Doctrine\GeoJson;

use Doctrine\ORM\Mapping as ORM;

/**
 * Property
 *
 * @author Rogério Lino <rogeriolino@gmail.com>
 * 
 * @ORM\Entity
 * @ORM\Table(name="geojson_property", uniqueConstraints={@ORM\UniqueConstraint(columns={"feature_id", "name"})})
 */
class Property implements \JsonSerializable
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @var integer
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Feature")
     * @ORM\JoinColumn(name="feature_id", referencedColumnName="id", nullable=false)
     * 
     * @var Feature
     */
    private $feature;
    
    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     * 
     * @var string
     */
    private $name;
    
    /**
     * @ORM\Column(name="value", type="string", length=250, nullable=true)
     * 
     * @var mixed
     */
    private $value;
    
    
    public function getId() {
        return $this->id;
    }

    /**
     * @return Feature
     */
    public function getFeature() {
        return $this->feature;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setFeature(Feature $feature) {
        $this->feature = $feature;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setValue($value) {
        $this->value = $value;
    }
        
    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() {
        return array(
            $this->getName() => $this->getValue()
        );
    }

}
