<?php
   include('config.php');
		
   if(isset($_POST['upload'])){
	   
       // Getting file name
       $filename = $_FILES['imagefile']['name'];
         
	   $file_size = $_FILES['imagefile']['size'];

       if (($file_size > 15485760)){      
           $message = 'File too large. File must be less than 15 megabytes.'; 
           echo '<script type="text/javascript">alert("'.$message.'");</script>'; 
		   return false;
       }
       // Valid extension
       $valid_ext = array('png','jpeg','jpg','gif');
	   
	   
	   $photoExt1 = @end(explode('.', $filename));
	   $phototest1 = strtolower($photoExt1);
			
	   $new_image = time().'.'.$phototest1;
			
        // Location
        $location = "images/".$new_image;

         // file extension
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);

         // Check extension
         if(in_array($file_extension,$valid_ext)){  

                // Compress Image
                compress($_FILES['imagefile']['tmp_name'],$location,91);
				$formid = $_POST['formid'];
				$sql = "INSERT INTO imagedata(form_id,image,date)VALUES ('".$formid."','".$location."',now())";
                if (mysqli_query($conn, $sql)) 
                {
                	//echo "New record created successfully";
                }
				
             }else{
                   echo "Invalid file type.";
             }
        }

        // Compress image
         function compress($source, $destination, $quality) 
		 {
			
            $info = getimagesize($source);
            if ($info['mime'] == 'image/jpeg') 
               $image = imagecreatefromjpeg($source);
            elseif ($info['mime'] == 'image/gif') 
               $image = imagecreatefromgif($source);
            elseif ($info['mime'] == 'image/png') 
               $image = imagecreatefrompng($source);
            imagejpeg($image, $destination, $quality);
            return $destination;
         }

        ?>
<style>
 input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=number] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=file] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: grey;
  color: black;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: grey;
}

 div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
 }
</style>
<!doctype html>
<html>
    <head>
        <title>How to Compress Image size while Uploading with PHP</title>
    </head>
	<body>
        <!-- Upload form -->
		<h2 style="text-align: center;">Image Compression</h2>
		<div>
        <form method='post' action='' enctype='multipart/form-data'>
			 <label for="file">Image: </label>
             <input type='file' name='imagefile' ><br><br>
			  <label for="number">Form ID: </label>
			 <input type='number' name='formid' id='formid' maxlength='10' ><br><br>
             <input type='submit' value='Upload' name='upload'>    
			 <a href="list.php">Show Image Data</a>
        </form>
		</div>
	</body>
</html>