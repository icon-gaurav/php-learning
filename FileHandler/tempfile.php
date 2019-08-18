<?php
$rates=array(
    array('currency'=> 'Australia', 'rate'=>20),
    array('currency'=> 'India', 'rate'=> 100),
    array('currency'=> 'Pakistan', 'rate'=> 80),
    array('currency'=> 'USA', 'rate'=> 50)
);
if(isset($_POST['download'])){
    $titles=array_keys($rates[0]);
    $file=new SplTempFileObject();
    $file->fputcsv($titles);
    foreach($rates as $currency){
        $file->fputcsv($currency);
    }
    $file->rewind();
    header('Content-Type:text/csv');
    header('Content-Disposition:attachment; filename=rates.csv');
    $file->fpassthru();
    exit;
}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title> SplObject Download (Temp file testing)</title>
	</head>
	<body>
		<h1>Currency of different country and their rates</h1>
		<table>
			<tr>
				<th>Currency</th>
				<th>Rates</th>
			</tr>
			<?php 
			foreach ($rates as $data){?>
			    <tr>
			    	<td><?= $data['currency']?></td>
			    	<td><?= number_format($data['rate'],5)?></td>
			    </tr>
			<?php }?>
		</table>
		<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
			<input type="submit" name="download" value="Download Rates">
		</form>
	</body>
</html>