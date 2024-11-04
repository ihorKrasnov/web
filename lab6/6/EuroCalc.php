<?php 

require_once('ITarget.php');
class EuroCalc implements ITarget {
    private $euro;
    private $product;
    private $service;
    public $rate = 1;

    // Обробка запиту
    public function requestCalc($productNow, $serviceNow) { 
        $this->product = $productNow; 
        $this->service = $serviceNow; 
        $this->euro = $this->product + $this->service; 
        return $this->requestTotal(); 
    }

    // Повернення результату
    public function requestTotal() { 
        $this->euro *= $this->rate; 
        return $this->euro; 
    }

    // Реалізація методу з інтерфейсу ITarget
    public function requester() {
        return $this->requestTotal();
    }
}

?>
