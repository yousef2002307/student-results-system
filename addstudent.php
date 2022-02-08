<?php
ob_start();
session_start();
$title = 'add student';
include "init.php";


?>

<?php

$num = 0;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sex = '';
    $name = $_POST['nameofstudent'];
    $rollid = $_POST['rollid'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    if($gender == '0'){
        $sex = 'male';
    }else{
        $sex = 'female';
    }
    $class = $_POST['class'];
    $stmt2 =  $db->prepare("SELECT * FROM `students` WHERE rollid = ?");
    $stmt2->execute(array($rollid));
    $count = $stmt2->rowCount();
    if($count == 0){
    $stmt = $db->prepare("INSERT INTO `students`(name,rollid,email,gender,classid) VALUES(:zname,:rollid,:znum,:zsection,:classid)");
    $stmt->execute(array(
        "zname" => $name,
        "rollid" => $rollid,
        "znum" =>$email,
        "zsection" => $sex,
        "classid" => $class
    ));
   $num = 1;
}else{
    echo "num of class already excist try to change it please";
}
}






?>

<h2 class='text-center mb-3 mt-5'>add student  </h2>
<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method='POST' class='createclassform'>
<div class="form-group">
<input type="text" name='nameofstudent' class='form-control' required placeholder='please enter name of student' />
</div>
<div class="form-group">
<input type="number" name='rollid' class='form-control' required  placeholder='roolid'/>
</div>
<div class="form-group">
<input type="text" name='email' class='form-control' required placeholder='enter email' />
</div>

<div class="form-group">
<input type='radio' name='gender' value="0" /> MALE
<input type='radio' name='gender' value="1" /> FEMALE
</div>
<div class="form-group">
<select name='class' class='form-control'>
<?php

$stmt9 = $db->prepare("SELECT * FROM classess");
$stmt9->execute();
$rows = $stmt9->fetchAll();
foreach($rows as $row){
    echo "<option value =". $row['class_id'] .">" . $row['class_name'] . " - " . $row['sectionofclass'] . "</option>";
}
?>


</select>
</div>

<input type="submit"  class='btn btn-dark btn-block'  />
</form>

<?php

if($num){
    echo "<div class='alert alert-success mt-2'> 1 class has been inserted </div>";
    header("REFRESH:4");
 
}




?>
<?php
include 'includes/templates/footer.php';
ob_end_flush();
?>








