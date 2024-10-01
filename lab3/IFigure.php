<?php
    interface IFigure {
        public function draw();
        public function erase();
    }

    class Circle implements IFigure {
        public function draw() {
            echo "Drawing a Circle.\n";
        }
    
        public function erase() {
            echo "Erasing the Circle.\n";
        }
    }

    class Square implements IFigure {
        public function draw() {
            echo "Drawing a Square.\n";
        }
    
        public function erase() {
            echo "Erasing the Square.\n";
        }
    }

    class Triangle implements IFigure {
        public function draw() {
            echo "Drawing a Triangle.\n";
        }
    
        public function erase() {
            echo "Erasing the Triangle.\n";
        }
    }

    // Приклад роботи
    $shapes = [
        new Circle(),
        new Square(),
        new Triangle()
    ];

    foreach ($shapes as $shape) {
        $shape->draw();
        $shape->erase();
    }
?>