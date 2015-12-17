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
$edit=$_POST['editclass'];


$semestersql=$db->prepare("SELECT * FROM Registration.Semester;");
$semestersql->execute();
$semester=$semestersql->fetchAll(PDO::FETCH_ASSOC);

$yearsql=$db->prepare("SELECT semesterYear FROM Registration.Semester group by semesterYear;");
$yearsql->execute();
$year=$yearsql->fetchAll(PDO::FETCH_ASSOC);
if(){
$value=$_POST['btn-submit'];
$arr=explode("-",$value);
//$arr[0] will be course
//$arr[1] will be section
}
if (isset($_POST['btn-edit'])) {
		if (isset($edit)) {
			$sql=$db->prepare("SELECT * FROM Registration.Enrollment e
								INNER JOIN Registration.Section s 
								ON (e.sectionID=s.sectionID and e.CourseID=s.CourseID)
								INNER JOIN Registration.Course c
								ON (c.CourseID=s.CourseID)
								INNER JOIN Registration.User u
			                    ON s.Faculty_userID=u.userID
								 where e.CourseID='".$CourseId."' and s.sectionID='".$sectionID."'';");
			$sql->execute();
			$schedule=$sql->fetchAll(PDO::FETCH_ASSOC);;
			echo $twig->render('edit2.html', array('CourseID'=>$CourseId,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
												 'sectionID' => $sectionID, 's'=> $s, 'data'=>$schedule, 'err' => $err));
	}

}

