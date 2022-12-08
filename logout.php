<?php
session_start();

if(session_destroy())
{
// Redirecting To Home Page
echo "<script>
window.location.replace('login.php');</script>";
}
?>