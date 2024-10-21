<?php
class someClass {
    public function __construct() {

    }

    public function doSomething() {
        return "Об'єкт створено!";
    }
}

class SomeClassFactory {
    public static function create() {
        return new someClass();
    }
}

// Створюємо об'єкт через фабрику
$instance1 = SomeClassFactory::create();
echo $instance1->doSomething() . "\n";

// Створюємо ще один об'єкт
$instance2 = SomeClassFactory::create();
echo $instance2->doSomething() . "\n";

// Перевірка
if ($instance1 !== $instance2) {
    echo "Екземпляри різні.\n";
} else {
    echo "Екземпляри однакові.\n";
}
?>