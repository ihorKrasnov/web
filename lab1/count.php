<?php header("Content-Type: text/html; charset=windows-1251"); 
class WorkWithFile 
{ 
    var $buff; var $filename; 

    function __construct($filename) 
    { 

        $uploaddir = './'; 

        $this->filename = $uploaddir .$filename; 

        if(!file_exists($this->filename)) exit("File does not exist"); 

        //file openning

        $fd = fopen($filename, "r"); 

        if(!$fd) exit("File open error"); 

        $this->buff = fread($fd,filesize($this->filename)); fclose($fd) ; 
        $this->filename = $filename;
    } 

    // The method displays the contents of the //file on the function screen 

    function getContent() 

    { return $this->buff; 

    } 

    // The method displays the file size

    function getsize() 

    { 

    return filesize($this->filename); 

    } 

    // The method outputs the number of lines in the //function file 

    function getCount() 
    { 

        if(!empty($this->filename)) 

        { 

        $arr = file($this->filename); return count($arr); 

        } 

        else return 0; 

        } 

    } 


$first = new WorkWithFile("count.txt"); echo "{$first->getContent()}\n"; 
echo "{$first->getsize()}\n"; echo "{$first->getCount()}\n"; 

?>  