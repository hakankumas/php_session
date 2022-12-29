<?php
session_start();
if(isset($_SESSION["username"])){
    echo 'login success '.$_SESSION["username"].'';
    echo "<a href='index.php'>logout</a>";

}else{
    header("location:'index.php'");
}
?>