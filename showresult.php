<?php
ob_start();

$title = 'results declartion';
include "init.php";
$do = '';
if(isset($_GET['do'])){
    $do = $_GET['do'];
}else{
    $do = "manage";
}

if($do == "manage"){
    ?>
    <h2 class='text-center'>show student results</h2>
<form action="?do=search" method='POST'>
<label>your rollid </label>

<input type='text' class='form-control' name='rollid'/>
<label>your class </label>
<select name = 'class' class='form-control mt-4'>
<?php
$stmt = $db->prepare("SELECT * FROM `classess`");
$stmt->execute();
$rows = $stmt->fetchAll();
foreach($rows as $row){
    echo "<option value=". $row['class_id'] .">" . $row['class_name'] . " - " . $row['sectionofclass'] . "</option>";
}


?>

</select>
<input type='submit' value='search' class='btn btn-danger btn-block btn-bg mt-4'/>
</form>

<?php
}else if($do == 'search'){
    $rollid = $_POST['rollid'];
    $class = $_POST['class'];
    $stmt = $db->prepare("SELECT * FROM students WHERE classid = ? AND Rollid = ?");
    $stmt->execute(array($class,$rollid));
    $count = $stmt->rowCount();
    $rows = $stmt->fetchAll();


    if($count == 0){
        echo "student not found ";
    }else{
        if($rows[0]['status'] == 1){
        ?>  
            <h1 class='text-center mt-5 mb-5'>student results details </h1>
        <?php
        $stmt2 = $db->prepare("SELECT results.*,students.*,classess.*,subjecttable.subject_name,subjecttable.subject_id FROM results INNER JOIN students ON results.studentid = students.id INNER JOIN classess ON results.classid = classess.class_id INNER JOIN subjecttable ON results.subjectid = subjecttable.subject_id WHERE students.id = ? AND classess.class_id = ?");
       $stmt2->execute(array($rows[0]['id'],$class));
       $rows2 = $stmt2->fetchAll();
       $count2 = $stmt2->rowCount();
       
       $i = 0;
       $degrees = 0;
       $fulldegree = $count2 * 100;
      ?>
      <p> student name : <span> <?php echo $rows2[0]['name'] ?> </span></p>
      <p> Rollid : <span> <?php echo $rows2[0]['Rollid'] ?> </span></p>
      <p> student class : <span> <?php echo $rows2[0]['class_name'] . " - " . $rows2[0]['sectionofclass'] ?> </span></p>
        <table class='table table-striped table-bordered table-hover'>
            <thead class="thead-dark">
            <td> # </td>
            <td> subject </td>
            <td> marks </td>

    </thead>
    <?php
    foreach($rows2 as $row){
        ++$i;
        $degrees = $degrees + $row['marks'];
        echo "<tr>" ;
        echo "<td>" . $i . "</td>";
        echo "<td>" . $row['subject_name'] . "</td>";
        echo "<td>" . $row['marks'] . "</td>";
        echo "</tr>";
    }

?>


    </table>

      <?php
      echo "total marks :  " . $degrees . " out of " . $fulldegree . "<br/>";
      echo "percentage : " . (($degrees / $fulldegree) * 100);
}else{
    echo "student is blocked from it is degrees";
}
    }

}







?>













<?php
include 'includes/templates/footer.php';
ob_end_flush();
?>