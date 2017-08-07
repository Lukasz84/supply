<?php
require_once('config/class.dbmysqldriver.php');
//$DB=new DbMySqlDriver();
  $db_name="jobrouter";
	$db_login="root";
	$db_password="Cdrtyj159polki!";
	$db_host="127.0.0.1";
	$JRDB = mysqli_connect($db_host, $db_login, $db_password, $db_name);
	

//$test=array("0" => array("zs" => 'ZS-4544554', "team" => "Zespol 4", "akronim" => "Orlen", "produkt" => "dassdadsa", 
//"produkt"=>array("produkt" => "CWT45", "numer" => "14789"),"produkt1"=>array("produkt1" => "CWT45", "numer" => "14789")));

//foreach($result2 as $key)
//{
  //  echo $key['orderid'];ZS-31/2015/8
//}


$info = mysqli_query($JRDB, $result2);

$cnt=mysqli_num_rows($info);

$dev_arr=array();

$details_arr=array();



for($i=0;$i<$cnt;$i++)
{
 $info_arr[$i]=mysqli_fetch_assoc($info); 
}


/*foreach($info_arr as $key => $value)
{
  $qrt='insert into supply_order values(NULL,"'.$value['processid'].'","'.$value['orderId'].'","'.$value['finalDate'].'",
  "'.$value['clientId'].'","'.$value['country'].'","'.$value['team'].'",0)';
$info=mysqli_query($JRDB, $qrt);

}*/



foreach($info_arr as $key => $value)
 {
     $qry=str_replace(zmienna,$value['orderId'],$device);
          $infodev = mysqli_query($JRDB, $qry);
           $cnt=mysqli_num_rows($infodev);
      for($i=0;$i<$cnt;$i++)
       {
          array_push($dev_arr,mysqli_fetch_assoc($infodev));         
       }
}

foreach($dev_arr as $key => $value)
{
  $qrt='insert into supply_desc values("'.$value['serialNumber'].'","'.$value['processid'].'","'.$value['IDproduktu'].'",
  "'.$value['productId'].'")';
$info=mysqli_query($JRDB, $qrt);

}

/*foreach($dev_arr as $key => $value)
 {
          
          $qry=str_replace(zamexpand,$value['IDproduktu'],$details);
          $infodev = mysqli_query($JRDB, $qry);
          $cnt=mysqli_num_rows($infodev);
              for($i=0;$i<$cnt;$i++)
                {
                  array_push($details_arr,mysqli_fetch_assoc($infodev));         
                }
}*/
//foreach($dev_arr as $key => $value)
  //foreach($value as $key2 => $value2)
//{

// $value2;
//}

//print_r($dev_arr);
//print_r($info_arr);
//print_r($details_arr);
//while($row=mysqli_fetch_assoc($hardware))
//{
  //for($i=0;$i<$cnt;$i++)
    //{
      //for($j=0;$j<$cnt;$j++)
      //{
        //$arr[$i][$j]=$row['finalDate'];
        //$arr[$i][$j]=$row['orderId'];
      //}
    //}
//}
