<?php 
    use foundationPHP\UploadFile;
    $max=3*1024;
    $result=array();
    $destination=__DIR__."/uploads/";
/*     if(isset($_POST['upload'])){
        $filename=$_FILES;
        if($_FILES["filename"]["error"]==0){
            $message="File temporary path : ".$filename["filename"]["tmp_name"]."<br>";
            $result=move_uploaded_file($filename["filename"]["tmp_name"], $destination.$filename["filename"]["name"]);
            if($result){
                $message.=$_FILES["filename"]["name"]." is uploaded successfully.<br>";
                $message.="Final Path is : ".$destination.$filename["filename"]["name"];
            }
            else{
                $message="Sorry, there is some problem in uploading the file in error ==0.";
            }
        }
         else{
            switch($_FILES["filename"]["error"]){
                case 2: $message="File is too big (more than ".($max/1024)." KB";
                break;
                case 4: $message="File is not selected.";
                break;
                default: $message="Sorry, there is some problem in uploading the file.";
            }
         }
    }
 */
    if(isset($_POST['upload'])){
        require_once ('../src/foundationPHP/UploadFile.php');
        try{
            $upload=new UploadFile($destination);
            $upload->setMaxSize($max);
            $upload->upload();
            $result=$upload->getMessages();
        }
        catch(Exception $e){
            $result[]= $e->getMessage();
        }
    }
?>
<html>
	<head>
		<title>File upload example</title>
	</head>
	<body>
		<h1>File Upload Form example..</h1>
		<form action="<?php  echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
			<p>
				<input type="hidden" value="<?php echo $max?>"/>
				<label for="filename">Select file : </label>
				<input name="filename" id="file" type="file" />
			</p>
			<button type="submit" name="upload">Submit</button>
		</form>
	</body>
</html>
<?php 
if($result){
    echo "Messages :><br>";
    echo '<ul>';
    foreach ($result as $message){
        echo "<li>$message</li>";
    }
    echo '</ul>';
}
?>