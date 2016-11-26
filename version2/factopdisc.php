<?php
session_start();
include_once 'dbconnect.php';

?>
<html>
<head>
<style>

body {
    /*background-color: lightblue;
    text-align: center;         /* make sure IE centers the page too */
}

#wrapper {
    width: 900px;
    margin: 0 auto;             /* center the page */
}

#content {
    background-color: #fff;
    border: 1px solid #000;
    float: left;
    font-family: Arial;
    padding: 20px 30px;
    text-align: left;
    width: 100%;                /* fill up the entire div */
}

#menu {
    float: left;
    border: 1px solid #000;
    border-bottom: none;        /* avoid a double border */
    clear: both;                /* clear:both makes sure the content div doesn't float next to this one but stays under it */
    width:100%;
    height:20px;
    padding: 0 30px;
    background-color: #FFF;
    text-align: left;
    font-size: 85%;
}

#menu a:hover {
    background-color: #009FC1;
}

#userbar {
    background-color: #fff;
    float: right;
    width: 250px;
}

#footer {
    clear: both;
}

/* begin table styles */
table {
    border-collapse: collapse;
    width: 100%;
}

table a {
    color: #000;
}

table a:hover {
    color:#373737;
    text-decoration: none;
}

th {
    background-color: green;
    color: #F0F0F0;
}

td {
    padding: 5px;
}

/* Begin font styles */
h1, #footer {
    font-family: Arial;
    color: #F1F3F1;
}

h3 {margin: 0; padding: 0;}

/* Menu styles */
.item {
    background-color: #00728B;
    border: 1px solid #032472;
    color: #FFF;
    font-family: Arial;
    padding: 3px;
    text-decoration: none;
}

.leftpart {
    width: 70%;
}

.rightpart {
    width: 30%;
}

.small {
    font-size: 75%;
    color: #373737;
}
#footer {
    font-size: 65%;
    padding: 3px 0 0 0;
}

.topic-post {
    height: 100px;
    overflow: auto;
}

.post-content {
    padding: 30px;
}

textarea {
    width: 500px;
    height: 200px;
}
</style>
<meta content="width=device-width, initial-scale=1.0" name="viewport" >
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<head>
<body>

  <nav class="container" >
      <div class="">
          <div class="navbar-header">

              <a class="navbar-brand" href="index.php"></a>
          </div>
          <!-- <div class="collapse navbar-collapse" id="navbar1">
              <ul class="nav navbar-nav navbar-right">
                  <?php if (isset($_SESSION['usr_id'])) { ?>
                  <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                  <li><a href="logout.php">Log Out</a></li>

                  <li><a href="login.php"></a></li>
                  <li><a href="register.php"></a></li>
                  <?php } ?>
              </ul>
          </div> -->

            	<a href="index.php"><img src="images/logo3.png" width="200px" height="120px" title="logo" /></a>

              <ul class="nav navbar-nav navbar-right">
                  <?php if (isset($_SESSION['usr_id'])) { ?>
                  <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name'];
                  $u=$_SESSION['usr_id'] ;?></p></li>
                  <li><a href="logout.php">Log Out</a></li>

                  <li><a href="login.php"></a></li>
                  <li><a href="register.php"></a></li>
                  <?php } ?>
              </ul>
          </div>
      </div>
  </nav>
<div class='container'>
<?php

$cid=$_GET['tid'];
include_once 'dbconnect.php';
 if (isset($_SESSION['usr_id']))
  {
  	//echo $_SESSION['usr_id'];
  	$id=$_SESSION['usr_id'];
        $n=$_SESSION['n1'] ;
  }
  $p=$_SESSION['cid1'];
   $_SESSION['cid1']=$cid;
  echo "<left><button class='btn btn-primary' href=faccurdisc.php>BACK</a></button></left><br><br>";
  $res1=mysqli_query($con,"select * from topicsstu where topic_id=$cid");
  $n1=mysqli_fetch_array($res1);
   $sid=$n1['topic_by'];
      $dat=$n1['topic_date'];
      $n11= $n1['topic_description'];
   echo "<tr>";
   if(mysqli_num_rows($res1)!=0)
   {
       $a1=mysqli_query($con,"select * from students where sid=$sid");
       $a2=mysqli_fetch_array($a1);
       $name=$a2['Name'];
  echo '<table border="1">
                      <tr>
                        <th>DOUBT</th>
                        <th>Created by</th>
                      </tr>';
echo "<tr>";
  echo "<td>";
echo "$n11";
  echo "</td>";
  echo "<td>";
  echo "$name on $dat";
    echo "</td>";
echo "</tr>";
echo "</table>";
   $r1=mysqli_query($con,"select * from posts where post_topic=$cid order by post_date");
   echo "<br><br>";
  echo '<table border="1">
                      <tr>
                        <th>DISCUSSED</th>
                        <th>Created by</th>
                      </tr>';
  while($n=mysqli_fetch_array($r1))
  {
  	$sid1=$n['post_by'];
  	$a11=mysqli_query($con,"select * from students where sid=$sid1");
       $a22=mysqli_fetch_array($a11);
     $post=  $n['post_content'];
     $name=$a22['Name'];
     $dat= $n['post_date'];
 echo "<tr>";
  echo "<td>";
echo "$post";
  echo "</td>";
  echo "<td>";
  echo "$name on $dat";
    echo "</td>";
echo "</tr>";

  }
 echo " </table>";
echo "<br><br>";
  }
?>

<form method="GET" action="<?php echo "topicdiscf.php?tid=$cid" ;?>">
<textarea name="reply-content"></textarea>
<input type="submit" name="submit" value="Submit" class='btn btn-primary' />
</form>
</body>
</html>
