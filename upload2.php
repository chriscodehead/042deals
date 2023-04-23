<?php
// Check if the form is submitted
if(isset($_POST['submit'])){

    // Get the uploaded file information
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // Set the destination directory for the uploaded file
    $uploadDir = 'uploads/';

    // Set the file path and name
    $filePath = $uploadDir . $fileName;

    // Move the uploaded file to the destination directory
    move_uploaded_file($fileTmpName, $filePath);

    // Set the path and name of the watermark image
    $watermark = 'watermark.png';

    // Get the size of the uploaded image
    $imageSize = getimagesize($filePath);
    $width = $imageSize[0];
    $height = $imageSize[1];

    // Create a new image from the uploaded file
    if($fileType == 'image/jpeg'){
        $image = imagecreatefromjpeg($filePath);
    } elseif($fileType == 'image/png'){
        $image = imagecreatefrompng($filePath);
    }

    // Create a new image from the watermark file
    $watermarkImg = imagecreatefrompng($watermark);

    // Calculate the angle and position of the watermark image
    $angle = -45; // -45 degree angle
    $watermarkImgX = ($width / 2) - ((imagesx($watermarkImg) / 2) * cos(deg2rad($angle))) + ((imagesy($watermarkImg) / 2) * sin(deg2rad($angle)));
    $watermarkImgY = ($height / 2) - ((imagesx($watermarkImg) / 2) * sin(deg2rad($angle))) - ((imagesy($watermarkImg) / 2) * cos(deg2rad($angle)));

    // Apply the watermark to the uploaded image
    $watermarkImg = imagerotate($watermarkImg, $angle, 0); // Rotate the watermark image
    imagecopy($image, $watermarkImg, $watermarkImgX, $watermarkImgY, 0, 0, imagesx($watermarkImg), imagesy($watermarkImg));

    // Save the modified image to a file
    if($fileType == 'image/jpeg'){
        imagejpeg($image, $filePath);
    } elseif($fileType == 'image/png'){
        imagepng($image, $filePath);
    }

    // Free up memory
    imagedestroy($image);
    imagedestroy($watermarkImg);

    // Output a success message
    echo "The file has been uploaded and watermarked.";

}
?>

<!-- HTML form for uploading the image -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>
