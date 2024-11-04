<?php

require_once 'db2.php';

function display_data(){
    global $con2;
    $query="select * from decrypteddata";
    $result=mysqli_query($con2,$query);
    return $result;

}   
?>
