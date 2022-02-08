<?php

include "config.php";
$id = $_POST['id'];
$stmt = $db->prepare("SELECT classess.class_id,students.name,students.id FROM classess JOIN students ON students.classid = classess.class_id WHERE classess.class_id = ?");
$stmt->execute(array($id));
$rows = $stmt->fetchAll();
foreach($rows as $row){
    $stmt79 = $db->prepare("SELECT * FROM `results` WHERE classid = ? AND studentid = ?");
    $stmt79->execute(array($row['class_id'],$row['id']));
    $rowcount = $stmt79->rowCount();
  
    if($rowcount == 0){
    echo "<option value=". $row['id'].">" . $row['name'] . "</option>";
    }
}



?>







