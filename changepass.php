<?php
ob_start();
session_start();
$title = 'dashboard';
include "init.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $newpass2 = $_POST['newpass2'];
    if($newpass !== $newpass2){
            echo "password do not match";
    }else{
            $oldsha = sha1($oldpass);
            $stmt = $db->prepare("SELECT * FROM `admintable` WHERE password = ?");
            $stmt->execute(array($oldsha));
            $count = $stmt->rowCount();
            $row = $stmt->fetch();
            $id = $row['id'];
            if($count == 0){
                echo "you entered wrong password";
            }else{
                $newsha = sha1($newpass);
                $stmt2 = $db->prepare("UPDATE `admintable` SET PASSWORD = ? WHERE id = ?");
                $stmt2->execute(array($newsha,$id));
                echo "password has been changed";
            }
    }
}






?>



<h2 class='text-center mb-3 mt-5'>change pass  </h2>
<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method='POST' class='logins'>
<div class="form-group">
<input type="password" name='oldpass' class='form-control' required placeholder='enter old passsword' />
</div>
<div class="form-group">
<input type="password" name='newpass' class='form-control' required placeholder='enter new passsword' />
</div>
<div class="form-group">
<input type="password" name='newpass2' class='form-control' required placeholder='enter new passsword agian' />
</div>
<input type="submit"  class='btn btn-dark btn-block'  />
</form


<?php
include 'includes/templates/footer.php';
ob_end_flush();
?>