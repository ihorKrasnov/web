<?php
trait SingletonTrait {
    private static $_instance = null;

    // Приватний конструктор
    private function __construct() {
    }

    // Метод для отримання екземпляра
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Приватний метод для запобігання клонуванню
    private function __clone() {
    }

    // Приватний метод для запобігання десеріалізації
    private function __wakeup() {
    }
}

class MySingleton {
    use SingletonTrait;

    public function doSomething() {
        return "Класт створено!";
    }
}

// Отримуємо перший екземпляр
$instance1 = MySingleton::getInstance();
echo $instance1->doSomething() . "\n";

// Отримуємо другий екземпляр
$instance2 = MySingleton::getInstance();

// Перевіряємо, чи вони однакові
if ($instance1 === $instance2) {
    echo "Обидва екземпляри однакові.\n";
} else {
    echo "Екземпляри різні.\n";
}
?>
