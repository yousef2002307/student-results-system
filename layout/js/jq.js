$(document).ready(function(){
  $(".deleteing").click(function(){
    return confirm("are you sure you want delete");
  });
  $(".logins select:first-of-type").change(function (e) { 
    let x = this.value;
    $(".inputs").load("getsubjects.php",{id:x});
   $(".student").load("getstudent.php",{id:x});
   $(".submit").load("forsubmitbutton.php",{id:x});
    
  });
  
});









