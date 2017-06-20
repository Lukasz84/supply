<?php
$mainquery="SELECT * FROM(

SELECT orderid, team, finalDate, prodOrderId, serialNumber, productId, etap, step1, processid1, 'standardowe' as 'rodzaj', 'yes' as 'isSelected', st.equipmentId, st.variantId, NULL as 'equipmentCnt' FROM (
 
    
        SELECT b.orderid, b.productId,  b.serialNumber, b.finalDate, b.processid as processid1, b.team,

          (SELECT step_id
                  FROM bkf_cworders where processid = b.processid and step = 1 LIMIT 1) as step1,

          (SELECT prodOrderId
                  FROM bkf_cworders where step = 60 and processid = b.processid order by step_id desc LIMIT 1 ) as prodOrderId,

        (CASE
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 1 and 3) and (b.status <> 6) THEN 'W konfiguracji'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 10 and 49) and (b.status <> 6) THEN 'W technologii / zamówieniach / bodywork'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 50 and 89) and (b.status <> 6) THEN 'W Montażu / na testach'
         WHEN  (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) in (90) and GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%' THEN 'Zamknięcie zlecenia'
         END) as etap

        FROM bkf_cworders b
        join jrincidents as h on b.step_id=h.process_step_id
        join jrincident as hi on h.processid = hi.processid
        where h.status <>4 and b.step <> 117

        group by b.processid
            HAVING GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%'
       order by b.finalDate, b.orderId ASC

) x 

join ST_ORSTANDEQUIPMNT as st on st.processid = processid1 and st.step_id = step1

UNION 
(
SELECT orderid, team, finalDate, prodOrderId, serialNumber, productId, etap, step1, processid1,  'opcjonalne' as 'rodzaj', st.isSelected, st.equipmentId, st.variantId, st.equipmentCnt FROM (
            SELECT b.orderid, b.productId,  b.serialNumber, b.finalDate, b.processid as processid1, b.team,

          (SELECT step_id
                  FROM bkf_cworders where processid = b.processid and step = 1 LIMIT 1) as step1,

          (SELECT prodOrderId
                  FROM bkf_cworders where step = 60 and processid = b.processid order by step_id desc LIMIT 1 ) as prodOrderId,

        (CASE
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 1 and 3) and (b.status <> 6) THEN 'W konfiguracji'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 10 and 49) and (b.status <> 6) THEN 'W technologii / zamówieniach / bodywork'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 50 and 89) and (b.status <> 6) THEN 'W Montażu / na testach'
         WHEN  (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) in (90) and GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%' THEN 'Zamknięcie zlecenia'
         END) as etap

        FROM bkf_cworders b
        join jrincidents as h on b.step_id=h.process_step_id
        join jrincident as hi on h.processid = hi.processid
        where h.status <>4 and b.step <> 117

        group by b.processid
            HAVING GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%'
        order by b.finalDate, b.orderId ASC )y 
    
join ST_OROPEQUIPMNT as st on st.processid = processid1 and st.step_id = step1
    
)

UNION 
(
SELECT orderid, team, finalDate, prodOrderId, serialNumber, productId, etap, step1, processid1, 'stanowiska' as 'rodzaj', st.isSelected, st.equipmentId, st.variantId, st.equipmentCnt FROM (
            SELECT b.orderid, b.productId,  b.serialNumber, b.finalDate, b.processid as processid1, b.team,

          (SELECT step_id
                  FROM bkf_cworders where processid = b.processid and step = 1 LIMIT 1) as step1,

          (SELECT prodOrderId
                  FROM bkf_cworders where step = 60 and processid = b.processid order by step_id desc LIMIT 1 ) as prodOrderId,

        (CASE
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 1 and 3) and (b.status <> 6) THEN 'W konfiguracji'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 10 and 49) and (b.status <> 6) THEN 'W technologii / zamówieniach / bodywork'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 50 and 89) and (b.status <> 6) THEN 'W Montażu / na testach'
         WHEN  (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) in (90) and GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%' THEN 'Zamknięcie zlecenia'
         END) as etap

        FROM bkf_cworders b
        join jrincidents as h on b.step_id=h.process_step_id
        join jrincident as hi on h.processid = hi.processid
        where h.status <>4 and b.step <> 117

        group by b.processid
            HAVING GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%'
        order by b.finalDate, b.orderId ASC )y 
    
join ST_OROPSTANEQUIPMENT as st on st.processid = processid1 and st.step_id = step1
    
)
) x1 Order by serialNumber, rodzaj = 'stanowiska', rodzaj = 'opcjonalne', rodzaj = 'standardowe';";



$equipment='SELECT  `bkf_productsequipment`.`equipmentId`
                FROM    `bkf_prodequicross`, `bkf_productsequipment`
                WHERE   `bkf_prodequicross`.`equipmentId` = `bkf_productsequipment`.`equipmentId` AND
                        `bkf_prodequicross`.`productId` = "CW4T5" AND
                        `bkf_productsequipment`.`equipmentType` = "standard" 
UNION               
SELECT  `bkf_productsequipment`.`equipmentId`
                FROM    `bkf_prodequicross`, `bkf_productsequipment`
                WHERE   `bkf_prodequicross`.`equipmentId` = `bkf_productsequipment`.`equipmentId` AND
                        `bkf_prodequicross`.`productId` = "CW4T5" AND
                        `bkf_productsequipment`.`equipmentType` = "option" AND
                        `bkf_productsequipment`.`requiresQuantity` = "no"
