<?php


class  Photo extends  Db_object
{
    //static properties
    protected static  $db_table ="photos"; // Abstracting table
    protected static $db_table_fields = [
        'title',
        'description',
        'filename',
        'type',
        'size'
    ];


    // properties
    public $photo_id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;

   public  $tmp_path;
   public  $upload_directory     = "images";
   public  $errors               = [];  //customs errors
   public  $upload_errors_array  =
            [
            UPLOAD_ERR_OK            => "There is no error, the file uploaded with success.",
            UPLOAD_ERR_INI_SIZE      => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",
            UPLOAD_ERR_FORM_SIZE     => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
            UPLOAD_ERR_PARTIAL       => "The uploaded file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE       => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR    => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE    => " Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION     => "A PHP extension stopped the file upload. ",
            ];

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
        if ($this->photo_id){
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

}