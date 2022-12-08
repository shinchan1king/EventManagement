<?php
    include('auth.php');
?>
<!DOCTYPE html>
    <head>
        <title>
            Hosted BY You
        </title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet/less" type="text/css" href="css/style.less" />
        <script src="https://cdn.jsdelivr.net/npm/less" ></script>
    </head>
<body>
    <?php
        require('db.php');
        if (isset($_POST['button']))
        {
            $id=$_POST['button'];
            $query3="DELETE FROM scheduled WHERE interviewid='$id'";
            $result2=mysqli_query($con,$query3);
        if($result2)
        {
            echo "<script> alert('item deleted successfully')
            </script>
            ";
            
        }
        }
        if(isset($_POST['button2']))
        {
            $_SESSION['IID']=$_POST['button2'];
            echo"<script>window.location.replace('einterview.php');</script>";
        }
    ?>
<article class="leaderboard">
  <header>
    <h1 class="leaderboard__title"><span class="leaderboard__title--top">Event</span><span class="leaderboard__title--bottom">List</span></h1>
  </header>
  <div style="width: 100%;
  height:75px;
display: flex;
flex-direction: row;
justify-content: center;
">
  <form action="" method="post" style="display:flex;flex-direction:row"   >
    <input type="text" name="search" style="text-color:black;width:120px;height:30px;border-radius:5px;margin-top:20px" placeholder="search by name" required/>
    <button  class="leaderboard__button" name="searchb" style="margin-left:5px;margin-top:18px;width:35px;height:20px" value="SORT">Search</button></form>
    <form action="" method="post" style="margin-left:50px;display:flex;flex-direction:row" >
    <input type="date" name="search2" style="text-color:black;width:120px;height:30px;border-radius:5px;margin-top:20px"required/>
    <button  class="leaderboard__button" name="searchd" style="margin-left:5px;margin-top:18px;width:35px;height:20px" value="SORT">Search</button></form>
    
    <form action="" method="post">
    <button  class="leaderboard__button" name="sort" style="margin-left:50px;margin-top:18px;width:35px;height:20px" value="SORT">SORT</button>
    </form>
    

   
        
   
    </div>
  <main class="leaderboard__profiles">
   <?php
        if (!isset ($_GET['page']) ) {  
            $page = 1;  
        } else {  
            $page = $_GET['page'];  
        }  
        $username=$_SESSION['username'];
        $query="SELECT * FROM `scheduled` WHERE createdby = '$username' Group By interviewid " ;
        if(isset($_POST['sort']))
        {
            $query="SELECT * FROM `scheduled` WHERE createdby = '$username' Group By interviewid order by  date asc,start_time asc " ;
        }
         if(isset($_POST['searchb']))
        {
            $se=$_POST['search'];
            $query="SELECT * FROM `scheduled` where interviewid in  (select  interviewid from scheduled where createdby='$username')  and username like '%$se%' Group by interviewid ";

        }
         if(isset($_POST['searchd']))
        {
            $da=$_POST['search2'];
            $query="SELECT * FROM `scheduled` WHERE createdby = '$username' and `date`='$da' Group by interviewid " ;
            
        }
        $result = mysqli_query($con,$query) or die(mysql_error());
        $results_per_page=2;
        $page_first_result = ($page-1) * $results_per_page; 
        $number_of_result = mysqli_num_rows($result);
        $number_of_page = ceil ($number_of_result / $results_per_page); 
        $query=$query." LIMIT $page_first_result,$results_per_page";
        
        $result = mysqli_query($con,$query) or die(mysql_error());
        while($row2 = mysqli_fetch_array($result))
        {
            $user=$row2['username'];
            $iid=$row2['interviewid'];
             $query="SELECT username FROM `scheduled` WHERE username <> '$username' and interviewid='$iid'";
            $result1 = mysqli_query($con,$query) or die(mysql_error());
          
            $user="";
            while($row1 = mysqli_fetch_array($result1))
            {$user=$user." ".$row1['username'];}
            $stime=$row2['start_time'];
            $etime=$row2['end_time'];
            $date = $row2['date'];
            $createdby=$row2['createdby'];
            echo "
            <article class='leaderboard__profile' >
            
            <span class='leaderboard__name' >Event Id. $iid</span>
            <span class='leaderboard__name' >Uses Invited : $user</span>
            
            <span class='leaderboard__name' >Created BY : $createdby</br>Date: $date</span>
           
            </br>
        
            <div>
            <span class='leaderboard__value' style='font-size:30px;margin-left:0px;' >start time : $stime<span></span></span>
            
            
            <span class='leaderboard__value' style='font-size:30px;margin-left:150px'>end time : $etime<span></span></span>
            
            </div>
            </br>
            </br>";
            
            if($createdby==$_SESSION['username'])
            {echo"
            <form class='' action='' method='post' name='delete'>
                ";
           
            echo"
            <div class='container'>
            <table >
            <td>
            <div>
                <button class='leaderboard__button' name='button' style='margin-left:45%' value=$iid>
                Delete 
            </button>
            </div></td>
            <td >
            <div >
            <button class='leaderboard__button' name='button2' style='margin-left:45%' value=$iid >
                Edit
            </button>
            </div>
            </td>
            </table>
            </div>
            </form>";
            }
            echo"

        </article>
        ";
        }
      echo"  <div style='display: flex;
flex-direction: row;
margin:auto'>";

   for($page = 1; $page<= $number_of_page; $page++) {  
    echo '<button class="leaderboard__button" style="width:10px;height:10px"> <a style="color:white" href = "hosted.php?page=' . $page . '">' . $page . ' </a></button>';
   
}
echo "
</div>
<div class='container' style='margin:auto'><table ><td><a href='index.php'><button class='leaderboard__button' >Main Page</button></a></td>
   <td><a href='login.php'><button class='leaderboard__button' style=''>Logout</button></a></td></table></div>
   <br>
   ";
?>
  </main>
</article>


</body>

</html>