<?php 

require_once('EuroAdapter.php');
require_once('DollarCalc.php');
class Client { 
    private $requestNow; 
    private $dollarRequest; 

    public function __construct() { 
        $this->requestNow = new EuroAdapter(); 
        $this->dollarRequest = new DollarCalc(); 

        // Отримання євро
        echo "Euros: Є" . $this->makeAdapterRequest($this->requestNow) . "\n"; 

        // Конвертація в долари
        echo "Dollars: $" . $this->makeDollarRequest($this->dollarRequest); 
    } 

    private function makeAdapterRequest(ITarget $req) { 
        return $req->requestCalc(40, 50); 
    } 

    private function makeDollarRequest(DollarCalc $req) { 
        return $req->requestCalc(40, 50); 
    } 
}

// Ініціалізація клієнта
$worker = new Client(); 

?>
