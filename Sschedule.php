<?php
require_once "sauthorize.php";
require 'vendor/autoload.php';
require_once "connection.php";
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];
$email=$_SESSION['email'];
$fname=$_SESSION['fname'];
$lname=$_SESSION['lname'];
$type=$_SESSION['type'];

$date=getdate();
$year=$date['year'];
$month=$date['mon'];

if ($month==1) {
	$semester='winter';
}elseif ($month>=2 and $month<=5) {
	$semester='spring';
}elseif ($month>=6 and $month<=7) {
	$semester='summer';
}elseif ($month>=8 and $month<=12) {
	$semester='fall';
}else{
	$semester=null;
}
$sql=$db->prepare("SELECT e.CourseID,e.sectionID,bldingName,roomNum,

case timeSlot_Day 
when 'MW' then '1,3'
when 'Th' then '2,4' end as day,

timeSlot_Time, 

case timeSlot_Time 
when '08:00:00' then '9:30:00'
when '9:40:00' then '10:10:00'
when '11:20:00' then '12:50:00'
when '13:00:00' then '14:30:00' 
when '15:50:00' then '16:20:00'
when '19:10:00' then '20:40:00'end as timeend
FROM Registration.Section s
inner join Registration.Enrollment e
on e.CourseID=s.CourseID and e.SectionID=s.SectionID
where semesterID='".$semester."' and semesterYear='".$year."'  and Student_userID='".$id."';");
$sql->execute();
$schedule = $sql->fetchAll(PDO::FETCH_ASSOC);


echo $twig->render('Sschedule.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											'schedule'=>$schedule));

?>