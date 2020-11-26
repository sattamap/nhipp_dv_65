<?php
if(isset($_POST['btn'])){
    $type = array('jpeg','jpg');
    $imageName = $_FILES['image']['name'];
    $imageType = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
    $imageSize = $_FILES['image']['size'];
    $imgTmp = $_FILES['image']['tmp_name'];
    $directory = 'image/';
    $imgUrl = $directory.$imageName;

       if($imageName != null){
          if(file_exists($imgUrl)){
            $imgErr = 'File already exists';
        }
        elseif($imageSize > 1000000){
            $imgErr = 'Image Should be greater than 1 Mb';

        }
        elseif(!in_array($imageType,$type)){
            $imgErr = 'Image should be JPEG or JPG extension';
        }else{
            move_uploaded_file($imgTmp,$imgUrl);
            $imgOk = "File Uploaded Successfully";
        }

     }else{
         $imgErr = 'Please Select An Image File';
     }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-3">
 <H2>Image Upload</H2>
 <form method= "POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
  <p>Custom File:</p>
  <div class="custom-file mb-3">
    <input type="file" class="custom-file-input" id="customFile" name="image" accept="image/*">
    <label class="custom-file-label" for="customFile">Choose file </label>
   </div>
   <div class="mt-3">
    <button type="submit" class="btn btn-primary" name="btn">Submit</button>
   </div>    
 </form>
</div>
<div class = "container mt-3">
  <div class="row">
  <?php
  $dirname ="image/";
  $images = glob($dirname."*.{jpg,jpeg,png}",GLOB_BRACE);
  foreach($images as $image){
   ?>
      <div class="col-md-4">
        <?php
        echo '<img class ="" src="'.$image.'" alt="Chania" width="100%" height="250px">';
        echo pathinfo($image, PATHINFO_FILENAME);
        ?>

      </div>
   <?php
  }
   ?>
  </div>
</div>

</body>
</html>
