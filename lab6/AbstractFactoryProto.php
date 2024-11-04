<?php
// Абстрактні класи продуктів
abstract class Car {
    abstract public function getDetails(): string;
    abstract public function clone(): Car;
}

abstract class Truck {
    abstract public function getDetails(): string;
    abstract public function clone(): Truck;
}

abstract class Bus {
    abstract public function getDetails(): string;
    abstract public function clone(): Bus;
}

// Вітчизняні автомобілі
class UaCar extends Car {
    public function getDetails(): string {
        return "Вітчизняний легковий автомобіль.";
    }

    public function clone(): Car {
        return clone $this;
    }
}

class UaTruck extends Truck {
    public function getDetails(): string {
        return "Вітчизняна вантажівка.";
    }

    public function clone(): Truck {
        return clone $this;
    }
}

class UaBus extends Bus {
    public function getDetails(): string {
        return "Вітчизняний автобус.";
    }

    public function clone(): Bus {
        return clone $this;
    }
}

// Зарубіжні автомобілі
class ForeignCar extends Car {
    public function getDetails(): string {
        return "Зарубіжний легковий автомобіль.";
    }

    public function clone(): Car {
        return clone $this;
    }
}

class ForeignTruck extends Truck {
    public function getDetails(): string {
        return "Зарубіжна вантажівка.";
    }

    public function clone(): Truck {
        return clone $this;
    }
}

class ForeignBus extends Bus {
    public function getDetails(): string {
        return "Зарубіжний автобус.";
    }

    public function clone(): Bus {
        return clone $this;
    }
}

// Абстрактна фабрика і реалізація для різних продуктів
abstract class AbstractFactory {
    abstract public function createCar(): Car;
    abstract public function createTruck(): Truck;
    abstract public function createBus(): Bus;
}

class UaFactory extends AbstractFactory {
    public function createCar(): Car {
        return new UaCar();
    }

    public function createTruck(): Truck {
        return new UaTruck();
    }

    public function createBus(): Bus {
        return new UaBus();
    }
}

class ForeignFactory extends AbstractFactory {
    public function createCar(): Car {
        return new ForeignCar();
    }

    public function createTruck(): Truck {
        return new ForeignTruck();
    }

    public function createBus(): Bus {
        return new ForeignBus();
    }
}

function createCarPark($config) {
    $factory = null;

    switch ($config['factory']) {
        case 'ua':
            $factory = new UaFactory();
            break;
        case 'foreign':
            $factory = new ForeignFactory();
            break;
        default:
            throw new Exception("Невідома фабрика: " . $config['factory']);
    }

    $carPark = [];
    
    // Використовуємо прототипи для створення автомобілів
    for ($i = 0; $i < $config['carNum']; $i++) {
        $carPark[] = $factory->createCar()->clone();
    }
    for ($i = 0; $i < $config['truckNum']; $i++) {
        $carPark[] = $factory->createTruck()->clone();
    }
    for ($i = 0; $i < $config['busNum']; $i++) {
        $carPark[] = $factory->createBus()->clone();
    }

    return $carPark;
}

// Приклад конфігурації
$config = [
    'factory' => 'ua',
    'carNum' => 10,
    'truckNum' => 2,
    'busNum' => 4
];

// Створення парку автомобілів
$carPark = createCarPark($config);

// Виведення деталей автомобілів
foreach ($carPark as $vehicle) {
    echo $vehicle->getDetails() . "\n";
}
?>