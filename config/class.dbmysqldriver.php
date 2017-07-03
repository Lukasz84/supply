<?php
class DbMySqlDriver
{
private $User;
private $Password;
private $dbName;
private $dbHost;
private $numRows;
private $handler;
public function __construct($h="127.0.0.1",$u="root",$p="Cdrtyj159polki!",$n="jobrouter") {
    
    $this->dbHost=$h;
    $this->User=$u;
    $this->Password=$p;
    $this->dbName=$n;
    
    $conn=  mysqli_connect($h, $u, $p, $n)
            or die("-- Failed to connect to Data Server --");
    $this->handler=$conn;
  }
        //END OF __construct
  
public function Select($table, $what='*') {
    
     $query='SELECT '.$what.' FROM '.$table.';';
     $result=  mysqli_query($this->handler, $query)
             or die('-- Failde to recived data result --');
     $row=array();
     
     while($r=mysqli_fetch_assoc($result)){
         array_push($row, $r);
     }
    // $num=  mysqli_num_rows($result);
     //$this->numRows=$num;
     //echo $this->numRows;
     return($row);
     
}
 
 public function query($query)
 {
    $result=  mysqli_query($this->handler, $query)
             or die('-- Failde to recived data result --');
     $row=array();
     
     while($r=mysqli_fetch_assoc($result)){
         array_push($row, $r);
     }
    // $num=  mysqli_num_rows($result);
     //$this->numRows=$num;
     //echo $this->numRows;
     return($row);
     
 }

 public function numrows($result)
 {
      $num=  mysqli_num_rows($result);
     $this->numRows=$num;
 }
}
?>