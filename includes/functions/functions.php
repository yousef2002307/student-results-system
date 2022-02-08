<?php
function gettitle(){
    global $title;
    if($title){
        return $title;
    }else{
        return "Default";
    }
};



////////////////redirect function //////////////////////////
function redirectfunction($sec = 3){
    $url = 'index.php';
    if(isset($_SERVER['HTTP_REFERER'])){
            $url = $_SERVER['HTTP_REFERER'];
    }
    header("REFRESH:$sec,URL=$url");
    exit();
}


/////////////function to get num of columns////////////////////////
function getnumofcols($table,$item,$where){
    global $db;
$stmt = $db->prepare("SELECT count($item) FROM $table WHERE $where");
$stmt->execute();
$t = $stmt->fetchColumn();
echo $t;

}



?>