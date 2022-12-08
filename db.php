<?php

  $con = mysqli_connect("localhost","root","","eventscheduling");
  // Check connection
  if (mysqli_connect_errno())
    {
    echo "<h1>Failed to connect to MySQL:</h1>" . mysqli_connect_error();
    }

?>