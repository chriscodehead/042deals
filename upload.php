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

    // Create a new transparent image with the same dimensions as the uploaded image
    $transparentImage = imagecreatetruecolor($width, $height);
    imagesavealpha($transparentImage, true);
    $transparency = imagecolorallocatealpha($transparentImage, 0, 0, 0, 127);
    imagefill($transparentImage, 0, 0, $transparency);

    // Create a new image from the uploaded file
    if($fileType == 'image/jpeg'){
        $image = imagecreatefromjpeg($filePath);
    } elseif($fileType == 'image/png'){
        $image = imagecreatefrompng($filePath);
    }

    // Copy the uploaded image onto the new transparent image
    imagecopy($transparentImage, $image, 0, 0, 0, 0, $width, $height);

    // Create a new image from the watermark file
    $watermarkImg = imagecreatefrompng($watermark);

    // Set the size and position of the watermark image
    $watermarkImgWidth = $width / 2;
    $watermarkImgHeight = $height / 2;
    $watermarkImgX = $width - $watermarkImgWidth;
    $watermarkImgY = $height - $watermarkImgHeight;

    // Apply the watermark to the new transparent image
    imagecopyresampled($transparentImage, $watermarkImg, $watermarkImgX, $watermarkImgY, 0, 0, $watermarkImgWidth, $watermarkImgHeight, imagesx($watermarkImg), imagesy($watermarkImg));

    // Save the modified image with transparency background to a file
    imagesavealpha($transparentImage, true);
    imagepng($transparentImage, $filePath);

    // Free up memory
    imagedestroy($image);
    imagedestroy($watermarkImg);
    imagedestroy($transparentImage);

    // Output a success message
    echo "The file has been uploaded and watermarked.";

}
?>

<h2>Upload Image with watermark</h2>
<h2>Upload Image with watermark</h2>
<h2>Upload Image with watermark</h2>#
<h2>Upload Image with watermark</h2>

<!-- HTML form for uploading the image -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>
