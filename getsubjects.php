<?php

include "config.php";
$id = $_POST['id'];
$stmt = $db->prepare("SELECT classess.class_id,subjectcombination.subjectid FROM `classess` INNER JOIN `subjectcombination` ON classess.class_id = subjectcombination.classid WHERE classess.class_id = ?");
$stmt->execute(array($id));
$stmt2 = $db->prepare("SELECT subjecttable.subject_name,subjectcombination.subjectid FROM subjecttable INNER JOIN subjectcombination ON subjecttable.subject_id = subjectcombination.subjectid WHERE subjectcombination.classid = ?");
$stmt2->execute(array($id));
$rows = $stmt2->fetchAll();
foreach($rows as $row){
    echo "<label>" . $row['subject_name'] . "</label>";
    echo "<input type='number' class='form-control' name='subject[]' placeholder='enter mark out of 100' required/>";
}



?>







