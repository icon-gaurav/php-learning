<?php
$jsonObject=file_get_contents("../common/files/data.json");
$jsonObject=json_decode($jsonObject);
//print_r($jsonObject);
$array=new ArrayIterator($jsonObject);
foreach ($array as $object){
    echo $object->Name.'<br>';
}