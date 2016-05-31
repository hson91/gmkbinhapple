<?php
    class ImageLib {
        public $image;
        public $type;
        public $ext;
        public function load($filename) {
            $image_info = getimagesize($filename);
            $this->type = $image_info[2];
            if ($this->type == IMAGETYPE_JPEG) {
                $this->ext = 'jpg';
                $this->image = imagecreatefromjpeg($filename);
            } elseif ($this->type == IMAGETYPE_GIF) {
                $this->ext = 'gif';
                $this->image = imagecreatefromgif($filename);
            } elseif ($this->type == IMAGETYPE_PNG) {
                $this->ext = 'png';
                $this->image = imagecreatefrompng($filename);
            }
        }
        
        public function getColorOnImage($x, $y){
            $rgb = imagecolorat ($this->image, $x, $y );
            $colors = imagecolorsforindex($this->image, $rgb);
            return $colors;
        }
        
        public function getColorOnImageInt($x, $y){
            $rgb = imagecolorat ($this->image, $x, $y );
            return $rgb;
        }
        
        ////////////////////////////////////////IMAGE RESIZE/////////////////////////////////////////////////
        public function save($filename, $type = IMAGETYPE_JPEG, $compression = 100, $permissions = null){
            if ($type == IMAGETYPE_JPEG) {
                imagejpeg($this->image, $filename, $compression);
            } elseif ($type == IMAGETYPE_GIF) {
                imagegif($this->image, $filename, $compression);
            } elseif ($type == IMAGETYPE_PNG) {
                imagepng($this->image, $filename, $compression);
            }
            if ($permissions != null) {
                chmod($filename, $permissions);
            }
        }
        
        public function upload($file, $filename){
            move_uploaded_file($file, $filename);
        }
        
        public function output($type = IMAGETYPE_JPEG) {
            if ($type == IMAGETYPE_JPEG) {
                imagejpeg($this->image);
            } elseif ($type == IMAGETYPE_GIF) {
                imagegif($this->image);
            } elseif ($type == IMAGETYPE_PNG) {
                imagepng($this->image);
            }
        }
        public function getWidth() {
            return imagesx($this->image);
        }
        public function getHeight() {
            return imagesy($this->image);
        }
        public function resizeToHeight($height) {
            $ratio = $height / $this->getHeight();
            $width = $this->getWidth() * $ratio;
            $this->resize($width, $height);
        }
        public function resizeToWidth($width) {
            $ratio = $width / $this->getWidth();
            $height = $this->getheight() * $ratio;
            $this->resize($width, $height);
        }
        public function scale($scale) {
            $width = $this->getWidth() * $scale / 100;
            $height = $this->getheight() * $scale / 100;
            $this->resize((int)$width, (int)$height);
        }
        public function resize($width, $height) {
            $new_image = imagecreatetruecolor($width, $height);
            imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, 
			$this->getWidth(), $this->getHeight());
            $this->image = $new_image;
        }
        ///////////////////////////////////////////////////////IMAGE PAINT/////////////////////////////////////////////
        public function paintImage($width, $height,$file_name,$type = IMAGETYPE_JPEG){
            $images = imagecreate($width,$width);
            if(($this->getWidth()/$width) > ($this->getHeight()/$height)){
                $this->resizeToWidth($width);
            }else{
                $this->resizeToHeight($height);
            }
            $this->save($file_name,$type);
        }
        //Cái này cắt hình làm đại diện
        public function getSliceImage($width, $height, $file_name, $image_quality = 100, $type = IMAGETYPE_JPEG){
            $dest;
            if ($width == 'auto' && $height > 0) {
                $ratio = $height / $this->getHeight();
                $width = $this->getWidth() * $ratio;
                $this->resizeToHeight($height);
                $dest = imagecreatetruecolor($this->getWidth(), $this->getHeight());
                imagecopy($dest, $this->image, 0, 0, 0, 0,$width, $height);
            } else if ($width > 0 && $height == 'auto') {
                $ratio = $width / $this->getWidth();
                $height = $this->getHeight() * $ratio;
                $this->resizeToWidth($width);
                $dest = imagecreatetruecolor($this->getWidth(), $this->getHeight());
                imagecopy($dest, $this->image, 0, 0, 0, 0,$width, $height);
            } else {
                if ($width == $height) {
                    if(($this->getWidth()/$width) > ($this->getHeight()/$height)){
                        $this->resizeToWidth($width);
                        $dest = imagecreatetruecolor($this->getWidth(), $this->getHeight());
                        imagecopy($dest, $this->image, 0, 0, 0,0/2,$width, $height);
                    }else{
                        $this->resizeToHeight($height);
                        $dest = imagecreatetruecolor($this->getWidth(), $this->getHeight());
                        imagecopy($dest, $this->image, 0, 0, 0,0,$width, $height);
                    }       
                } else {
                    $dest = imagecreatetruecolor($width, $height);
                    if(($this->getWidth()/$width) > ($this->getHeight()/$height)){
                        $this->resizeToHeight($height);
                        imagecopy($dest, $this->image, 0, 0, ($this->getWidth() - $width)/2,0,$width, $height);
                    }else{
                        $this->resizeToWidth($width);
                        imagecopy($dest, $this->image, 0, 0, 0,($this->getHeight() - $height)/2,$width, $height);
                    }   
                }
            }
            if ($type == IMAGETYPE_JPEG) {
                imagejpeg($dest, $file_name, $image_quality);
            } elseif ($type == IMAGETYPE_GIF) {
                imagegif($dest, $file_name, $image_quality);
            } elseif ($type == IMAGETYPE_PNG) {
                imagepng($dest, $file_name, $image_quality);
            }
            imagedestroy($dest);
        }
        
        public function getGrayImage($width, $height, $file_name, $image_quality = 100, $type = IMAGETYPE_JPEG){
            $dest = imagecreatetruecolor($width, $height);
            if(($this->getWidth()/$width) > ($this->getHeight()/$height)){
                $this->resizeToHeight($height);
                imagecopy($dest, $this->image, 0, 0, ($this->getWidth() - $width)/2,0,$width, $height);
            }else{
                $this->resizeToWidth($width);
                imagecopy($dest, $this->image, 0, 0, 0,($this->getHeight() - $height)/2,$width, $height);
            }
            imagefilter($dest, IMG_FILTER_GRAYSCALE);
            if ($type == IMAGETYPE_JPEG) {
                imagejpeg($dest, $file_name, $image_quality);
            } elseif ($type == IMAGETYPE_GIF) {
                imagegif($dest, $file_name, $image_quality);
            } elseif ($type == IMAGETYPE_PNG) {
                imagepng($dest, $file_name, $image_quality);
            }
        }
        //Cái này thêm vào khoảng trống cho đủ
        public function paintNewImage($width, $height,$file_name,$type = IMAGETYPE_JPEG){
            $dest = imagecreatetruecolor($width, $height);
            $colors = $this->getColorOnImage(1,1);
            $color = imagecolorallocate($dest, $colors['red'], $colors['green'], $colors['blue']);
            $color = imagecolorallocate($dest, 255, 255, 255);
            imagefill($dest, 0, 0, $color);
            if(($this->getWidth()/$width) > ($this->getHeight()/$height)){
                $this->resizeToWidth($width);
                imagecopymerge($dest,$this->image,0,($height-$this->getHeight())/2,0,0,$this->getWidth(),$this->getHeight(),100);
            }else{
                $this->resizeToHeight($height);
                imagecopymerge($dest,$this->image,($width-$this->getWidth())/2,0,0,0,$this->getWidth(),$this->getHeight(),100);
            }
            if ($type == IMAGETYPE_JPEG) {
                imagejpeg($dest, $file_name,100);
            } elseif ($type == IMAGETYPE_GIF) {
                imagegif($dest, $file_name,100);
            } elseif ($type == IMAGETYPE_PNG) {
                imagepng($dest, $file_name,100);
            }
            imagedestroy($dest);
        }
        //Cái này cắt 1 phần của hình
        public function cutAPartImage($width, $height, $file_name){
            $dest = imagecreatetruecolor($width, $height);
            imagecopy($dest,$this->image,0,0,($this->getWidth()-$height)/2, ($this->getHeight()-$height)/2,$height,$height);
            imagejpeg($dest, $file_name,100);
            imagedestroy($dest);
        }
        
        public function __destruct() {
            if($this->image){
                imagedestroy($this->image);
            }
        }

    }
?>