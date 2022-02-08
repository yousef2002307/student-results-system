<?php
ob_start();
session_start();
if(isset($_SESSION['name'])){
    header("Location:dashboard.php");
}
$title = 'Admin Login';
include "init.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['username'];
    $filtername = filter_var($name,FILTER_SANITIZE_STRING);
    $pass = $_POST['password'];
    $shapass = sha1($pass);
   $arrerr = array();
   if(empty($name)){
       $arrerr[] = "you can not leave field empty";
   }
    if(empty($pass)){
       $arrerr[] = "you can not leave pass empty";
   }

   if(empty($arrerr)){
       $stmt = $db->prepare("SELECT * FROM `admintable` WHERE adimnname = ? AND password = ? LIMIT 1");
       $stmt->execute(array($filtername,$shapass));
       $count = $stmt->rowCount();
       if($count == 1){
           
        $_SESSION['name'] = $filtername;
      
       header("Location:dashboard.php");
       }
   }
}

?>
<h1 class='login_h1'>
Student Result Management System
</h1>
<div class="logins">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="content">
                    <h4>for student </h4>
                    <p>Student Result Management System</p>
                    <span>search for result <a href="showresult.php">click here</a> </span>
                </div>
            </div>
            <div class="col-md-6 offset-md-1">
            <div class="content">
                    <h4>Admin Login </h4>
                    <p>Student Result Management System</p>
                  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method='POST'>
                <div class="row">
                    <div class="col-md-2">
                        <label>username</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="username" id="" class='form-control' placeholder='userName' autocomplete='off' />
                    </div>
                </div>

                <div class="mb-3"></div>
                <div class="row">
                    <div class="col-md-2">
                        <label>password</label>
                    </div>
                    <div class="col-md-10">
                        <input type="password" name="password" id="" class='form-control' placeholder='Password' autocomplete='off' />
                    </div>
                </div>
                    <div class="button">
                        <input type="submit" value="sign in" class='btn btn-success' />
                    </div>
                </form>
                </div>
                <footer>
                Copyright © SRMS

</footer>
            </div>
        </div>
        <?php
if(!empty($arrerr)){
    for( $i = 0;  $i < count($arrerr); $i++){
        echo "<div class='alert alert-danger'>" . $arrerr[$i] . "</div>";
    }
}

?>
    </div>
</div>

<?php
include 'includes/templates/footer.php';
ob_end_flush();
?>