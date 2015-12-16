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


$semestersql=$db->prepare("SELECT * FROM Registration.Semester;");
$semestersql->execute();
$semester=$semestersql->fetchAll(PDO::FETCH_ASSOC);

$yearsql=$db->prepare("SELECT semesterYear FROM Registration.Semester group by semesterYear;");
$yearsql->execute();
$year=$yearsql->fetchAll(PDO::FETCH_ASSOC);


$y=$_POST['year'];
$s=$_POST['semester'];
$add=$_POST['addclass'];
$drop=$_POST['removeclass'];

if (isset($_POST['btn-submit'])) {
		if (isset($add)) {
			$sql=$db->prepare("SELECT Medical,Academic,Financial FROM Registration.holds where Student_userID='".$id."';");
			$sql->execute();
			$holdcheck = $sql->fetchAll(PDO::FETCH_ASSOC);
			$holdsum=0;
			foreach ($holdcheck[0] as $key => $value) {
				$holdsum=$holdsum+(int)$value;
			}
			if ($holdsum == 0) {
					$sql=$db->prepare("SELECT * FROM Registration.Enrollment e
								inner join Registration.Section s
								on e.CourseID=s.CourseID and e.sectionID=s.sectionID
								where s.semesterYear='".$y."' and s.semesterID='".$s."' and e.Student_userID='".$id."';");
					$sql->execute();
					$check2 = $sql->fetchAll(PDO::FETCH_ASSOC);
				foreach ($add as $key => $value) {
					$arr=explode("-", $value);

					$sql=$db->prepare("SELECT * FROM Registration.Enrollment 
										WHERE sectionID='".$arr[1]."' and CourseID='".$arr[0]."' and Student_userID='".$id."';");
					$sql->execute();
					$check = $sql->fetchAll(PDO::FETCH_ASSOC);


					$sql=$db->prepare("SELECT * FROM Registration.PreRequisite pr
										join Registration.Course c
										on pr.PreReq=c.CourseID
										where pr.CourseID='".$arr[0]."';");
					$sql->execute();
					$prereq = $sql->fetchAll(PDO::FETCH_ASSOC);

					if (count($check) > 0) {
						$err='You cannot register the same class more than once.';
						break;
					}elseif(count($check2)+count($add) > 4){
						$err='You cannot register for more than 16 credits.';
						break;
					}elseif(count($prereq)>0){
						$foo=array();
						foreach ($prereq as $key=>$value) {
							$foo[]=$value['courseName']."-".$value['CourseID'];
						}
						$temp=implode(", ", $foo);
						$err="The following Prerequisite(s) are required: ".$temp;
					}else{
						$sql=$db->prepare("INSERT INTO `Registration`.`Enrollment` (`sectionID`, `CourseID`, `Student_userID`) VALUES ('".$arr[1]."', '".$arr[0]."', '".$id."');");
						$sql->execute();
					}
					
				}
			}else{
				$err="No classes added, you have the following hold(s): ";
				$holdarr=array();
				if ($holdcheck[0]['Medical']) {
					$holdarr[]="Medical";
				}
				if ($holdcheck[0]['Academic']) {
					$holdarr[]="Academic";
				}
				if ($holdcheck[0]['Financial']) {
					$holdarr[]="Financial";
				}
				$temp = implode(", ", $holdarr);
				$err=$err.$temp.".";
			}

		}elseif (isset($drop)) {

			foreach ($drop as $key => $value) {
				$arr=explode("-", $value);

				$query=$db->prepare("DELETE FROM `Registration`.`Enrollment` WHERE `sectionID`='".$arr[1]."' and`CourseID`='".$arr[0]."' and`Student_userID`='".$id."';");
				$query->execute();
			}

		}

		if ($s==null or $y==null) {
			$err='select BOTH semester and year';
		}else{
			$sql=$db->prepare("SELECT * FROM Registration.Enrollment e
								INNER JOIN Registration.Section s 
								ON (e.sectionID=s.sectionID and e.CourseID=s.CourseID)
								INNER JOIN Registration.Course c
								ON (c.CourseID=s.CourseID)
								INNER JOIN Registration.User u
			                    ON s.Faculty_userID=u.userID
								 where e.Student_userID='".$id."' and s.semesterYear='".$y."' and s.semesterID='".$s."';");
			$sql->execute();
			$schedule=$sql->fetchAll(PDO::FETCH_ASSOC);
		}

		echo $twig->render('Sregistered.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
												 'y' => $y, 's'=> $s, 'data'=>$schedule, 'err' => $err));
}elseif(isset($_POST['btn-change'])){

	$sql=$db->prepare("SELECT *
						FROM Registration.Section s
						INNER JOIN Registration.Course c
						ON s.CourseID=c.CourseID
	                    INNER JOIN Registration.User u
	                    ON s.Faculty_userID=u.userID where semesterYear='".$y."' and semesterID='".$s."';");
	$sql->execute();
	$result=$sql->fetchAll(PDO::FETCH_ASSOC);

	echo $twig->render('add.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											 'year' => $year, 'semester'=> $semester,'result' => $result, 'y'=> $y, 's'=>$s, 'err'=>$err));
}else{

	echo $twig->render('adddrop.html', array('id'=>$id,'email' => $email, 'fname' => $fname, 'lname' => $lname, 'type' => $type,
											 'year' => $year, 'semester'=> $semester));
}

?>