<?php
require_once "connection.php";
require 'vendor/autoload.php';
require_once "aauthorize.php";

$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
session_start();
$id=$_SESSION['id'];
$type=$_SESSION['type'];
$userid = $_POST['userid'];
$CourseID =$_POST['CourseID'];
$sectionID =$_POST['sectionID'];
$roomNum =$_POST['roomNum'];
$Faculty_userID =$_POST['Faculty_user'];
$bldingName =$_POST['bldingName'];
$timeSlot_Day =$_POST['timeSlot_Day'];
$timeSlot_Time =$_POST['timeSlot_Time'];
$semesterID =$_POST['semesterID'];
$semesterYear =$_POST['semesterYear'];
$changed =null;


		$sql=$db->prepare("SELECT * FROM Registration.Section;");
			$sql->execute();
			$edit=$sql->fetchAll(PDO::FETCH_ASSOC);
			
		if (isset($_POST['btn-submit'])){
		if (($CourseID != "0") && ($CourseID ="CourseID") && ($timeslot_Time != "timeSlot_Time")){

		$sql=$db->prepare ("Insert into Section (CourseID , sectionID , roomNum , Faculty_userID , bldingName , timeSlot_Day , timeSlot_Time, semesterID , semesterYear)
							VALUES ( '".$CourseID."' , '".$sectionID."' , '".$roomNum."' , '".$Faculty_userID."' , '".$bldingName."', '".$timeSlot_Day."',
'".$timeSlot_Time."' , '".$semesterID."' , '".$semesterYear."');");
			$sql->execute();
			echo "Course successfully created";
			$changed= true;
		}
			else {
			echo "Error: " ; //need to output an error
			$changed= false;
	}
	}

echo $twig->render('editcourse.html', array("id" =>$id, "courseID"=> $CourseID, "type" => $type, "changed" => $changed));




?>