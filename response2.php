<?php
require_once('config/class.dbmysqldriver.php');
require_once('config/query.dbmysql.php');


$DB=new dbmysqldriver();
 $id=$_REQUEST['id'];

$result1=$DB->query('select * from supply_desc where idOrder='.$id.' order by devName asc;');

//foreach($result2 as $key)
//{
  //  echo $key['orderid'];
//}

echo json_encode($result1);


  ?>