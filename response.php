<?php
require_once('config/class.dbmysqldriver.php');
require_once('config/query.dbmysql.php');


$DB=new dbmysqldriver();


/*$result2=$DB->query("select distinct orderId, clientId, finalDate, country, team from (SELECT b.processid, b.orderId, b.clientId, b.saleType, b.responsibleUser, b.finalDate, b.country, hi.status, b.finishDate,b.team,

(CASE WHEN
GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%' THEN  '1otw'
WHEN GROUP_CONCAT(h.status SEPARATOR ', ') like '%6%' and b.step not in (36) THEN '3anul'
ELSE '2zam'
END) as stat_kroki,

p.SerialNumber, po.orderDescription as desc4, po.orderDescProd, po.orderDescLogistic, po.orderDescService, po.orderDescTech, p.productid, p.prodOrderNumber, p.ID as IDProduktu,

IFNULL((SELECT (CASE WHEN
GROUP_CONCAT(status SEPARATOR ', ') like '%0%' THEN  '1otw'
WHEN GROUP_CONCAT(status SEPARATOR ', ') like '%6%' and b.step not in (36) THEN '3anul'
ELSE '2zam'
END)
 FROM jrincidents where processid = p.prodOrderNumber),'2zam') as  prodstatus

FROM bkf_cwdelivery b
LEFT JOIN `bkf_productsorders` as po ON po.processid = b.processid
LEFT JOIN `bkf_product` as p ON po.IDprod = p.ID

join jrincidents as h on b.step_id=h.process_step_id
join jrincident as hi on h.processid = hi.processid
where h.status <>4 and po.detachDate is NULL
and b.step <> 203  and b.step <> 100 and b.step <> 23 and b.step <> 5 and b.step <> 7
group by b.processid, p.serialNumber
order by stat_kroki, b.orderId, b.finalDate, p.productid ASC) y where orderId not like '%-->%' and team<>'' order by finalDate desc;");*/

$result2=$test=array("0" => array("zs" => 'ZS-4544554', "team" => "Zespol 4", "akronim" => "Orlen", "produkt" => "dassdadsa", 
"produkt"=>array("produkt" => "CWT45", "numer" => '14789',"produkt" => "CWT45", "numer" => '14789')));


//foreach($result2 as $key)
//{
  //  echo $key['orderid'];ZS-31/2015/8
//}




echo json_encode($result2);


?>