UNION
SELECT  `bkf_productsequipment`.`equipmentId`
                FROM    `bkf_prodequicross`, `bkf_productsequipment`
                WHERE   `bkf_prodequicross`.`equipmentId` = `bkf_productsequipment`.`equipmentId` AND
                        `bkf_prodequicross`.`productId` = "CW4T5" AND
                        `bkf_productsequipment`.`equipmentType` = "option" AND
                        `bkf_productsequipment`.`requiresQuantity` = "yes";';


$mainquery_demo="SELECT * FROM(

SELECT orderid, team, finalDate, prodOrderId, serialNumber, productId, etap, step1, processid1, 'standardowe' as 'rodzaj', 'yes' as 'isSelected', st.equipmentId, st.variantId, NULL as 'equipmentCnt' FROM (
 
    
        SELECT b.orderid, b.productId,  b.serialNumber, b.finalDate, b.processid as processid1, b.team,

          (SELECT step_id
                  FROM bkf_cworders where processid = b.processid and step = 1 LIMIT 1) as step1,

          (SELECT prodOrderId
                  FROM bkf_cworders where step = 60 and processid = b.processid order by step_id desc LIMIT 1 ) as prodOrderId,

        (CASE
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 1 and 3) and (b.status <> 6) THEN 'W konfiguracji'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 10 and 49) and (b.status <> 6) THEN 'W technologii / zamówieniach / bodywork'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 50 and 89) and (b.status <> 6) THEN 'W Montażu / na testach'
         WHEN  (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) in (90) and GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%' THEN 'Zamknięcie zlecenia'
         END) as etap

        FROM bkf_cworders b
        join jrincidents as h on b.step_id=h.process_step_id
        join jrincident as hi on h.processid = hi.processid
        where h.status <>4 and b.step <> 117 and orderid='ZS-27/2017/1'

        group by b.processid
            HAVING GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%'
       order by b.finalDate, b.orderId ASC

) x 

join ST_ORSTANDEQUIPMNT as st on st.processid = processid1 and st.step_id = step1

UNION 
(
SELECT orderid, team, finalDate, prodOrderId, serialNumber, productId, etap, step1, processid1,  'opcjonalne' as 'rodzaj', st.isSelected, st.equipmentId, st.variantId, st.equipmentCnt FROM (
            SELECT b.orderid, b.productId,  b.serialNumber, b.finalDate, b.processid as processid1, b.team,

          (SELECT step_id
                  FROM bkf_cworders where processid = b.processid and step = 1 LIMIT 1) as step1,

          (SELECT prodOrderId
                  FROM bkf_cworders where step = 60 and processid = b.processid order by step_id desc LIMIT 1 ) as prodOrderId,

        (CASE
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 1 and 3) and (b.status <> 6) THEN 'W konfiguracji'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 10 and 49) and (b.status <> 6) THEN 'W technologii / zamówieniach / bodywork'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 50 and 89) and (b.status <> 6) THEN 'W Montażu / na testach'
         WHEN  (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) in (90) and GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%' THEN 'Zamknięcie zlecenia'
         END) as etap

        FROM bkf_cworders b
        join jrincidents as h on b.step_id=h.process_step_id
        join jrincident as hi on h.processid = hi.processid
        where h.status <>4 and b.step <> 117 and orderid='ZS-27/2017/1'

        group by b.processid
            HAVING GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%'
        order by b.finalDate, b.orderId ASC )y 
    
join ST_OROPEQUIPMNT as st on st.processid = processid1 and st.step_id = step1
    
)

UNION 
(
SELECT orderid, team, finalDate, prodOrderId, serialNumber, productId, etap, step1, processid1, 'stanowiska' as 'rodzaj', st.isSelected, st.equipmentId, st.variantId, st.equipmentCnt FROM (
            SELECT b.orderid, b.productId,  b.serialNumber, b.finalDate, b.processid as processid1, b.team,

          (SELECT step_id
                  FROM bkf_cworders where processid = b.processid and step = 1 LIMIT 1) as step1,

          (SELECT prodOrderId
                  FROM bkf_cworders where step = 60 and processid = b.processid order by step_id desc LIMIT 1 ) as prodOrderId,

        (CASE
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 1 and 3) and (b.status <> 6) THEN 'W konfiguracji'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 10 and 49) and (b.status <> 6) THEN 'W technologii / zamówieniach / bodywork'
         WHEN ( (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) between 50 and 89) and (b.status <> 6) THEN 'W Montażu / na testach'
         WHEN  (SELECT step
                  FROM jrincidents where processid = b.processid and outdate is NULL order by step desc LIMIT 1) in (90) and GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%' THEN 'Zamknięcie zlecenia'
         END) as etap

        FROM bkf_cworders b
        join jrincidents as h on b.step_id=h.process_step_id
        join jrincident as hi on h.processid = hi.processid
        where h.status <>4 and b.step <> 117 and orderid='ZS-27/2017/1'

        group by b.processid
            HAVING GROUP_CONCAT(h.status SEPARATOR ', ') like '%0%'
        order by b.finalDate, b.orderId ASC )y 
    
join ST_OROPSTANEQUIPMENT as st on st.processid = processid1 and st.step_id = step1
    
)
) x1 Order by serialNumber, rodzaj = 'stanowiska', rodzaj = 'opcjonalne', rodzaj = 'standardowe';";


?>

