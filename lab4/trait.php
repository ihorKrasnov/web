<?php 
//Створення трейту
trait my_first_trait { 
    public function traitFunction() 
    { 
        echo "Hello world\n"; 
    }

    public function greetBasedOnTime() 
    {
        $hour = date('H');

        if ($hour < 12) {
            echo "Good morning";
        } elseif ($hour < 18) {
            echo "Good day";
        } else {
            echo "Good evening";
        }
    }
} 

class helloWorld { 
    // Приклад використання трейтів PHP
    use my_first_trait; 
} 

$objTest = new HelloWorld(); 

$objTest->traitFunction();
$objTest->greetBasedOnTime();
?> 