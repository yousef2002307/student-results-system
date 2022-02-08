<?php
ob_start();
session_start();
$title = 'dashboard';
include "init.php";

if(isset($_GET['id'])){
    if(is_numeric($_GET["id"])){
        $id = intval($_GET['id']);
        $stmt = $db->prepare("SELECT * FROM `students` WHERE id = ?");
        $stmt->execute(array($id));
        $count = $stmt->rowCount();
        if($count == 1){
        ///////////////////////////////////////////////
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $marks = $_POST['mark'];
            $subjects = $_POST['subject'];
           foreach($marks as $key => $mark){
               $stmt3 = $db->prepare("UPDATE results SET marks = ? WHERE studentid = ? AND subjectid = ?");
               $stmt3->execute(array($mark,$id, $subjects[$key]));
             
           
           }
           echo "marks has been updated";
        }


        //////////////////////////////////////////////////
        $stmt = $db->prepare("SELECT students.name,students.id,classess.class_name,classess.sectionofclass,classess.class_id FROM students INNER JOIN classess ON students.classid = classess.class_id WHERE students.id= ?");

        $stmt->execute(array($id));
        $count = $stmt->fetch();
        ?>
        <form method='POST' action="<?php echo $_SERVER['PHP_SELF'] . "?id=". $id .""  ?>">
            class : <span> <?php echo $count['class_name'] . " - " . $count['sectionofclass'];   ?> </span>
            <br />
            name : <span> <?php echo $count['name']   ?> </span>
            <br />
            <?php
                $stmt2 = $db->prepare("SELECT results.*,subjecttable.* FROM results INNER JOIN subjecttable ON results.subjectid = subjecttable.subject_id WHERE results.studentid = ?");
                $stmt2->execute(array($id));
                $rows = $stmt2->fetchAll();
                foreach($rows as $row){
                    echo "<label>" . $row["subject_name"] . "</label>";
                    echo "<input type='number' name='mark[]' class ='form-control' value = ".$row['marks'] . " />";
                    echo "<input type='hidden' name='subject[]' class ='form-control' value = ".$row['subject_id'] . " />";
                }

                ?>

                <input type='submit' class='btn btn-primary btn-block btn-bg' />

        </form>

<?php

        }else{
            echo "<div class='alert alert-danger'> you are not authorized to be here </div>";
            redirectfunction();
        }
    }else{
         echo "<div class='alert alert-danger'> you are not authorized to be here </div>";
    redirectfunction();
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




