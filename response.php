<?php
require_once('config/class.dbmysqldriver.php');
require_once('config/query.dbmysql.php');


$DB=new dbmysqldriver();


$result2=$DB->query($mainquery_demo);


//foreach($result2 as $key)
//{
  //  echo $key['orderid'];
//}

echo json_encode($result2);




?>