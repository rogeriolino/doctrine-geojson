# doctrine-geojson

GeoJson Doctrine Models


## Requirements


* PHP 5.4+
* Doctrine 2.4+


## Usage

### Saving

```php
  <?php
  
  $feature = new Feature();
  $feature->add(new Property('name', 'Rogerio Lino'));
  $feature->setGeometry(
    (new Geometry('Point'))
      ->add(new Coordinate(-40, -20, 0))
  );
  
  $entityManager->persist($feature);
  $entityManager->flush();
```

### Retrieving

```php
  <?php

  $features = $entityManager
                    ->getRepository('RogerioLino\Doctrine\GeoJson\Feature')
                    ->findAll();
  echo json_encode(new FeatureCollection($features));
```
    
JSON Output

```json
  {
    "type": "FeatureCollection",
    "features": [
        {
            "type": "Feature",
            "geometry": {
                "type": "Point",
                "coordinates": [
                    -40,
                    -20,
                    0
                ]
            },
            "properties": {
                "name": "Rogerio Lino"
            }
        }
    ]
  }
```    
