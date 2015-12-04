<?php
include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();

$id=$user->get('id');
$email=$user->get('email');
$fname=$user->get('fname');
$lname=$user->get('lname');
$type=$user->get('type');


$semestersql=$db->prepare("SELECT * FROM Registration.Semester;");
$semestersql->execute();
$semester=$semestersql->fetchAll(PDO::FETCH_ASSOC);

$yearsql=$db->prepare("SELECT semesterYear FROM Registration.Semester group by semesterYear;");
$yearsql->execute();
$year=$yearsql->fetchAll(PDO::FETCH_ASSOC);


$y=$_POST['year'];
$s=$_POST['semester'];
$add=$_POST['addgrade'];

if(isset($_POST["btn-submit"]))
 {
//Select semester and year

			$sql=$db->prepare("SELECT * FROM Registration.Section WHERE Faculty_userID='".$id."' 
						AND semesterYear='".$y."' and semesterID='".$s."';");
			$sql->execute();
			$course = $sql->fetchAll(PDO::FETCH_ASSOC);


    echo $twig->render('grade.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											 'y' => $y, 's'=> $s, 'course'=>$course, 'err' => $err));

} else if(isset($_POST["button"])) 
{
	$arr=explode("-",$_POST['course']);
	$sql=$db->prepare("SELECT Student_userID, fName, lName FROM Registration.Enrollment e
		join Registration.User u
		on u.userID=e.Student_userID
		WHERE sectionID=".$arr[1]." AND CourseID=".$arr[0].";");
	$sql->execute();
	$result=$sql->fetchAll(PDO::FETCH_ASSOC);
 


 	echo $twig->render('graderoster.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											 'y' => $y, 's'=> $s, 'roster'=>$result,  'err' => $err));
var_dump($result);
} else if (false)
{
	
}else{
	echo $twig->render('fgrade.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											 'year' => $year, 'semester'=> $semester));
}