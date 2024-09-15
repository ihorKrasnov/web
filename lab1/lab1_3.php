<?php
    class ColorPoint {
        public $x;
        public $y;
        public $color;

        private $createdAt;

        public function __construct() {
            $this->createdAt = new DateTime();
        }

        // Метод для встановлення значень полів класу
        public function set($x, $y, $color): void {
            $this->x = $x;
            $this->y = $y;
            $this->color = $color;
        }

        // Метод для отримання значення полів класу
        public function get(): array {
            return [
                'x' => $this->x,
                'y' => $this->y,
                'color' => $this->color,
                'createdAt' => $this->createdAt->format('Y-m-d H:i:s')
            ];
        }

        //Приклад інкапсуляції
        public function getCreatedAtDate(): string {
            return $this->createdAt->format('Y-m-d H:i:s');
        }

        // Метод для виведення значень полів класу на екран
        public function show(): void {
            echo $this->formMessage();
        }

        // Метод для пошуку за одним із полів класу
        public function search($searchValue): bool {
            if ($this->x == $searchValue || $this->y == $searchValue || $this->color == $searchValue) {
                return true;
            }
            return false;
        }

        public static function show_objects(array $objects): void {
            foreach ($objects as $object) {
                if ($object instanceof ColorPoint) {
                    $object->show();
                } else {
                    echo "Invalid object found in array.\n";
                }
            }
        }

         // Метод для експорту об'єктів у CSV файл
        public static function exportToCSV(array $objects, $filename): void {
            $file = fopen($filename, 'w');

            if ($file === false) {
                throw new Exception("Не вдалося відкрити файл для запису: " . $filename);
            }

            // Запис заголовків у CSV файл
            fputcsv($file, ['X', 'Y', 'Color', 'CreatedAt'], ';');

            foreach ($objects as $object) {
                if ($object instanceof ColorPoint) {
                    fputcsv($file, [
                        $object->x,
                        $object->y,
                        $object->color,
                        $object->createdAt->format('Y-m-d H:i:s')
                    ], ';');
                } else {
                    echo "Invalid object found in array.\n";
                }
            }

            fclose($file);
        }

        private function formMessage(): string {
            return "X: " . $this->x . ", Y: " . $this->y . ", Color: " . $this->color . " CreatedAt: " . $this->createdAt->format('Y-m-d H:i:s') . "\n";
        }
    }

    // Приклад використання класу массив що складається з об'єктів класу
    $listOfPoints=array();
   
    $listOfPoints[0] = new ColorPoint();
    $listOfPoints[0]->set(10, 20, 'Red');

    $listOfPoints[1] = new ColorPoint();
    $listOfPoints[1]->set(0, 10, 'Blue');

    $listOfPoints[2] = new ColorPoint();
    $listOfPoints[2]->set(20, 30, 'Green');

    $listOfPoints[3] = new ColorPoint();
    $listOfPoints[3]->set(-10, 0, 'Orange');

    $listOfPoints[4] = new ColorPoint();
    $listOfPoints[4]->set(-20, -10, 'Pink');


    // Приклад функціоналу отримання значень
    $listOfPoints[0]->show(); 
    $values = $listOfPoints[1]->get();
    print_r($values); 

    // Пошук
    if ($listOfPoints[0]->search('Red')) {
        echo "Found the color Red!\n";
    }
    if ($listOfPoints[0]->search(10)) {
        echo "Found the coordinate 10!\n";
    }
    if (!$listOfPoints[0]->search('Blue')) {
        echo "Color Blue not found.\n";
    }

    ColorPoint::show_objects($listOfPoints);
    ColorPoint::exportToCSV($listOfPoints, "color_points.csv");
?>