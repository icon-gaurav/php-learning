<?php
$rdir=new FilesystemIterator("../common/images");
$rdir->setFlags(FilesystemIterator::UNIX_PATHS | FilesystemIterator::SKIP_DOTS);
foreach ($rdir as $file){
    if($file->getExtension()=='png'){
        echo $file->getFilename()." is ".$file->getSize()." bytes. Absolute Path
        is : ".$file->getRealPath()." <br>";
    }
}