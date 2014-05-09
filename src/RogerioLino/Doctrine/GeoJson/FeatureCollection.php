<?php

namespace RogerioLino\Doctrine\GeoJson;

/**
 * FeatureCollection
 * 
 * @see http://www.geojson.org/geojson-spec.html#feature-collection-objects
 * 
 * @author Rogério Lino <rogeriolino@gmail.com>
 */
class FeatureCollection extends GeoJson implements \Countable, \IteratorAggregate {
    
    /**
     * @var array
     */
    protected $features;
    
    public function __construct($features) 
    {
        $this->setType('FeatureCollection');
        $this->features = $features;
    }
    
    /**
     * @see http://php.net/manual/en/countable.count.php
     */
    public function count()
    {
        return count($this->features);
    }

    /**
     * @return Feature[]
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @see http://php.net/manual/en/iteratoraggregate.getiterator.php
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->features);
    }
   
    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() 
    {
        return array_merge(parent::jsonSerialize(),
            array('features' => array_map(
                function(Feature $feature) { return $feature->jsonSerialize(); },
                $this->features
            ))
        );
    }

}
