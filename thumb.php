<?php
#@
#@ Load a picture and take few parameters
#@ Build cache file for thumbnail view
#@
#@ Created by Guillaume DE LA RUE <http://web2ajax.fr/>
#@ Version 1.1 : 2010/03/19
#@

#@
#@ Local Function to get extension
#@ ------------------------------------------------------------
function _getExtension($file_name) {
	$file_infos = pathinfo($file_name);
	return '.'.$file_infos['extension'] ;
}

#@
#@ Config
#@ ------------------------------------------------------------
$cache_dir = 'tmp/thumbs/' ;

#@
#@ Get url params
#@ ------------------------------------------------------------
$width 			= (int) $_GET['w'] ;
$height			= (int) $_GET['h'] ;
$image_file		= $_GET['i'];
$image_quality	= (int) $_GET['q'] ;
$cache_force	= $_GET['nocache'] ;

#@
#@ Customize the image url
#@ ------------------------------------------------------------
$image_file = urldecode($image_file) ;
$image_file = @reset(@explode('?', $image_file)) ;

#@
#@ Set vars
#@ ------------------------------------------------------------
$image_file_extension 	= _getExtension($image_file, true) ;
$image_file_basename 	= basename($image_file, $image_file_extension) ;	// Filename without extension '.jpg'
$thumb_file				= $image_file ;

#@
#@ Infos in image_file
#@ ------------------------------------------------------------
## Get md5 of files location
$thumb_file_md5 = md5($thumb_file)."_".$width."_".$height."_".$_GET['iar'] ;
$hex_folder = substr($thumb_file_md5, 0, 2).'/' ;
$img_thumb = $cache_dir.$hex_folder.$thumb_file_md5.$image_file_extension ;

// Create a thumb from image
function create_thumb($src, $dest, $width = 0, $height = 0, $deform = false, $no_img = './assets/img/trans.gif' ) {

	## Make directory
	@mkdir(dirname($dest)) ;

	## Get infos on file with exif
	list($width_original, $height_original, $image_mime) = @getimagesize($src);  

	// Init w & h
	$_w = ( $width ? $width : $width_original ) ;
	$_h = ( $height ? $height : $height_original ) ;

	// If error
	if ( ! $image_mime ) {
		$src = $no_img ;
		list($width_original, $height_original, $image_mime) = getimagesize($src);
	}

	## Detect Portait( => 0) / paysage ( => 1)
	if ( $width_original <= $height_original ) {
		$image_type = 0 ;
	} else {
		$image_type = 1 ;
	}

	## If width or height is empty => auto
	if ( $_w == 0 && $_h > 0 ) {
		$_w = $width_original * ($_h / $height_original ) ;
	} else if ( $width > 0 && $height == 0 ) {
		$_h = $height_original * ($_w / $width_original ) ;
	} else {
		$is_error = true ;
	}

	## Define best size to thumb depending params
	if ( $image_type == 0 ) {
		$best_height 	= $_h ;
		if ( $height_original ) $best_width 	= (int) ( $width_original * ($_h / $height_original ) ) ;
	} else {
		$best_width 	= $_w ;
		if ( $width_original ) $best_height 	= (int) ( $height_original * ( $_w / $width_original ) ) ;
	}

	## If picture is little than wanted => don't stretch it, juste create a standard thumbnail
	if ( $width_original < $_w && $height_original < $_h ) {
		$best_width = $width_original ;
		$best_height = $height_original ;
	} 

	## If 'iar' is setted => do desired stretching and no more
	if ( $deform == "1" ) {
		$best_width = (int) $width ;
		$best_height = (int) $height ;
	}

	// set image type, blending and set functions for gif, jpeg and png
	switch($image_mime){
	  case IMAGETYPE_PNG:  $img = 'png';  $blending = false; break;
	  case IMAGETYPE_GIF:  $img = 'gif';  $blending = true;  break;
	  case IMAGETYPE_JPEG: $img = 'jpeg'; break;
	}
	$imagecreate = "imagecreatefrom$img";
	$imagesave   = "image$img";  

	// initialize image from the file
	$image1 = $imagecreate($src);  

	// create a new true color image with dimensions $width2 and $height2
	$image2 = imagecreatetruecolor($best_width, $best_height);  

	// preserve transparency for PNG and GIF images
	if ($img == 'png' || $img == 'gif'){
	  // allocate a color for thumbnail
	  $background = imagecolorallocate($image2, 0, 0, 0);
	  // define a color as transparent
	  imagecolortransparent($image2, $background);
	  // set the blending mode for thumbnail
	  imagealphablending($image2, $blending);
	  // set the flag to save alpha channel
	  imagesavealpha($image2, true);
	}  

	// save thumbnail image to the file
	imagecopyresampled($image2, $image1, 0, 0, 0, 0, $best_width, $best_height, $width_original, $height_original);
	$imagesave($image2, $dest, ($img == 'jpeg' ? 100 : true));
	ImageDestroy($image2);
}

#@
#@ If thumbnail doesn't exists create it !
#@ ------------------------------------------------------------

if ( ! file_exists($img_thumb) || $cache_force == "true")
	create_thumb($image_file, $img_thumb, $width, $height, $deform = $_GET['iar']) ;
else 

// -> Get the type mime of the image
list($width_original, $height_original, $image_mime) = getimagesize($img_thumb);
switch($image_mime){
  case IMAGETYPE_PNG:  $image_mime = 'image/png';  break;
  case IMAGETYPE_GIF:  $image_mime = 'image/gif';  break;
  case IMAGETYPE_JPEG: $image_mime = 'image/jpeg'; break;
}  

#@
#@ FORCE TO CACHE IMAGE
#@ ------------------------------------------------------------
$img_content = file_get_contents($img_thumb) ;

// not sure if this stuff is really needed, but works:
@header("Cache-Control: private, max-age=10800, pre-check=10800");
@header("Pragma: private");
@header("Expires: " . date(DATE_RFC822,strtotime("+100 day")));
// the browser will send a $_SERVER['HTTP_IF_MODIFIED_SINCE']
// option 1, you can just check if the browser is sendin this
if(isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){
  // if the browser has a cached version of this image, send 304
  @header('Last-Modified: '.$_SERVER['HTTP_IF_MODIFIED_SINCE'],true,304);
  exit;
}
// option 2, if you have a file to base your mod date off:
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])
       &&
  (strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == filemtime($img_file))) {
  // send the last mod time of the file back
  @header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($img_file)).' GMT',
  true, 304);
  exit;
}

// and here we send the image to the browse with all the stuff
// required for tell it to cache
$image_infos 	= @getimagesize($cache_dir.$thumb_file_md5.$image_file_extension) ;
@header("Content-type: ".$image_mime);
@header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($img_file)) . ' GMT');
@header("Content-Length: ".strlen($img_content));
echo $img_content;
?>