<?php
class Coor
{

    private $name;
    private $login;
    private $password;

    function __construct($name, $login, $password) // function for setting name  
    {

        $this->name = $name; //set some “name” to this “name”;
        $this->login = $login;
        $this->password = $password;

    }

    function printInfo()  //function for getting properties
    {

        echo "Name: " . $this->name . " login: " . $this->login . " password: " . $this->password . "\n"; // printing properties  

    }
    function __destruct()
    {
        print "Destroying " . $this->name . "\n";
    }

}

$object = new Coor("Nick", "Nick_login", "Nick_pass"); //creating “Coor” object
$object1 = new Coor("Nick 1", "Nick_login1", "Nick_pass1"); //creating “Coor” object
$object2 = new Coor("Nick 2", "Nick_login2", "Nick_pass2"); //creating “Coor” object

$object->printInfo(); //function call
$object1->printInfo(); //function call
$object2->printInfo(); //function call

?>