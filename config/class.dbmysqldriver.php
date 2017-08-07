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
     $row;
     while($r=mysqli_fetch_row($result)){
         $row[]=$r;
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

$result2="select distinct processid, orderId, clientId, finalDate, country, team from (SELECT b.processid, b.orderId, b.clientId, b.saleType, b.responsibleUser, b.finalDate, b.country, hi.status, b.finishDate,b.team,

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
order by stat_kroki, b.orderId, b.finalDate, p.productid ASC) y where orderId not like '%-->%' and team<>'' order by finalDate desc;";

$device="select distinct processid, serialNumber, productId, IDproduktu from (SELECT b.processid, b.orderId, b.clientId, b.saleType, b.responsibleUser, b.finalDate, b.country, hi.status, b.finishDate,b.team,

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
order by stat_kroki, b.orderId, b.finalDate, p.productid ASC) y where orderId not like '%-->%' and team<>'' and orderId='zmienna' order by finalDate;";

$details="SELECT equipmentId, isSelected, variantId, null as equipmentCnt
                FROM `ST_OROPEQUIPMNT`
                WHERE `processid` = (SELECT DISTINCT processid FROM bkf_cworders where processid =
                (
                SELECT p.prodOrderNumber FROM bkf_product p
                JOIN bkf_productsorders po on p.ID = po.IDProd where detachDate is NULL and p.ID =  'zamexpand')
                order by prodOrderId DESC LIMIT 1)
                and step_id = (SELECT max(step_id) FROM ST_OROPEQUIPMNT WHERE `processid` = (SELECT DISTINCT processid FROM bkf_cworders where processid =
                (
                SELECT p.prodOrderNumber FROM bkf_product p
                JOIN bkf_productsorders po on p.ID = po.IDProd where detachDate is NULL and p.ID ='zamexpand')
                order by prodOrderId DESC LIMIT 1) )
union
SELECT equipmentId, isSelected,variantId, equipmentCnt
                FROM `ST_OROPSTANEQUIPMENT`
                WHERE `processid` = (SELECT DISTINCT processid FROM bkf_cworders where processid =
                (
                SELECT p.prodOrderNumber FROM bkf_product p
                JOIN bkf_productsorders po on p.ID = po.IDProd where detachDate is NULL and p.ID =  'zamexpand')
                order by prodOrderId DESC LIMIT 1)
                and step_id = (SELECT max(step_id) FROM ST_OROPSTANEQUIPMENT WHERE `processid` = (SELECT DISTINCT processid FROM bkf_cworders where processid =
                (
                SELECT p.prodOrderNumber FROM bkf_product p
                JOIN bkf_productsorders po on p.ID = po.IDProd where detachDate is NULL and p.ID = 'zamexpand')
                order by prodOrderId DESC LIMIT 1))
union
SELECT equipmentId, variantId, equipmentCnt, null as isSelected
                FROM `ST_ORSTANDEQUIPMNT`
                WHERE `processid` = (SELECT DISTINCT processid FROM bkf_cworders where processid =
                (
                SELECT p.prodOrderNumber FROM bkf_product p
                JOIN bkf_productsorders po on p.ID = po.IDProd where detachDate is NULL and p.ID = 'zamexpand')
                order by prodOrderId DESC LIMIT 1)
                and step_id = (SELECT max(step_id) FROM ST_ORSTANDEQUIPMNT WHERE `processid` = (SELECT DISTINCT processid FROM bkf_cworders where processid =
                (
                SELECT p.prodOrderNumber FROM bkf_product p
                JOIN bkf_productsorders po on p.ID = po.IDProd where detachDate is NULL and p.ID = 'zamexpand')
                order by prodOrderId DESC LIMIT 1) );";
                

?>