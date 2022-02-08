<?php
ob_start();
session_start();
$title = 'dashboard';
include "init.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $class = $_POST['class'];
    $student = $_POST['student'];
    $subjects = $_POST['subject'];
    //////////////////////////////////
   
    

    ////////////////////////////
    $stmt5 = $db->prepare("SELECT subjecttable.subject_name,subjectcombination.subjectid FROM subjecttable INNER JOIN subjectcombination ON subjecttable.subject_id = subjectcombination.subjectid WHERE subjectcombination.classid = ?");
    $stmt5->execute(array($class));
    $rows = $stmt5->fetchAll();
   foreach($rows as $key => $value){

       $stmt9 = $db->prepare("INSERT INTO `results` (`classid`, `studentid`, `subjectid`, `marks`) VALUES (:zclass,:zstudent,:zsubject,:zmarks);");
        $stmt9->execute(array(
            "zclass" => $class,
            "zstudent" => $student,
            "zsubject" => $value['subjectid'],
           "zmarks" => $subjects[$key]
        ));
   }
   header("Location:results2.php");

}else{
    echo "<span class='badge badge-primary'>  hello </span> ";
}






?>
<form class='logins' method='POST' action="<?php echo $_SERVER['PHP_SELF'];   ?>">
    <label> classes </label>
<select name='class' class='form-control class'>
    <option value='0'>....</option>
<?php
$stmt = $db->prepare("SELECT * FROM `classess`");
$stmt->execute();
$rows = $stmt->fetchAll();
foreach($rows as $row){
    echo "<option value=". $row['class_id'] .">" . $row['class_name'] . " - " .$row['sectionofclass'] . "</option>";
}


?>

</select>
<label> students </label>
<select name='student' class='form-control student' required>


</select>
<label>subjects </label>
<div class='inputs'>


</div>
<div class='submit'>

</div>
</form>

<?php
include 'includes/templates/footer.php';
ob_end_flush();
?>