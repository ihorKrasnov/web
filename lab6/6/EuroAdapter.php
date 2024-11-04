<?php 

require_once('EuroCalc.php');
require_once('ITarget.php');
class EuroAdapter extends EuroCalc implements ITarget {

    public function __construct() {
        $this->requester(); 
    }

    // Реалізація методу requester з інтерфейсу ITarget
    public function requester() {
        // Задаємо курс
        $this->rate = 0.8111; 
        return $this->requestTotal(); // Повертаємо загальну суму з урахуванням курсу
    }

    // Метод для обчислення вартості з параметрами
    public function calculate($productNow, $serviceNow) {
        return $this->requestCalc($productNow, $serviceNow);
    }
}

?>
