<?php
ob_start();
session_start();
$title = 'dashboard';
include "init.php";
?>
<?php
echo "<h2 class='text-center mt-5 mb-5'> manage results </h2>";
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
$stmt = $db->prepare("SELECT results.studentid,results.id,classess.class_name,classess.sectionofclass,students.status,students.Rollid,students.name FROM results INNER JOIN classess ON results.classid = classess.class_id INNER JOIN students ON results.studentid = students.id GROUP by results.studentid ORDER BY results.id $ordering");
$stmt->execute();
$rows = $stmt->fetchAll();

?>
    <a class='atable' href='manageresults.php?order=<?php echo $ordering  ?>'> change order</a>
  
<table class="table table-dark table-striped">
    <tr>
        <td>#</td>
        <td> NAME</td>
        <td>rollid</td>
        <td>class</td>
        <td>action</td>
        <td> status</td>
       
    </tr>
    <?php
 foreach($rows as $row){
     if($row['status'] == 1){
         $x = "active";
     }else{
         $x = "blocked";
     }
      echo "<tr>";
echo "<td>" . $row['studentid']  . "</td>";
echo "<td>" . $row['name']  . "</td>";
echo "<td>" . $row['Rollid']  . "</td>";
echo "<td>" . $row['class_name'] . " - " . $row['sectionofclass'] . "</td>";
echo "<td>" . "<a href='editresults.php?id=". $row['studentid'] ."' class='btn btn-success'> edit </a>"  . "</td>";

echo "<td>" . $x  . "</td>";

      echo"</tr>";
}
    ?>
</table>
</div>







<?php
include 'includes/templates/footer.php';
ob_end_flush();
?>