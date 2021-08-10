<?php


class  Photo extends  Db_object
{
    //static properties
    protected static  $db_table ="photos"; // Abstracting table
    protected static $db_table_fields = [
        'title',
        'caption',
        'description',
        'filename',
        'alternative_text',
        'type',
        'size',
        'alternative_text',

    ];


    // properties
    public $id; //photo_id
    public $title;
    public $caption;
    public $description;
    public $filename;
    public $alternative_text;
    public $type;
    public $size;

   public  $tmp_path;
   public  $upload_directory     = "images";

  //This is p$_FILES['uploaded_file'] as an argument
    public  function  set_file($file)
    {
        //Error checking if the file is uploaded
        if (empty($file) || !$file || !is_array($file)){
            $this->errors[]  = "There was no file uploaded here";
            return false;

        //check if the file has uploded
        }elseif($file['errors'] != 0){

            $this->errors[] = $this->upload_errors_array[$file['error']];
            return  false;

        }else {
            //assign
            $this->filename     = basename($file['name']);
            $this->tmp_path     = $file['tmp_name'];
            $this->type         = $file['type'];
            $this->size         = $file['size'];
        }

    }


    public  function  save()
    {
        //error checking
        if ($this->id){
            $this->update();
        }else{
            if (!empty($this->errors)){
                return false;
            }

            if (empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "the file was not available";
                return  false;
            }

            //create a target path /permanent location
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;

            //check if file target exists
            if (file_exists($target_path)){
                $this->errors[] = "The file {$this->filename} already exists";
            }

            //Move the  uploaded file
            if (move_uploaded_file($this->tmp_path, $target_path)){
                if ($this->create()){
                    unset($this->tmp_path);
                    return  true;
                }
            }else {
                //Place customs string in arrays
                $this->errors[] = "The file directory probably does not have  permission";
                return false;
            }
        }
    }

    public  function  picture_path()
    {
        return $this->upload_directory .DS. $this->filename;
    }

    public  function  delete_photo()
    {
        //delete from data from table
        if ($this->delete()){
            //delete the file
            $target_path = SITE_ROOT.DS. 'admin' . DS . $this->picture_path();

           return unlink($target_path) ? true : false;

        }else{
            return  false;
        }
    }

}