<?php 
include_once(__DIR__ . "/../model/Model.php");
   
class Controller {       

    public $model;    
   
    public function __construct()     
    {     
        $this->model = new Model();   
    }           
    public function invoke()   
    {   
        if (!isset($_GET['book']))   
        {   
            if (isset($_GET['search'])) {
                $books = $this->model->searchBooks($_GET['search']);
            } else {
                $books = $this->model->getBookList(); 
            }
            include  __DIR__ . "/../view/booklist.php";                 
        } else  
        {  
            // show the requested book  
            $book = $this->model->getBook($_GET['book']);                 
            include  __DIR__ . "/../view/viewbook.php";   
        }   
    }   
}   
?> 