<?php
    //Оголошення базового класу
    abstract class Coor {
        abstract public function showWelcomeMessage();
   } 

   //Перевизначення абстрактного методу для похідного класу Member
   class Member extends Coor{ 
        public function __construct() {
                
        }
        public function showWelcomeMessage() {
            echo "Hi Member, welcome to our shop!To buy something, please, register!\n"; 
        }
    
        public function newMessage( $subject ) {     
            echo "Creating new message $subject\n"; 
        } 
   }    
   
   class Shopper extends Coor {
        public function __construct() {

        }

        //Перевизначення абстрактного методу для похідного класу Shopper
        public function showWelcomeMessage() {
            echo "Hi Shopper, welcome to our online store!\n"; 
        }    

        public function addToCart( $item ) {    
            echo "Adding $item to cart\n"; 
        } 
    }

        //Приклад роботи
        $shopper = new Shopper();
        $shopper->showWelcomeMessage();
        $shopper->addToCart("Apples");
    
        $member = new Member();
        $member->showWelcomeMessage();
        $member->newMessage("Member's new message");
?>