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

    echo "<h2 class='text-center mt-5 mb-5'> manage classes combinations </h2>";
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
$stmt = $db->prepare("SELECT subjectcombination.id, classess.class_name,classess.sectionofclass,subjecttable.subject_name FROM `subjectcombination` JOIN classess ON classess.class_id = subjectcombination.classid JOIN subjecttable ON subjecttable.subject_id = subjectcombination.subjectid ORDER BY subjectcombination.id $ordering ");
$stmt->execute();
$rows = $stmt->fetchAll();

?>
    <a class='atable' href='com.php?do=manage&order=<?php echo $ordering  ?>'> change order</a>
  
<table class="table table-dark table-striped">
    <tr>
        <td>#</td>
        <td>class and section</td>
        <td>subject</td>
     
        <td>action</td>
    </tr>
    <?php
 foreach($rows as $row){
      echo "<tr>";
echo "<td>" . $row['id']  . "</td>";
echo "<td>" . $row['class_name'] . " - " . $row['sectionofclass'] . "</td>";
echo "<td>" . $row['subject_name']  . "</td>";
echo "<td>" . "<a class='btn btn-danger deleteing mr-3' href='#'> delete </a>" . "</td>";
      echo"</tr>";
}
    ?>
</table>
</div>

<?php
}else if($do == 'add'){
    $stmt4 = $db->prepare("SELECT class_name,sectionofclass,class_id FROM `classess`");
    $stmt4->execute();
    $rows1 = $stmt4->fetchAll();
    ////////////////////
    $stmt5 = $db->prepare("SELECT subject_id,subject_name FROM `subjecttable`");
    $stmt5->execute();
    $rows2 = $stmt5->fetchAll();
    /*
foreach($rows1 as $row => $key){
    echo $key['class_name'] . $row;
}
*/
    
    $num = 0;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $class = $_POST['class'];
        $subject = $_POST['subject'];
       
      
        $stmt = $db->prepare("INSERT INTO `subjectcombination`(subjectid,classid,adding_date,status) VALUES(:zname,:znum,now(),1)");
        $stmt->execute(array(
            "zname" => $subject,
            "znum" =>$class
           
        ));
       $num = 1;
    
    }




////////////////////////////////

    ?>
    <h2 class='text-center mb-3 mt-5'>create combination  </h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?do=add';  ?>" method='POST' class='createclassform'>
    <div class="form-group">
  <select name="class" class='form-control' >
      <?php
        foreach($rows1 as $row => $key){
            if($row == 0){
                echo "<option value=". $key['class_id'] ." selected>" . $key['class_name'] . " - " . $key['sectionofclass'] . "</option>";
            }else{
                echo "<option value=". $key['class_id'] ." >" . $key['class_name'] . " - " . $key['sectionofclass'] . "</option>";
            }
        }

?>
  </select>
    </div>
    <div class="form-group">
    <select name="subject" class='form-control' >
      <?php
        foreach($rows2 as $row => $key){
            if($row == 0){
                echo "<option value=". $key['subject_id'] ." selected>" . $key['subject_name']  . "</option>";
            }else{
                echo "<option value=". $key['subject_id'] ." >" . $key['subject_name']  . "</option>";
            }
        }

?>
  </select>
    </div>
    
    <input type="submit"  class='btn btn-dark btn-block'  />
    </form>
    <?php
    
if($num){
    echo "<div class='alert alert-success mt-2'> 1 combination  has been inserted </div>";
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