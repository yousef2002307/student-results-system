<?php

include "config.php";
$id = $_POST['id'];
$stmt = $db->prepare("SELECT classess.class_id,students.name,students.id FROM classess JOIN students ON students.classid = classess.class_id WHERE classess.class_id = ?");
$stmt->execute(array($id));
$count = $stmt->rowCount();
if($count == 0){
 echo "<input type='submit' class='btn btn-block btn-primary stop' />";
}else{
   
  

    echo "<input type='submit' class='btn btn-block btn-primary ' />";

}


?>







