<?php 
interface ITest {
    public function test();
}

interface IGet {
    public function get();
}

class A implements ITest, IGet {
    public function test()
    {
        echo 1;
    }


    public function get()
    {
        $this->test();
    }

}

class B extends A
{
    public function test()
    {
        echo 2;
    }
}

$b = new B();
$b->get() // Виведеться 2
?>