<?php

// Існуючий клас ColorPoint
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

    public function show(): void {
        echo $this->formMessage();
    }

    private function formMessage(): string {
        return "X: " . $this->x . ", Y: " . $this->y . ", Color: " . $this->color . " CreatedAt: " . $this->createdAt->format('Y-m-d H:i:s') . "\n";
    }
}

// Новий інтерфейс для адаптера
interface ColorPointAdapterInterface {
    public function getCoordinates(): array;
    public function getColor(): string;
}

// Адаптер для класу ColorPoint
class ColorPointAdapter implements ColorPointAdapterInterface {
    private $colorPoint;

    public function __construct(ColorPoint $colorPoint) {
        $this->colorPoint = $colorPoint;
    }

    public function getCoordinates(): array {
        return ['x' => $this->colorPoint->x, 'y' => $this->colorPoint->y];
    }

    public function getColor(): string {
        return $this->colorPoint->color;
    }
}

// Приклад використання класу
$listOfPoints = [];

$listOfPoints[0] = new ColorPoint();
$listOfPoints[0]->set(10, 20, 'Red');

$listOfPoints[1] = new ColorPoint();
$listOfPoints[1]->set(0, 10, 'Blue');

// Використання адаптера
$adapters = [];
foreach ($listOfPoints as $point) {
    $adapters[] = new ColorPointAdapter($point);
}

// Демонстрація роботи адаптера
foreach ($adapters as $adapter) {
    $coordinates = $adapter->getCoordinates();
    $color = $adapter->getColor();
    echo "Coordinates: (" . $coordinates['x'] . ", " . $coordinates['y'] . "), Color: $color\n";
}

?>
