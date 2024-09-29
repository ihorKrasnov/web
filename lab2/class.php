<?php

class Point
{
    protected $x;
    protected $y;
    // Статичне поле для підрахунку об'єктів
    protected static $count = 0; 

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        // Збільшуємо лічильник при створенні нового об'єкта
        self::$count++; 
    }

    public function __destruct()
    {
        // Зменшуємо лічильник при знищенні об'єкта
        self::$count--; 
    }

    // Статичний метод для отримання кількості об'єктів
    public static function getCount() 
    {
        return self::$count;
    }

    public function display()
    {
        echo "Point: (" . $this->x . ", " . $this->y . ")\n";
    }
}

class Circle extends Point
{
    private $radius;

    public function __construct($x, $y, $radius)
    {
        parent::__construct($x, $y);
        $this->radius = $radius;
    }

    public function __destruct()
    {
        // Викликаємо батьківський деструктор
        parent::__destruct(); 
    }

    public function display()
    {
        parent::display();
        echo "Radius: " . $this->radius . "\n";
        echo "Area: " . $this->calculateArea() . "\n";
    }

    public function calculateArea()
    {
        return pi() * pow($this->radius, 2);
    }
}

// Приклад використання
$point = new Point(3, 4);
$point->display();

$circle = new Circle(5, 6, 10);
$circle->display();

// Виводимо загальну кількість об'єктів
echo "Total Points created: " . Point::getCount() . "\n";
?>