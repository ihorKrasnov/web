<?php 
class someClass {
    protected static $_instance;
    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;

    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }
}
// Отримуємо перший екземпляр
$instance1 = someClass::getInstance();

// Отримуємо другий екземпляр
$instance2 = someClass::getInstance();

// Перевіряємо, чи вони однакові
if ($instance1 === $instance2) {
    echo "Обидва екземпляри однакові.\n";
} else {
    echo "Екземпляри різні.\n";
}
?>