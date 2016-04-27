<?php

include('resize_crop.php');

function prov($per){
	if (isset($per)) {
		$per = stripslashes($per);
		$per = htmlspecialchars($per);
		$per = addslashes($per);
	}
	return $per;
}


if(isset($_POST)){
	$filenew = time().rand(100,999).'.jpg';

	$x1 = prov($_POST['x1']);
	$x2 = prov($_POST['x2']);
	$y1 = prov($_POST['y1']);
	$y2 = prov($_POST['y2']);

	$sepia = prov($_POST['sepia']);
	$img = prov($_POST['img']);

	$crop = prov($_POST['crop']);

	crop($img, $crop.$filenew, array($x1, $y1, $x2, $y2));


if($sepia==1){
   $uploadfile = $crop.$filenew;
   $source = imagecreatefromjpeg($uploadfile);
   imagefilter($source, IMG_FILTER_GRAYSCALE);
   imagefilter($source, IMG_FILTER_COLORIZE, 100, 50, 0);
   imagejpeg($source, $crop."sepia_".$filenew);
   echo "sepia_".$filenew;
 } else {
	 echo $filenew;
 }

}




?>
