<?php

require_once 'db1.php';

function display_data(){
    global $con1;
    $query="select * from encrypteddata";
    $result=mysqli_query($con1,$query);
    return $result;

}   
?>
