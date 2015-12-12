<?php
require_once "fauthorize.php";
include_once "connection.php";
require 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
//memcache only stores this data any other data you need will need to be queried
//previously you had other variables that wherent in memcache
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



 // i changed the + to . i dont know why but its the only way that works.

if(isset($_POST["btn-submit"]))
 {
//add grades

			$sql=$db->prepare("SELECT * FROM Registration.Section WHERE Faculty_userID='".$id."' 
						AND semesterYear='".$y."' and semesterID='".$s."';");
			$sql->execute();
			$course = $sql->fetchAll(PDO::FETCH_ASSOC);


    echo $twig->render('grade.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											 'y' => $y, 's'=> $s, 'course'=>$course, 'err' => $err));

} else if(isset($_POST["button"])){
	$gradesubmit=false;
	if (isset($_POST["grade"])) {
		$section=$_POST["section"];
		$course=$_POST["course"];
		$Grade=$_POST['grade'];

		foreach ($Grade as $key => $value) {
			$arr=explode("-", $value);
			$sql=$db->prepare("UPDATE Registration.Enrollment
			Set Grade= '".$arr[1]."'
			Where CourseID = '".$course."' AND Student_userID = '".$arr[0]."' AND sectionID ='".$section."' ");
			$sql->execute();

		}
		$gradesubmit=true;
	}

	$arr=explode("-",$_POST['course']);
	$sql=$db->prepare("SELECT Student_userID, fName, lName,
		CASE grade
			WHEN 4.0 THEN 'A'
			WHEN 3.7 THEN 'A-'
		    WHEN 3.3 THEN 'B+'
		    WHEN 3.0 THEN 'B'
		    WHEN 2.7 THEN 'B-'
		    WHEN 2.3 THEN 'C+'
		    WHEN 2.0 THEN 'C'
		    WHEN 1.7 THEN 'C-'
		    WHEN 1.3 THEN 'D+'
		    WHEN 1.0 THEN 'D'
		    WHEN 0 THEN 'F'
		END as grade
		FROM Registration.Enrollment e
		join Registration.User u
		on u.userID=e.Student_userID
		WHERE sectionID=".$arr[1]." AND CourseID=".$arr[0].";");
	$sql->execute();
	$result=$sql->fetchAll(PDO::FETCH_ASSOC);
 


 	echo $twig->render('graderoster.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											 'y' => $y, 's'=> $s, 'roster'=>$result,  'err' => $err,'courseID'=> $arr[0], 'sectionID' => $arr[1], 'gradesubmit'=> $gradesubmit));
}  else
{
	echo $twig->render('fgrade.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											 'year' => $year, 'semester'=> $semester));
}

 	//Update grades based on the students id#, whom are taking the same course
   // $sql=$db->prepare("UPDATE Grade FROM REGISTRATION.User WHERE Student_userID=".$Student_userID."");
    //$sql->execute();
    
 
 	//Select all the students who are in the same course
 /*sql statement doesnt make sense. you need to find the courses that this prof teaches during semester/year(i think i need to talk to you in person about the semester year part):
"SELECT * FROM Registration.Section s
join Registration.Enrollment e
on s.CourseID=e.CourseID and s.sectionID=e.sectionID 
where Facutly_userID = '".$id."';"

this statement joins Enrollment(e) and section (s) to get you all the courses this teacher teaches and students registered to the class
	
*/
	


?>