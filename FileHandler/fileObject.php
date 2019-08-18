<?php
$doc=new FilesystemIterator("../common/files");
foreach ($doc as $file){
    $textfile=$file->openFile("r+");
    $textfile->setFlags(SplFileObject::SKIP_EMPTY | SplFileObject::READ_AHEAD | SplFileObject::DROP_NEW_LINE);
    echo "<h2>".$textfile->getFilename()."</h2>";
    foreach($textfile as $line){
        echo "$line<br>";
    }
    $textfile->seek(1);
    echo "<p>This is second line : ".$textfile->current();
    while(!$textfile->eof()){
        $textfile->next();
    }
    $textfile->fwrite("\n This line is added by Gaurav Kumar");
}