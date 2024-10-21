<?php
    class ColorPoint {
        public $x;
        public $y;
        public $color;
    
        private $createdAt;
    
        private function __construct($x, $y, $color) {
            $this->x = $x;
            $this->y = $y;
            $this->color = $color;
            $this->createdAt = new DateTime();
        }
    
        public static function create($x, $y, $color): ColorPoint {
            return new self($x, $y, $color);
        }
    
        public function get(): array {
            return [
                'x' => $this->x,
                'y' => $this->y,
                'color' => $this->color,
                'createdAt' => $this->createdAt->format('Y-m-d H:i:s')
            ];
        }
    
        public function getCreatedAtDate(): string {
            return $this->createdAt->format('Y-m-d H:i:s');
        }
    
        public function show(): void {
            echo $this->formMessage();
        }
    
        public function search($searchValue): bool {
            return ($this->x == $searchValue || $this->y == $searchValue || $this->color == $searchValue);
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
    
        public static function exportToCSV(array $objects, $filename): void {
            $file = fopen($filename, 'w');
    
            if ($file === false) {
                throw new Exception("Не вдалося відкрити файл для запису: " . $filename);
            }
    
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

// Приклад використання класу з фабричним методом
$listOfPoints = array();

$listOfPoints[] = ColorPoint::create(10, 20, 'Red');
$listOfPoints[] = ColorPoint::create(0, 10, 'Blue');
$listOfPoints[] = ColorPoint::create(20, 30, 'Green');
$listOfPoints[] = ColorPoint::create(-10, 0, 'Orange');
$listOfPoints[] = ColorPoint::create(-20, -10, 'Pink');

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