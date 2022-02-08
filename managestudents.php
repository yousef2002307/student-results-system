<?php
ob_start();
session_start();
$title = 'manage student';
include "init.php";
$x = '';



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
$stmt = $db->prepare("SELECT students.*,classess.class_name,classess.sectionofclass FROM students INNER JOIN classess ON students.classid = classess.class_id ORDER BY students.id $ordering");
$stmt->execute();
$rows = $stmt->fetchAll();

?>
    <a class='atable' href='managestudents.php?order=<?php echo $ordering  ?>'> change order</a>
  
<table class="table table-dark table-striped">
    <tr>
        <td>#</td>
        <td> NAME</td>
        <td>rollid</td>
        <td>email</td>
        <td>class</td>
        <td>status</td>
    </tr>
    <?php
 foreach($rows as $row){
     if($row['status'] == 1){
         $x = "active";
     }else{
         $x = "blocked";
     }
      echo "<tr>";
echo "<td>" . $row['id']  . "</td>";
echo "<td>" . $row['name']  . "</td>";
echo "<td>" . $row['Rollid']  . "</td>";
echo "<td>" . $row['email']  . "</td>";
echo "<td>" . $row['class_name'] . " - " . $row['sectionofclass'] . "</td>";
echo "<td>" . $x  . "</td>";

      echo"</tr>";
}
    ?>
</table>
</div>

<?php


?>
<?php
include 'includes/templates/footer.php';
ob_end_flush();
?>








