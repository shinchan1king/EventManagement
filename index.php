<?php
  include("auth.php");
?>
<!DOCTYPE html>
<html>
  <head>

  <meta charset="utf-8">
  <title>
  InterViewScheduling
  </title>
  <link rel="stylesheet/less" type="text/css" href="style.less" />
  <script src="https://cdn.jsdelivr.net/npm/less" ></script>
  <style>div {
    display: flex;
    justify-content: space-between;
  }</style>
      </head>
<body>
<article class="leaderboard">
    <header>
      <h1 class="leaderboard__title" style="position:top,top margin:20%;"><span class="leaderboard__title--top">Event Schedule</span><span class="leaderboard__title--bottom">Schedule</span></h1>
    </header>
    </br>
    </br>
    </br>
    <div style="margin:auto">
    <article class="leaderboard__profile">
      <a href="sinterview.php"> <img src="interview.png" class="leaderboard__image" > </img></a>
      <h3 class="leaderboard__comment"> Schedule an Event</h3>
    </article>
    <article class="leaderboard__profile2" style="margin-left:55px">
      <a href="canditate.php"> <img src="interview List.jpg" class="leaderboard__image"> </img></a>
      <h3 class="leaderboard__comment"> Check the List</h3>
    </article>
    <article class="leaderboard__profile2">
      <a href="hosted.php"> <img src="hostedbyme.jpg" class="leaderboard__image"> </img></a>
      <h3 class="leaderboard__comment"> Hosted by You</h3>
    </article>
    </div>
    <a href="logout.php"><button class='leaderboard__button' style='margin-left:45%'>Logout</button></a>
    </article>

</body>
</html>
