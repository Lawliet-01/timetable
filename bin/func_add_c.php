<?php
if(isset($_POST["cls"]) && isset($_POST["lec"]) && isset($_POST["rec"]) && isset($_POST["sec"]))
{
    if($_POST["cls"]!="" && $_POST["rec"]!="" && $_POST["lec"]!="" && $_POST["sec"]!="")
    {
        if(is_numeric($_POST["lec"]) && is_numeric($_POST["rec"])){
      include 'dbconn.php';
      $cname=$_POST["cls"]."-".$_POST["sec"];
      $lname = array("One", "Two", "Three" ,"Four","Five","Six","Seven" ,"Eight" ,"Nine" ,"Ten");
      $day =array('Monday' , 'Tuesday' ,'Wednesday' , 'Thrusday' ,'Friday','Saturday');
      $temp="";
       $qry="INSERT INTO `Classes`(`classid`) VALUES ('$cname')";
       $conn->query($qry);
       $subcid="SUB_".$cname;
       $qry="CREATE TABLE `$subcid` (
         sub Varchar(10),
         name Varchar(50),
         PRIMARY KEY (sub)
       )";
       $conn->query($qry);
       $qry="CREATE TABLE `$cname` (
          Day  Varchar(10),
          PRIMARY KEY (DAY)
        )";
        $conn->query($qry);
        for($i=0;$i<$_POST["rec"];$i++)
        {
          $qry ="ALTER TABLE `$cname` ADD  `$lname[$i]` Varchar(10)";
          $temp=$lname[$i];
          $conn->query($qry);
        }
        $qry ="ALTER TABLE `$cname` ADD Lunch  Varchar(1) AFTER  `$temp`";
        $conn->query($qry);
        $temp="Lunch";
        for($i=$_POST["rec"];$i<$_POST["lec"];$i++)
        {
          $qry ="ALTER TABLE `$cname` ADD  `$lname[$i]` Varchar(10) AFTER  `$temp`";
          $temp=$lname[$i];
          $conn->query($qry);
        }
        for($i=0;$i<6;$i++)
        {
          $qry ="INSERT into `$cname`(Day) values('$day[$i]')";
          $conn->query($qry);
        }
       echo "success";
     }
     else {
       echo "numeric";
     }
    }
    else {
      echo "unfilled";
    }
}
else {
  echo "error";
}

 ?>
