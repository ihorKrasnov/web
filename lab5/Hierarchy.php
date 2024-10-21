<?php
class Vehicle {
    protected $country;
    protected $brand;
    protected $year;

    public function __construct($country, $brand, $year) {
        $this->country = $country;
        $this->brand = $brand;
        $this->year = $year;
    }
}
class Car extends Vehicle {
    private $engine;
    private $power;
    private $color;

    public function __construct($country, $brand, $year, $engine, $power, $color) {
        parent::__construct($country, $brand, $year);
        $this->engine = $engine;
        $this->power = $power;
        $this->color = $color;
    }

    public function getDetails() {
        return "Car: {$this->brand}, {$this->year}, {$this->engine}, {$this->power} HP, Color: {$this->color}";
    }
}
class Bike extends Vehicle {
    private $weight;
    private $type;
    private $wheelDiameter;

    public function __construct($country, $brand, $year, $weight, $type, $wheelDiameter) {
        parent::__construct($country, $brand, $year);
        $this->weight = $weight;
        $this->type = $type;
        $this->wheelDiameter = $wheelDiameter;
    }

    public function getDetails() {
        return "Bike: {$this->brand}, {$this->year}, Weight: {$this->weight} kg, Type: {$this->type}, Wheel Diameter: {$this->wheelDiameter} inches";
    }
}
class Motorcycle extends Vehicle {
    private $engine;
    private $color;
    private $type;

    public function __construct($country, $brand, $year, $engine, $color, $type) {
        parent::__construct($country, $brand, $year);
        $this->engine = $engine;
        $this->color = $color;
        $this->type = $type;
    }

    public function getDetails() {
        return "Motorcycle: {$this->brand}, {$this->year}, {$this->engine}, Color: {$this->color}, Type: {$this->type}";
    }
}

class VehicleFactory {
    public static function create($type, $country, $brand, $year, ...$params) {
        switch (strtolower($type)) {
            case 'car':
                return new Car($country, $brand, $year, ...$params);
            case 'bike':
                return new Bike($country, $brand, $year, ...$params);
            case 'motorcycle':
                return new Motorcycle($country, $brand, $year, ...$params);
            default:
                return "Фабрика не може створити транспортний засіб типу: {$type}";
        }
    }
}

// Створюємо екземпляри
$car = VehicleFactory::create('car', 'USA', 'Ford', 2020, 'V8', 450, 'Red');
$bike = VehicleFactory::create('bike', 'Germany', 'Trek', 2021, 10, 'Mountain', 29);
$motorcycle = VehicleFactory::create('motorcycle', 'Japan', 'Yamaha', 2019, '600cc', 'Blue', 'Sport');
$unknown = VehicleFactory::create('plane', 'USA', 'Boeing', 2022); // Невідомий тип

// Виводимо деталі
echo $car->getDetails() . "\n";
echo $bike->getDetails() . "\n";
echo $motorcycle->getDetails() . "\n";
echo $unknown . "\n"; // Повідомлення про невідомий тип

?>
