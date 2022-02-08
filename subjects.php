<?php
ob_start();
session_start();
$title = 'dashboard';
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
$stmt = $db->prepare("SELECT * FROM `subjecttable` ORDER BY subject_id $ordering");
$stmt->execute();
$rows = $stmt->fetchAll();

?>
    <a class='atable' href='subjects.php?do=manage&order=<?php echo $ordering  ?>'> change order</a>
  
<table class="table table-dark table-striped">
    <tr>
        <td>#</td>
        <td>subject NAME</td>
        <td>subject code</td>
        <td>adding date</td>
        <td>updated date</td>
        <td>action</td>
    </tr>
    <?php
 foreach($rows as $row){
      echo "<tr>";
echo "<td>" . $row['subject_id']  . "</td>";
echo "<td>" . $row['subject_name']  . "</td>";
echo "<td>" . $row['subjectcode']  . "</td>";
echo "<td>" . $row['adding_date']  . "</td>";
echo "<td>" . $row['updated_date']  . "</td>";
echo "<td>" . "<a class='btn btn-success mr-3' href='?do=edit&classid=". $row['subject_id'] ."'> edit </a>" . "</td>";
      echo"</tr>";
}
    ?>
</table>
</div>

<?php
}else if($do == 'edit'){
    $id = 0;
    
    $num = 0;
    if(isset($_GET['do']) && is_numeric($_GET['classid']) ){
            $id = intval($_GET['classid']);
         
           $stmt = $db->prepare("SELECT * FROM `subjecttable` WHERE subject_id = ?");
           $stmt->execute(array($id));
           $row = $stmt->fetch();
           $count = $stmt->rowCount();
        
           if($count == 1){
               if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $nameofclass = $_POST['nameofsubject'];
                $numofclass = strtoupper($_POST['codeofsubject']);
                $stmt2 =  $db->prepare("SELECT * FROM `subjecttable` WHERE subjectcode = ? AND subject_name != ?");
                $stmt2->execute(array($numofclass,$row['subject_name']));
                $count = $stmt2->rowCount();
               if($count == 0){
               $stmt3 = $db->prepare("UPDATE `subjecttable` SET subject_name = ? , subjectcode = ?, updated_date = now() WHERE subject_id = ?");
               $stmt3->execute(array($nameofclass,$numofclass,$id));

               $num = 1;
            }else{
                echo "code of subject already excist try to change it please";
            }
               }
    ?>
    <h2 class='text-center mb-3 mt-5'>edit subject  </h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?do=edit&classid='.$row['subject_id'].'';  ?>" method='POST' class='createclassform'>
    <div class="form-group">
    <input type="text" name='nameofsubject' value='<?php echo $row['subject_name'] ;?>' class='form-control' required placeholder='please enter name of subject' />
    </div>
    <div class="form-group">
    <input type="text" name='codeofsubject' class='form-control' value='<?php echo $row['subjectcode'] ;?>' required  placeholder='enter code of subject'/>
    </div>
    
    <input type="submit"  class='btn btn-dark btn-block'  />
    </form>
    <?php
    if($num){
        echo "<div class='alert alert-success mt-2'> 1 class has been updated </div>";
        header("REFRESH:4");
     
    }
           }else{
            echo "<div class='alert alert-danger'> you are not authorized to be here 222 </div>";
            redirectfunction();
           }
    }else{
        echo "<div class='alert alert-danger'> you are not authorized to be here </div>";
        redirectfunction();
    }
}
else if($do == 'add'){

    $num = 0;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nameofclass = $_POST['nameofsubject'];
        $numofclass = strtoupper($_POST['codeofsubject']);
       
        $stmt2 =  $db->prepare("SELECT * FROM `subjecttable` WHERE subjectcode = ?");
        $stmt2->execute(array($numofclass));
        $count = $stmt2->rowCount();
        if($count == 0){
        $stmt = $db->prepare("INSERT INTO `subjecttable`(subject_name,adding_date,subjectcode,status) VALUES(:zname,now(),:znum,1)");
        $stmt->execute(array(
            "zname" => $nameofclass,
            "znum" =>$numofclass
           
        ));
       $num = 1;
    }else{
        echo "code of subject already excist try to change it please";
    }
    }




////////////////////////////////

    ?>
    <h2 class='text-center mb-3 mt-5'>create subject  </h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?do=add';  ?>" method='POST' class='createclassform'>
    <div class="form-group">
    <input type="text" name='nameofsubject' class='form-control' required placeholder='please enter name of subject' />
    </div>
    <div class="form-group">
    <input type="text" name='codeofsubject' class='form-control' required  placeholder='enter code of subject'/>
    </div>
    
    <input type="submit"  class='btn btn-dark btn-block'  />
    </form>
    <?php
if($num){
    echo "<div class='alert alert-success mt-2'> 1 class has been inserted </div>";
    header("REFRESH:4");
 
}
    
}else{
    echo "<div class='alert alert-danger'> you are not authorized to be here </div>";
    redirectfunction();
}





?>


<?php
include 'includes/templates/footer.php';
ob_end_flush();
?>