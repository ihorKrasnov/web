<?php
    abstract class Figure {
        //Метод знаходження площі
        abstract public function area();
    }

    class Circle extends Figure {
        private $radius;

        public function __construct($radius) {
            $this->radius = $radius;
        }
        //Перевизначення абстрактного методу знаходження площі для похідного класу Circle
        public function area() {
            return pi() * pow($this->radius, 2);
        }
    }

    class Rectangle extends Figure {
        private $width;
        private $height;

        public function __construct($width, $height) {
            $this->width = $width;
            $this->height = $height;
        }
        //Перевизначення абстрактного методу знаходження площі для похідного класу Rectangle
        public function area() {
            return $this->width * $this->height;
        }
    }

    //Приклад роботи
    $circle = new Circle(5);
    echo "Площа кола: " . $circle->area() . "\n"; // Площа кола

    $rectangle = new Rectangle(4, 6);
    echo "Площа прямокутника: " . $rectangle->area() . "\n"; // Площа прямокутника
?>