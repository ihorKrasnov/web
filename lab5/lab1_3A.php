<?php

// Інтерфейс для фабрики кольорових точок
interface PointFactory {
    public function createPoint(): ColorPoint;
}

// Фабрика для створення ColorPoint в першій системі координат
class CartesianPointFactory implements PointFactory {
    public function createPoint(): ColorPoint {
        return new ColorPoint();
    }
}

// Фабрика для створення ColorPoint в полярній системі координат
class PolarPointFactory implements PointFactory {
    public function createPoint(): ColorPoint {
        return new ColorPoint();
    }
}

class ColorPoint {
    public $x;
    public $y;
    public $color;
    private $createdAt;

    public function __construct() {
        $this->createdAt = new DateTime();
    }

    public function set($x, $y, $color): void {
        $this->x = $x;
        $this->y = $y;
        $this->color = $color;
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
        return $this->x == $searchValue || $this->y == $searchValue || $this->color == $searchValue;
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
            throw new Exception("Cannot open file for writing: " . $filename);
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

// Приклад використання
$cartesianFactory = new CartesianPointFactory();
$polarFactory = new PolarPointFactory();

$listOfPoints = [];

// Створюємо кольорові точки в прямокутній системі координат
for ($i = 0; $i < 3; $i++) {
    $point = $cartesianFactory->createPoint();
    $point->set(rand(-20, 20), rand(-20, 20), 'Color' . $i);
    $listOfPoints[] = $point;
}

// Створюємо кольорові точки в полярній системі координат
for ($i = 0; $i < 3; $i++) {
    $point = $polarFactory->createPoint();
    $point->set(rand(-20, 20), rand(-20, 20), 'PolarColor' . $i);
    $listOfPoints[] = $point;
}

// Приклад функціональності
ColorPoint::show_objects($listOfPoints);
ColorPoint::exportToCSV($listOfPoints, "color_points.csv");

?>
