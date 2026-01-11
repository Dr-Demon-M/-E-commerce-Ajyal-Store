<?php

class Engine {
    // Engine implementation
}

class Car {
    protected $engine;

    public function __construct(Engine $engine) {
        $this->engine = $engine;
    }
}

// Resolve Car via Laravel's service container
$car = app()->make(Car::class);

// Use $car object
var_dump($car);
