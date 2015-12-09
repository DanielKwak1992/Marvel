<?php
require_once "sauthorize.php";
require 'vendor/autoload.php';
require_once "connection.php";
$loader = new Twig_Loader_Filesystem("views");
$twig = new Twig_Environment($loader);
$user = new Memcached();
$id=$user->get('id');
$type=$user->get('type');
$email=$user->get('email');
$fname=$user->get('fname');
$lname=$user->get('lname');

$success="";
$err="";


$sql=$db->prepare("SELECT * FROM Registration.Department;");
$sql->execute();
$dept=$sql->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['MaDepartment'])) {
	$selectedmadept=$_POST['MaDepartment'];
	$sql=$db->prepare("SELECT * FROM Registration.Department d
						inner join Registration.Major ma
						on ma.deptID=d.deptID
						where ma.deptID='".$selectedmadept."';");
	$sql->execute();
	$majors=$sql->fetchAll(PDO::FETCH_ASSOC);
}
if (isset($_POST['MiDepartment'])) {
	$selectedmidept=$_POST['MiDepartment'];
	$sql=$db->prepare("SELECT * FROM Registration.Department d
						inner join Registration.Minor mi
						on mi.deptID=d.deptID
						where mi.deptID='".$selectedmidept."';");
	$sql->execute();
	$minors=$sql->fetchAll(PDO::FETCH_ASSOC);

}
if (isset($_POST['MaMajor'])) {
	$selectedmajor=$_POST['MaMajor'];
}
if (isset($_POST['MiMinor'])) {
	$selectedminor=$_POST['MiMinor'];
}
if (isset($_POST['addmajor-btn'])) {

	if (isset($selectedmajor) or isset($selectedminor)) {
		if (isset($selectedmajor)) {
			$sql=$db->prepare("INSERT INTO `Registration`.`Major_Declaration` (`Student_userID`, `majorID`, `DateOfDeclaration`) VALUES ('".$id."', '".$selectedmajor."', NOW() );");
			if ($sql->execute()) {
				$success=$success." Major sucessfully added.";
			}else{
				$err=$err." There was a problem adding the selected major.";
			}
		}
		if (isset($selectedminor)) {
			$sql=$db->prepare("INSERT INTO `Registration`.`Minor_Declaration` (`Student_userID`, `minorID`, `DateOfDeclaration`) VALUES ('".$id."', '".$selectedminor."', NOW() );");
			if ($sql->execute()) {
				$success=$success." Minor successfully added.";
			}else{
				$err=$err." There was a problem adding the selected minor.";
			}
		}
	}
}
if (isset($_POST['major-delete'])) {
	$deletemajor=$_POST['major-delete'];
	$sql=$db->prepare("DELETE FROM `Registration`.`Major_Declaration` WHERE `Student_userID`='".$id."' and`majorID`='".$deletemajor."';");
	if ($sql->execute()) {
		$success=$success." Major sucessfully deleted.";
	}else{
		$err=$err." There was a problem deleting this major";
	}
}elseif ($_POST['minor-delete']) {
	$deleteminor=$_POST['minor-delete'];
	$sql=$db->prepare("DELETE FROM `Registration`.`Minor_Declaration` WHERE `Student_userID`='".$id."' and`minorID`='".$deleteminor."';");
	if ($sql->execute()) {
		$success=$success." Minor sucessfully deleted.";
	}else{
		$err=$err." There was a problem deleting this minor";
	}
}

$sql=$db->prepare("SELECT * FROM Registration.Major_Declaration mad
					inner join Registration.Major ma
					on ma.majorID=mad.majorID 
					where mad.Student_userID='".$id."';");
$sql->execute();
$MaC=$sql->fetchAll(PDO::FETCH_ASSOC);

$sql=$db->prepare("SELECT * FROM Registration.Minor_Declaration mid
					inner join Registration.Minor mi
					on mi.minorID=mid.minorID 
					where mid.Student_userID='".$id."';");
$sql->execute();
$MiC=$sql->fetchAll(PDO::FETCH_ASSOC);


echo $twig->render('MajorMinor.html', array('id'=>$id, 'type' => $type,'fname'=>$fname,'lname'=>$lname,
											'mac'=>$MaC,'mic'=>$MiC,'dept'=>$dept,
											'selectedmadept'=>$selectedmadept, 'majors'=>$majors,'selectedmajor'=>$selectedmajor,
											'selectedmidept'=>$selectedmidept, 'minors'=>$minors,'selectedminor'=>$selectedminor,
											'err'=>$err,'success'=>$success));

?>