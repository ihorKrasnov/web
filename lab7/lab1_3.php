<?php

interface ValidationHandler {
    public function setNext(ValidationHandler $handler): ValidationHandler;
    public function handle(ColorPoint $point): ?string;
}

abstract class BaseValidationHandler implements ValidationHandler {
    protected $nextHandler;

    public function setNext(ValidationHandler $handler): ValidationHandler {
        $this->nextHandler = $handler;
        return $handler;
    }

    protected function next(ColorPoint $point): ?string {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($point);
        }
        return null;
    }
}

class CoordinateValidationHandler extends BaseValidationHandler {
    public function handle(ColorPoint $point): ?string {
        if ($point->x < 0 || $point->y < 0) {
            return "Invalid coordinates: x and y must be non-negative.";
        }
        return $this->next($point);
    }
}

class ColorValidationHandler extends BaseValidationHandler {
    private $validColors = ['Red', 'Blue', 'Green', 'Orange', 'Pink'];

    public function handle(ColorPoint $point): ?string {
        if (!in_array($point->color, $this->validColors)) {
            return "Invalid color: " . $point->color;
        }
        return $this->next($point);
    }
}

class CreatedAtValidationHandler extends BaseValidationHandler {
    public function handle(ColorPoint $point): ?string {
        if ($point->getCreatedAtDate() < '2020-01-01 00:00:00') {
            return "Creation date is too old: " . $point->getCreatedAtDate();
        }
        return $this->next($point);
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

    private function formMessage(): string {
        return "X: " . $this->x . ", Y: " . $this->y . ", Color: " . $this->color . " CreatedAt: " . $this->createdAt->format('Y-m-d H:i:s') . "\n";
    }
}

// Приклад використання
$listOfPoints = [];

$listOfPoints[0] = new ColorPoint();
$listOfPoints[0]->set(10, 20, 'Red');

$listOfPoints[1] = new ColorPoint();
$listOfPoints[1]->set(-5, 10, 'Blue'); // Invalid coordinate

$listOfPoints[2] = new ColorPoint();
$listOfPoints[2]->set(20, 30, 'Purple'); // Invalid color

$listOfPoints[3] = new ColorPoint();
$listOfPoints[3]->set(5, 5, 'Orange');

// Налаштування ланцюга перевірки
$coordinateValidator = new CoordinateValidationHandler();
$colorValidator = new ColorValidationHandler();
$createdAtValidator = new CreatedAtValidationHandler();

$coordinateValidator->setNext($colorValidator)->setNext($createdAtValidator);

// Перевірка точок
foreach ($listOfPoints as $point) {
    $validationResult = $coordinateValidator->handle($point);
    if ($validationResult) {
        echo "Point validation failed: " . $validationResult . "\n";
    } else {
        $point->show();
    }
}

?>
