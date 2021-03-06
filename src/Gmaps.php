<?php

namespace Datalaere\PHPApi;

class Gmaps
{
    private $api;
    private $center;
    private $zoom;
    private $marker;
    private $listener = array();
    private $position = array();
    private $map;

    public function setApi($params = '')
    {
        $this->api = "<script src='https://maps.googleapis.com/maps/api/js" . $params . "' ></script>";
    }

    public function startScript()
    {
        echo "<script>";
    }

    public function endScript()
    {
        echo "</script>";
    }

    public function setCenter($lat, $lng)
    {
        $this->center = "{lat: $lat, lng: $lng}";
    }

    public function setZoom($zoom = 10)
    {
        $this->zoom = $zoom;
    }

    public function setPosition($name, $lat, $lng)
    {
        $this->position = array_merge($this->position, array($name => "{lat: $lat, lng: $lng}"));
    }

    public function setFunction($name, $param, $code)
    {
        $function = <<<FUNCTION
      function $name($param){
       $code          
      }
FUNCTION;
        return $function;
    }

    public function setListener($name, $postition, $function, $callback = 'click')
    {
        $listener       = <<<Listener
     $name.addListener('$callback', function () {
            $function($position);
        });    
Listener;
        $this->listener = array_merge($this->listener, $listener);
    }

    public function setMarker($title, $name)
    {
        $position       = $this->position[$name];
        $marker         = <<<MARKER
            var $name = new google.maps.Marker({
            position: $position,
            map: map,
            title: '$title'
        });    
MARKER;
        $this->marker[] = $marker;
    }

    public function setMap($element_id = 'map')
    {
        $map       = <<<MAP
            var map = new google.maps.Map(document.getElementById('$element_id'), {
            zoom: $this->zoom,
            center: $this->center
        });       
MAP;
        $this->map = $map;
    }

    public function initMap($extra = '')
    {
        echo $this->api;
        $this->startScript();
        echo $this->map;
        foreach ($this->marker as $marker) {
            echo $marker;
        }
        echo $extra;
        $this->endScript();
    }
}
