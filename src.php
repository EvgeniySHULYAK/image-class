<?php
	class IMGcore {
		public $image;
		
		// Load an image for further work with it
		// Accepts the path to the picture (relative or absolute)
		function __construct($path) {
			$this->image = ImageCreateFromJPEG($path); 
		}
		
		// Load new color
		// Takes (int)R (int)G (int)B colors
		function getColor($r, $g, $b) {
			return imagecolorallocate($this->image, $r, $g, $b);
		}
		
		// Method for applying text to the picture
		// Accepts text, centering (left, right, center), font size, font, color, text box size, point X, point Y, line spacing
		function addText($text, $align, $size, $font, $color, $boxSize, $x, $y, $interval) {
			$words = explode(' ', $text);
			$ret = "";
			foreach($words as $word) {
				$tmp_string = $ret.' '.$word;
				$textbox = imagettfbbox($size, 0, $font, $tmp_string);
				if($textbox[2] > $boxSize)
					$ret.=($ret==""?"":"\n").$word;
				else
					$ret.=($ret==""?"":" ").$word;
			}
			if($align=="left") {
				imagettftext($this->image, $size , 0 , $x, $y, $color, $font, $ret);
			} else {
				$words = explode("\n", $ret);
				$height_tmp = 0;
				foreach($words as $str) {
					$testbox = imagettfbbox($size, 0, $font, $str);
					if($align=="center")
						$left_x = round(($boxSize - ($testbox[2] - $testbox[0]))/2);
					else
						$left_x = round($boxSize - ($testbox[2] - $testbox[0]));
					imagettftext($this->image, $size ,0 , $x + $left_x, $y + $height_tmp, $color, $font, $str);
					$height_tmp = $height_tmp + $interval;
				}
			}
			return true;
		}
		
		// The method is intended for displaying an image on the screen, can be used for debugging
		function printImage() {
			header('Content-type: image/jpeg');
			return imagejpeg($this->image);
		}
		
		// The method is designed to save the image to the specified path
		// Accepts a path to save and an optional image quality parameter
		function saveImage($path, $quality=100) {
			header('Content-type: image/jpeg');
			imagejpeg($this->image, $path, $quality);
		}
		
		// Inserts a picture into the original image.
		// Accepts a link to the inserted photo, position X, position Y, offset X, offset Y 
		function insertImage($photo, $x = 0, $y = 0, $xS = 0, $yS = 0) {
			if(is_object($photo)) {
				$p = $photo->image;
			} else {
				$p = ImageCreateFromJPEG($photo);
			}
			imagecopy($this->image, $p, $x,  $y, $xS, $yS, imagesx($p), imagesy($p));
		}
		
		// Resize the picture in height without cropping
		// Accepts the new height of the image
		function resizeToHeight($height) {
			  $ratio = $height / $this->getHeight();
			  $width = $this->getWidth() * $ratio;
			  $this->resize($width,$height);
		}
		
		// Resize the picture in width without cropping
		// Accepts the new width of the image
		function resizeToWidth($width) {
			  $ratio = $width / $this->getWidth();
			  $height = $this->getheight() * $ratio;
			  $this->resize($width,$height);
		}
		
		// Gets the width of the image
		function getWidth() {
			return imagesx($this->image);
		}
		
		// Gets the height of the image
		function getHeight() {
			return imagesy($this->image);
		}
		
		// Resize the picture by height and width
		// Accepts the new width and new height of the image
		function resize($width,$height) {
			$newImage = imagecreatetruecolor($width, $height);
			imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
			$this->image = $newImage;
		}
	}
