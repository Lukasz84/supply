<?php
require_once('config/class.dbmysqldriver.php');
require_once('config/query.dbmysql.php');


$DB=new dbmysqldriver();


$result2=$DB->query('select * from supply_order');


//foreach($result2 as $key)
//{
  //  echo $key['orderid'];
//}

echo json_encode($result2);




?>