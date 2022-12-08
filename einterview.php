<?php
include('auth.php');
require('db.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="Login_v1/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/css/util.css">
	<link rel="stylesheet" type="text/css" href="Login_v1/css/main.css">
    <script>

            var expanded = false;
            function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
            }
    </script>
    <style>
            .multiselect {
        width: 300px;
        }

        .selectBox {
        position: relative;
        }

        .selectBox select {
        width: 100%;
        font-weight: bold;
        }

        .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        }

        #checkboxes {
        display: none;
        border: 1px #dadada solid;
        }

        #checkboxes label {
        display: block;
        }

        #checkboxes label:hover {
        background-color: #1e90ff;
        }
    </style>
</head>
<body>
<?php

if (isset($_POST['select'])){
    date_default_timezone_set('Asia/Kolkata');
    $d=$_POST['select'];
    $date=$_POST['date'];
    $start=$_POST['s_time'];
    $end=$_POST['e_time'];
    echo sizeof($_POST['select']);
    echo "hii";
    $boo=false;
    $time=false;
    $k=false;
    if($start>$end)
    {
        $time=true;
        $boo=true;
    }
    //echo $date;
    //echo date('20y-m-d');
    if($date<date('20y-m-d'))
    {
        $k=true;
        $boo=true;

    }
    if($boo || sizeof($d)<2)
    {
        $boo=true;
    }
    foreach($_POST['select'] as $sel)
	{
        $IID=$_SESSION["IID"]-'0';
	    $query = "SELECT start_time,end_time,date FROM `scheduled` WHERE username = '$sel' AND interviewid<>$IID ";
	    $result =mysqli_query($con,$query) or die(mysql_error());;
	  
        while($row=mysqli_fetch_array($result))
        {
            if($date==$row['date'] &&( ($start>=$row['start_time'] && $start<$row['end_time'])||($end>$row['start_time'] && $end<=$row['end_time']) ||($end>$row['start_time'] && $start<$row['start_time'])||($end>$row['end_time'] && $start<$row['end_time'])))
            {
                $boo=true;
                break;
            }
        }
   if($boo)
   {
    break;
   }
    
    }
    if($boo==false && sizeof($_POST['select'])>=2)
        {
            $query="DELETE From scheduled where interviewid=$IID";
            $result = mysqli_query($con,$query) or die(mysql_error());
           $user=$_SESSION['username'];
            foreach($_POST['select'] as $sel)
            {
                
                $query="INSERT INTO `scheduled` (`username`, `interviewid`, `start_time`, `end_time`, `date`,`createdby`) VALUES ('$sel', $IID, '$start' ,'$end','$date','$user')";
                $result   = mysqli_query($con, $query);
            }
            echo " <script>alert('edited successfully');
                window.location.replace('canditate.php');
            </script>";
        }
     else{
        if($time)
        {
         echo "
         <script>alert('please select valid start and end time');
         window.location.replace('einterview.php');</script>";
        }
        
       else if($k)
        {
         echo "
         <script>alert('please do not select past date');
         window.location.replace('einterview.php');</script>";
        }
        
       else  if(sizeof($_POST['select'])<2)
         {
             echo "
                 <script>alert('please select atleast two users');
                 window.location.replace('einterview.php');</script>";
         }
         else
         {
                 echo "
                 <script>alert('schedule already exists');
                 window.location.replace('einterview.php');</script>";
         }
        }
    
}
else{ ?>

<div class="limiter" >
		<div class="container-login100" >
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="Login_v1/images/img-01.png" alt="IMG">
				</div>
                <?php
                $IID=$_SESSION["IID"]-'0';
                $query="SELECT `start_time`,`end_time`,`Date` FROM `scheduled` WHERE interviewid=$IID";
                $result=mysqli_query($con,$query);
                $row=mysqli_fetch_array($result);
                $s_time=$row['start_time'];
                $e_time=$row['end_time'];
                $date=$row['Date']
                ?>
				<form class="login100-form validate-form" action="" method="POST" name="schedule">
					<span class="login100-form-title">
						Edit Event </br>Event ID <?php echo $_SESSION["IID"];?>
					</span>

					<div class="wrap-input100 validate-input" >
                    <h4 > Select Date</h4>
						<input class="input100" type="date" name="date" placeholder=<?php
                        echo $date?>>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-date" aria-hidden="true"></i>
						</span>
					</div>
                    <div class="wrap-input100 validate-input" >
                    <h4 > Start Time</h4>
						<input class="input100" type="time" name="s_time" placeholder=<?php
                        echo $s_time?>>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							
						</span>
                        
					</div>

                    <div class="wrap-input100 validate-input" >
                    <h4 > End Time</h4>
						<input class="input100" type="time" name="e_time" placeholder=<?php
                        echo $e_time?>>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
						</span>
					</div>
                    <div class="wrap-input100 validate-input"  >
                    <div class="multiselect"  >
                    <div class="selectBox" onclick="showCheckboxes()">
                    <select class='input100' >
                        <option>select user</option>
                    </select>
                    <div class="overSelect"></div>
                    </div>
                    <div id="checkboxes" >

                     <?php
                        
                        $query="Select username from canditates ";
                        $result = mysqli_query($con,$query) or die(mysql_error());
	                   
                        while($row = mysqli_fetch_array($result))
                        {
                            $usern=$row['username'];
                            echo "
                            <input type='checkbox' name='select[]'  value=$usern ><label>$usern</label>
                        
                            ";
                        }
                        ?>
                    
                            <span class='focus-input100'></span>
                            <span class='symbol-input100'>
                              
                            </span>
                    </div>
					</div>
                    </div>
                    
					
					<div class="container" >
                        <table><td>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Edit 
						</button>
                        
                    </div ></td>
                        <td >
                        <div class="container-login100-form-btn" style="margin-left:10px;">
                        <a href="index.php"  class="login100-form-btn"> 
                        Main Page
                    </a>
					    </div>
                    </td></table>
                    </div>
                   
					
				</form>
                
			</div>
		</div>
	</div>
	
	


	<script src="Login_v1/vendor/jquery/jquery-3.2.1.min.js"></>
	<script src="Login_v1/vendor/bootstrap/js/popper.js"></scrip>
	<script src="Login_v1/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="Login_v1/vendor/select2/select2.min.js"></script>
	<script src="Login_v1/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="Login_v1/js/main.js"></script>


				
	<?php } ?>
</body>
</html>