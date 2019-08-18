<?php
if(isset($_POST["Download"])){
	header("Content-Type: text/plain");
	header("Content-Disposition: attachment;filename=@author Gaurav Kumar actors.txt");
	header("Cache-Control: no-cache,no-store,must-revalidate");
	header("Pragme: no-cache");
	header("Expires: 0");
	$output=fopen('php://output', 'w');
	$result=getResult();
	foreach ($result as $data){
		foreach ($data as $key=> $value){
			fwrite($output, $key." : $value\r\n");
		}
		fwrite($output, "\r\n");
	}
	fclose($output);
	exit();
}
// $db=new mysqli('localhost','root','gaurav kumar','sakila');
// if($db->connect_error){
//     echo 'Error1 : '.$db->connect_error;
// }else{
 //   $query="SELECT * FROM `sakila`.`actor` limit 50;";
//     $result=$db->real_query($query);
//     if($db->error){
//         echo 'Error2 : '.$db->error;
//     }
//     if($result){
//         echo 'Result (OK): '.$result;
//     }else{
//         echo 'Result (NOT OK): '.$result;
//     }
// }
    function getResult(){
    	$query="SELECT * FROM `sakila`.`actor` limit 50;";
    	$mysql="mysql:host=localhost;dbname=sakila";
    	$result=null;
    	try{
    		$db=new PDO($mysql,'root','gaurav kumar');
    		$result=$db->query($query);
    		$errorInfo=$db->errorInfo();
    		if(isset($errorInfo)){
    			$error=$errorInfo[2];
    		}
    	}catch (PDOException $e){
    		$error=$e->getMessage();
    	}
    	if(isset($error)){
    		echo "Error : $error";
    	}
    	return $result;
    }
	  		$result=getResult();
	  		if(isset($result)){
		  		echo 'Data:><br><ol>';
		  		foreach ($result as $data){
		  			echo "<li><ul>";
		  			echo "<li> First Name : ".$data['first_name']."</li>";
		  			echo "<li> Last Name : ".$data['last_name']."</li>";
		  			echo "<li> Last Update : ".$data['last_update']."</li>";
		  			echo "</ul></li>";
		  		}
	  			echo '</ol>';
	  		}
 ?>
 <!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
 <html>
 	<head>
 		<title>PHP-MySql (test)</title>
 	</head>	
 <body>
 	<form action="checkConnection.php" method="post" enctype="multipart/form-data">
 		<label>Download Section</label>
 		<input type="submit" name="Download" value="Download File">
 	</form>
 </body>
 </html> 	
 
 
 
 
 
 
 
 
 