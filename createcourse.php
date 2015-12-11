<?php
require_once "connection.php";
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get("type");

$CourseID= $_POST['CourseID'];
$courseNAme= $_POST['courseName'];
$Credits= $_POST['Credits'];
$deptID= $_POST['deptID'];
$Type= $_POST['Type'];

$test=$db->prepare("SELECT * FROM Registration.Course;");
$test->execute();
$course=$test->fetchAll(PDO::FETCH_ASSOC);


		if (isset($_POST['btn-submit']) && ($CourseID != null) || ($CourseID != "CourseID" )){

		$sql=$db->prepare ("Insert into Course (CourseID , courseName , Credits , deptID , Type )
			VALUES ( '".$CourseID."' , '".$courseName."' , '".$Credits."' , '".$deptID."' , '".$Type."' );");
			$sql->execute();
			echo "Course successfully created";
		}
			else {
			echo "Error: " ; //need to output an error
	}



echo $twig->render('createcourse.html', array("id" =>$id, "courseID"=> $CourseID, "type" => $type));




?>