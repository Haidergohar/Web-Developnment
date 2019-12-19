<form method="post" enctype="multipart/form-data">
   
  
    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1"><br>
  
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
<?php
        if(isset($_POST['submit'])){
           $file = $_FILES['file'];
           $fileName = $file['name'];
           $fileType = $file['type'];
           $fileTmp = $file['tmp_name'];
           $fileErr = $file['error'];
           $fileSize = $file['size'];

           $fileExt = explode(".",$fileName);
           $fileExtension = strtolower(end($fileExt));

           $allowedExt = array("jpg", "jpeg", "png");

           if(in_array($fileExtension, $allowedExt)){
                if($fileErr === 0){
                    if($fileSize < 1000000){
                        $newFileName = uniqid('',true).".".$fileExtension;
                        $destination = "upload/".$fileName;
                        move_uploaded_file($fileTmp, $destination);
                        echo "File Uploaded Succesfully <a href='$destination'>show</a>";
                    } else{
                        echo "Maximum 1 mb file size are allowed.";
                    }
                } else{
                    echo "Oops, There is an error in uploading file";
                }
           } else{
               echo "Only jpg, jpeg and png Formats are allowed.";
           }

            
        }
?>