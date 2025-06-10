
<?php
header('Content-Type: image/jpeg');
$image = imagecreatetruecolor(800, 600);
$bg = imagecolorallocate($image, 200, 200, 200);
$text_color = imagecolorallocate($image, 50, 50, 50);
imagefill($image, 0, 0, $bg);
imagestring($image, 5, 300, 280, 'Imagen no disponible', $text_color);
imagejpeg($image);
imagedestroy($image);