<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../src/Gmaps';

use thom855j\PHPApi\Gmaps;

$map = new Gmaps;

$map->setApi();
$map->setCenter(55.883313, 10.6045166);
$map->setZoom(12);


$map->setPosition('norby', 55.9636029, 10.5524741);
$map->setMarker('Norby', 'norby');

$map->setPosition('holm', 55.8977200, 10.6129690);
$map->setMarker('Holm', 'holm');

$map->setMap('map');
$map->initMap();
?>
<style>
    #map{
        height: 100%;
        width: 100%;
    }

</style>
<div id="map"></div>
