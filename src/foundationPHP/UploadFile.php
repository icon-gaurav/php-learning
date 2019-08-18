<?php
namespace foundationPHP;
class UploadFile{
    protected $destination;
    protected $messages=array();
    protected $maxSize=1024;
    protected $premittedType=array('image/jpeg','image/gif','image/png','image/webp','text/plain');
    protected $newfilename;
    public function __construct($uploadFolder){
        if(!is_dir($uploadFolder)|| !is_writable($uploadFolder)){
            throw new \Exception($uploadFolder." must be valid, writable folder.");
        }
        if($uploadFolder[strlen($uploadFolder)-1]!='/'){
            $uploadFolder.='/';
        }
        $this->destination=$uploadFolder;
        $this->messages[]="Destination folder : ".$uploadFolder;
    }
    public function setMaxSize($bytes){
        if($bytes>0){
            $this->maxSize=$bytes;
        }
    }
    protected function checkFileName($file){
        $this->newfilename=null;
        $nospaces=str_replace(' ', '_', $file['name']);
        if($nospaces!=$file['name']){
           $this->newfilename=$nospaces;
        }
    }
    protected function checkType($file){
        if(in_array($file['type'],$this->premittedType)){
            return true;
        }else{
            $this->messages[]=$file['name'].' is not of permitted format type.';
            return false;
        }
    }
    protected function checkSize($file){
        if($file["size"]==0){
            $this->messages[]=$file['name']." is Empty.";
            return false;
        }elseif($file["size"]<=$this->maxSize){
            return true;            
        }else{
            $this->messages[]=$file["name"]." is too big.( Max Size = $this->maxSize bytes).";
            return false;
        }
    }
    public function upload(){
        $uploaded=current($_FILES);
        if($this->checkFile($uploaded)){
            $this->moveFile($uploaded);
        }
    }
    protected function checkFile($file){
        if($file['error']!=0){
            $this->getErrorMessage($file);
            return false;
        }
        if(!$this->checkSize($file)){
            return false;
        }
        if(!$this->checkType($file)){
            return false;
        }
        $this->checkFileName($file);
    return true;
    }
    protected function moveFile($file){
        $filename=isset($this->newfilename) ? $this->newfilename : $file['name'];
        $response=move_uploaded_file($file['tmp_name'], $this->destination.$filename);
        if($response){
            $result= $file['name']." uploaded successfully.";
            if(!is_null($this->newfilename)){
                $result.='and renamed as \''.$this->newfilename.'\'.';
            }
            $this->messages[]=$result;
        }else{
            $this->messages[]="Could not Upload ".$file['name'].'.';
        }
    }
    protected function getErrorMessage($file){
        switch($file["error"]){
            case 1:
            case 2: $this->messages[]=$file["name"]." is too big (more than ".($this->maxSize)." KB";
            break;
            case 3: $this->messages[]=$file["name"]." is partially uploaded.";
                break;
            case 4: $this->messages[]="File is not selected.";
            break;
            default: $this->messages[]="Sorry, there is some problem in uploading the file.";
        }
    }
    public function getMessages(){
        return $this->messages;
    }
}