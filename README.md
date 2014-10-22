BingMapsImageryBundle
=====================

Symfony2 bundle to use Bing Maps Imagery API REST

Installation
------------
### Step 1: Download it using composer

Add BingMapsImageryBundle by running the command:

``` bash
$ php composer.phar require carlosromero/BingMapsImageryBundle
```

Composer will install the bundle to your project's `vendor/carlosromero` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Carlosromero\BingMapsImageryBundle\CarlosromeroBingMapsImageryBundle(),
    );
}
```
### Step 3: Configure the bundle

``` yaml
# app/config/config.yml
carlosromero:
    bing_maps_imagery:
        key: your_key

        #optionals
        map_type: [Aerial|AerialWithLabels|Road|OrdnanceSurvey|CollinsBart]   #Imagery set
        base_url: http://dev.virtualearth.net/REST/V1/Imagery/Map/%MAP_TYPE%/%QUERY%?key=%APIKEY%&mapSize=%WIDTH%,%HEIGHT%   #alternative url to api with placeholders

```


Use
------------

### Description

``` php
mixed function query (string $term[, integer $width[, integer $height[,array $options]]])
```

### Parameters

$term The words we want to search

$width Width of the image in pixels

$height Height of the image in pixels

$options Array with optional parameters for the API query, see http://msdn.microsoft.com/en-us/library/ff701724.aspx


### Return values

String with binary data of image file or false if API returns errors


``` php
 if ($mapImage = $this->get('carlosromero_bing_maps_imagery.api_client')->query('Torre Eiffel', 600, 500, array('mapLayer'=>'TrafficFlow'))) {
   $dir = __DIR__ . '/../../../../web';
   $pathname = '/img/maps/'.uniqid().'.jpg';
   file_put_contents($dir.$pathname, $mapImage);
   echo "<img src=\"$pathname\" />";
}
```


License
-------

This bundle is under the MIT license. See the complete license in the bundle:

    Resources/meta/LICENSE

Reporting an issue or a feature request
---------------------------------------

Issues and feature requests are tracked in the [Github issue tracker](https://github.com/carlosromero/BingMapsImageryBundle/issues).

When reporting a bug, it may be a good idea to reproduce it in a basic project
built using the [Symfony Standard Edition](https://github.com/symfony/symfony-standard)
to allow developers of the bundle to reproduce the issue by simply cloning it
and following some steps.