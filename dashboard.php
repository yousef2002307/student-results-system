<?php
ob_start();
session_start();
$title = 'dashboard';
include "init.php";








?>

<!-- -->

<div class="header">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="flag">
          <div class="row">
            <div class="col-md-6">
              <div class="i">
              <i class="fas fa-users"></i>
              </div>
            </div>
            <div class="col-md-6">
              <div class="content">
                    <span>6</span>
                    <p> reged users </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
      <div class="flag" style='background-color:#e74c3c'>
          <div class="row">
            <div class="col-md-6">
              <div class="i">
              <i class="fas fa-ticket-alt"></i>
              </div>
            </div>
            <div class="col-md-6">
              <div class="content">
              <a href='subjects.php'>  <span><?php getnumofcols("subjecttable","subject_id","status = 1");?></span> </a>
                    <p> subject listed </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
      <div class="flag" style='background-color:#f39c12'>
          <div class="row">
            <div class="col-md-6">
              <div class="i">
              <i class="fas fa-university"></i>
              </div>
            </div>
            <div class="col-md-6">
              <div class="content">
                  <a href='classes.php'>  <span><?php getnumofcols("classess","class_id","status = 1");?></span> </a>
                    <p> classes </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
      <div class="flag" style='background-color:green'>
          <div class="row">
            <div class="col-md-6">
              <div class="i">
              <i class="far fa-file"></i>
              </div>
            </div>
            <div class="col-md-6">
              <div class="content">
                    <span>6</span>
                    <p> result </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
include 'includes/templates/footer.php';
ob_end_flush();
?>