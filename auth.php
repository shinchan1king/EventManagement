<?php
    session_start();
    if(!isset($_SESSION["username"]))
    {
        echo"<script>window.location.replace('login.php');</script>";
        exit();
    }
?>