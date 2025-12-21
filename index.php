<?php
if (!extension_loaded('imagick')) {
    die("Imagick extension is not installed.");
}

$result = '';

$uploadDir = __DIR__ . '/uploads/';
$outputDir = __DIR__ . '/output/';

// Ensure directories exist
foreach ([$uploadDir, $outputDir] as $dir) {
    if (!is_dir($dir)) mkdir($dir, 0775, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['top'], $_FILES['left'], $_FILES['right'])) {

        $faces = ['top' => $_FILES['top'], 'left' => $_FILES['left'], 'right' => $_FILES['right']];
        $uploadedPaths = [];

        try {
            // Move uploaded files and check for errors
            foreach ($faces as $key => $file) {
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    throw new Exception("Error uploading {$key} image. Code: {$file['error']}");
                }

                $path = $uploadDir . basename($file['name']);
                if (!move_uploaded_file($file['tmp_name'], $path)) {
                    throw new Exception("Failed to move {$key} image to uploads folder.");
                }

                $uploadedPaths[$key] = $path;
            }

            // Load, crop, resize, and set transparency
            $images = [];
            foreach ($uploadedPaths as $key => $file) {
                $img = new Imagick($file);
                $img->setImageAlphaChannel(Imagick::ALPHACHANNEL_SET);
                $img->setImageVirtualPixelMethod(Imagick::VIRTUALPIXELMETHOD_TRANSPARENT);

                $w = $img->getImageWidth();
                $h = $img->getImageHeight();
                $size = min($w, $h);
                $img->cropImage($size, $size, ($w - $size)/2, ($h - $size)/2);
                $img->resizeImage(512, 512, Imagick::FILTER_LANCZOS, 1);

                $images[$key] = $img;
            }

            // Affine points for distortion
            $topPoints   = [0,512,0,0, 0,0,-87,-50, 512,512,87,-50];
            $leftPoints  = [512,0,0,0, 0,0,-87,-50, 512,512,0,100];
            $rightPoints = [0,0,0,0, 0,512,0,100, 512,0,87,-50];

            $images['top']->distortImage(Imagick::DISTORTION_AFFINE, $topPoints, true);
            $images['left']->distortImage(Imagick::DISTORTION_AFFINE, $leftPoints, true);
            $images['right']->distortImage(Imagick::DISTORTION_AFFINE, $rightPoints, true);

            // Canvas
            $canvas = new Imagick();
            $canvas->newImage(800, 600, new ImagickPixel('none'));

            $cx = 300;
            $cy = 200;

            // Composite faces
            $canvas->compositeImage($images['top'], Imagick::COMPOSITE_PLUS, $cx, $cy - 50);
            $canvas->compositeImage($images['left'], Imagick::COMPOSITE_PLUS, $cx, $cy);
            $canvas->compositeImage($images['right'], Imagick::COMPOSITE_PLUS, $cx + 87, $cy);

            // Optional border
            $canvas->borderImage(new ImagickPixel('black'), 5, 2);

            // Save output
            $outputFile = $outputDir . 'cube_full.png';
            $canvas->setImageFormat('png');
            $canvas->writeImage($outputFile);

            $result = "Full isometric cube generated!<br><img src='output/cube_full.png' style='max-width:400px;'>";

            // Cleanup
            foreach ($images as $img) $img->clear();
            $canvas->clear();

            // Delete uploaded files
            foreach ($uploadedPaths as $file) {
                if (file_exists($file)) unlink($file);
            }

        } catch (Exception $e) {
            $result = "Error: " . $e->getMessage();
        }

    } else {
        $result = "Please upload all three images.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Full Cube Generator</title>
</head>
<body>
<h1>Upload Three Images (Top, Left, Right) to Generate Cube</h1>
<form method="post" enctype="multipart/form-data">
<label>Top face: <input type="file" name="top" required></label><br><br>
<label>Left face: <input type="file" name="left" required></label><br><br>
<label>Right face: <input type="file" name="right" required></label><br><br>
<button type="submit">Generate Cube</button>
</form>

<div style="margin-top:20px;">
<?php echo $result; ?>
</div>
</body>
</html>
