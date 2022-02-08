<?php
ob_start();
session_start();
$title = 'createclass';

include "init.php";
$do = '';
if(isset($_GET['do'])){
$do = $_GET['do'];
}else{
    $do = 'manage';
}

if($do == 'manage'){
  
  
    echo "<h2 class='text-center mt-5 mb-5'> manage classes </h2>";
    ?>
<div class="container">
<?php
$ordering = 'ASC';
$i = " fa-sort-numeric-up ";
if(isset($_GET['order'])){
if($_GET['order'] == 'DESC'){
    $ordering = 'ASC';
}else{
    $ordering = 'DESC';
}
}
$stmt = $db->prepare("SELECT * FROM `classess` ORDER BY class_id $ordering");
$stmt->execute();
$rows = $stmt->fetchAll();

?>
    <a class='atable' href='classes.php?do=manage&order=<?php echo $ordering  ?>'> change order</a>
  
<table class="table table-dark table-striped">
    <tr>
        <td>#</td>
        <td>CLASS NAME</td>
        <td>class in numeric</td>
        <td>section</td>
        <td>creation data</td>
        <td>action</td>
    </tr>
    <?php
 foreach($rows as $row){
      echo "<tr>";
echo "<td>" . $row['class_id']  . "</td>";
echo "<td>" . $row['class_name']  . "</td>";
echo "<td>" . $row['numofclass']  . "</td>";
echo "<td>" . $row['sectionofclass']  . "</td>";
echo "<td>" . $row['adding_date']  . "</td>";
echo "<td>" . "<a class='btn btn-success mr-3' href='?do=edit&classid=". $row['class_id'] ."'> edit </a>" .  "<a class='btn btn-danger deleteing' href='?do=delete&classid=". $row['class_id'] ."'> delete </a>". "</td>";
      echo"</tr>";
}
    ?>
</table>
</div>

<?php

}else if($do ==  'edit'){
    if(isset($_GET['classid']) && is_numeric($_GET['classid'])){
        $classid = intval($_GET['classid']);

        ////////////////////
        $num = 0;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nameofclass = $_POST['nameofclass'];
            $numofclass = $_POST['numofclass'];
            $sectionofclass = $_POST['sectionofclass'];
           
            $stmt = $db->prepare("UPDATE classess SET class_name = ?, numofclass = ?, sectionofclass = ? WHERE class_id = ? ");
            $stmt->execute(array($nameofclass,$numofclass,$sectionofclass,$classid));
           $num = 1;
      
        }













        ///////////////////


    
    $stmt2 =  $db->prepare("SELECT * FROM `classess` WHERE class_id = ?");
    $stmt2->execute(array($classid));
    $count = $stmt2->rowCount();
    $rows = $stmt2->fetch();



    ?>
<h2 class='text-center mb-3 mt-5'>edit class  </h2>
<form action="<?php echo $_SERVER['PHP_SELF'] . '?do=edit&classid='. $rows['class_id'] .'';  ?>" method='POST' class='createclassform'>
<div class="form-group">
<input type="text" name='nameofclass' value="<?php echo $rows['class_name']  ?>" class='form-control' required placeholder='please enter name of class' />
</div>
<div class="form-group">
<input type="number" name='numofclass' class='form-control' value="<?php echo $rows['numofclass']  ?>"  required  placeholder='enter num of class'/>
</div>
<div class="form-group">
<input type="text" name='sectionofclass' value="<?php echo $rows['sectionofclass']  ?>"  class='form-control' required placeholder='enter section of class' />
</div>
<input type="submit"  class='btn btn-dark btn-block'  />
</form>

<?php
if($num){
    echo "<div class='alert alert-success mt-2'> 1 class has been updated </div>";
    header("REFRESH:4");
 
}




?>
<?php
}else{
    $classid = 0;
}
}else if($do ='delete'){
    if(isset($_GET['classid']) && is_numeric($_GET['classid'])){
        $classid = intval($_GET['classid']);
        $stmt2 =  $db->prepare("DELETE FROM classess WHERE class_id = ?");
        $stmt2->execute(array($classid));
        echo "<div class='alert alert-success'> 1 class has been deleted </div>";
        redirectfunction();
    }else{
        echo "please leave";
        redirectfunction();
    }

}
else{
    echo "you are not allowed to be here"."<br/>";
    redirectfunction();
  
}

?>
<?php
include 'includes/templates/footer.php';
ob_end_flush();
?>