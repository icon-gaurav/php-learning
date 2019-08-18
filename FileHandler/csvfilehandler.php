<?php
$csvfile=new SplFileObject("../common/images/SampleSpreadsheet.csv");
$csvfile->setFlags(SplFileObject::READ_CSV);
foreach($csvfile as $line){
    $data[]=$line;
}
echo '<pre>';
print_r($data);
echo '</pre>';