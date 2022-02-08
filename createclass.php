<?php
ob_start();
session_start();
$title = 'createclass';

include "init.php";
$num = 0;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nameofclass = $_POST['nameofclass'];
    $numofclass = $_POST['numofclass'];
    $sectionofclass = $_POST['sectionofclass'];
    $stmt2 =  $db->prepare("SELECT * FROM `classess` WHERE numofclass = ?");
    $stmt2->execute(array($numofclass));
    $count = $stmt2->rowCount();
    if($count == 0){
    $stmt = $db->prepare("INSERT INTO `classess`(class_name,adding_date,numofclass,sectionofclass,status) VALUES(:zname,now(),:znum,:zsection,1)");
    $stmt->execute(array(
        "zname" => $nameofclass,
        "znum" =>$numofclass,
        "zsection" => $sectionofclass
    ));
   $num = 1;
}else{
    echo "num of class already excist try to change it please";
}
}






?>

<h2 class='text-center mb-3 mt-5'>create class  </h2>
<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method='POST' class='createclassform'>
<div class="form-group">
<input type="text" name='nameofclass' class='form-control' required placeholder='please enter name of class' />
</div>
<div class="form-group">
<input type="number" name='numofclass' class='form-control' required  placeholder='enter num of class'/>
</div>
<div class="form-group">
<input type="text" name='sectionofclass' class='form-control' required placeholder='enter section of class' />
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