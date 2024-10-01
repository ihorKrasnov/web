<?php

    abstract class ShowInfoMessage {
        // Абстрактний метод для виведення інформаційного повідомлення
        abstract public function showInfoMessage();
    }

    abstract class Point extends ShowInfoMessage {
        protected $x; // Координата X
        protected $y; // Координата Y

        public function __construct($x, $y) {
            $this->x = $x; // Ініціалізація координати X
            $this->y = $y; // Ініціалізація координати Y
        }

        // Метод для отримання значення координати X
        public function getX() {
            return $this->x;
        }

        // Метод для отримання значення координати Y
        public function getY() {
            return $this->y;
        }

        abstract public function getPointCoordinate();
    }

    class ColorPoint extends Point {
        private $color; // Колір точки
        private $createdAt; // Дата створення точки

        public function __construct($x, $y, $color) {
            parent::__construct($x, $y); // Виклик конструктора батьківського класу
            $this->color = $color; // Ініціалізація кольору
            $this->createdAt = new DateTime(); // Збереження дати створення
        }

        // Метод для отримання кольору
        public function getColor() {
            return $this->color;
        }

        // Метод для отримання дати створення у форматі рядка
        public function getCreatedAtDate(): string {
            return $this->createdAt->format('Y-m-d H:i:s');
        }

        // Метод для виведення значень полів класу на екран
        // реалізація абстрактного методу класу ShowInfoMessage
        public function showInfoMessage(): void {
            echo $this->formMessage();
        }

        // Метод для виведення координат точки
        // реалізація абстрактного методу класу Point
        public function getPointCoordinate() {
                echo $this->x . " ; " . $this->y . "\n";
        }

        // Приватний метод для формування повідомлення
        protected function formMessage(): string {
            return "X: " . $this->getX() . 
                ", Y: " . $this->getY() . 
                ", Color: " . $this->getColor() . 
                ", Created At: " . $this->getCreatedAtDate() . "\n";
        }
    }

    // Приклад використання класу массив що складається з об'єктів класу
    $listOfPoints=array();
    $listOfPoints[0] = new ColorPoint(10, 20, 'Red');
    $listOfPoints[1] = new ColorPoint(0, 10, 'Blue');

    
    for ($i = 0; $i < count($listOfPoints); $i++) {
        $listOfPoints[$i]->showInfoMessage();
        $listOfPoints[$i]->getPointCoordinate(); 
    }
?>