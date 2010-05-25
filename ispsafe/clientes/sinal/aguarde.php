<?php
    $png = imagecreatetruecolor(900, 500);
    imagesavealpha($png, true);

    $trans_colour = imagecolorallocatealpha($png, 0, 0, 0, 127);
    imagefill($png, 0, 0, $trans_colour);
    
    $textcolor = imagecolorallocate($png, 0, 0, 255);
  
    imagestring($png, 5, 450, 150, "Aguarde o carregamento final da imagem.", $textcolor);
  
    
    header("Content-type: image/png");
    imagepng($png);
?>
