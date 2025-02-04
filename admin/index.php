<?php
    require "vendor/autoload.php";
    
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Color\Color;
    use Endroid\QrCode\Encoding\Encoding;
    use Endroid\QrCode\ErrorCorrectionLevel;
    use Endroid\QrCode\Label\Label;
    use Endroid\QrCode\Logo\Logo;
    use Endroid\QrCode\RoundBlockSizeMode;
    use Endroid\QrCode\Writer\PngWriter;
    use Endroid\QrCode\Writer\ValidationException;

    $image_code = '';
    if(isset($_POST['create'])) 
    {
        if($_POST['content']!== '') 
        {
            $temporary_directory = 'temp';
            $file_name = md5(uniqid()).'.png';
            $file_path = $temporary_directory.'/'.$file_name;
            $qr_Code = new QrCode(trim($_POST['content']));
            

            $writer = new PngWriter();
            $result = $writer->write($qr_Code);
            $result->saveToFile($file_path);
            $image_code = '<div class="text-center"><img src="'.$file_path.'" /></div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generating QR Code</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Kamei Solutions</h1>
    <form method="post">
        <label for="text">Enter name</label>
        <input type="text" id="inputURL" name="content" required>
        <input type="file" name="image">
        <button type="submit" name ="create">Generate QR Code</button>
    </form>
    <?php
        echo $image_code;
    ?>

</body>
</html>