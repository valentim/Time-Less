<?php
class Upload_Init {

	const LARGE_IMG_PREFIX = "resize_";
	const THUMB_IMG_PREFIX = "thumbnail_";
	
	private $config = array(
								'upload_dir' 		=> 'upload',
								'path_dir'			=> null,
								'max_filesize'		=> 3,
								'max_img_width'		=> 500,
								'thumb_width'		=> 100,
								'thumb_height		=> 100'
							);
							
	private $type = array(
								'image/pjpeg',
								'image/jpeg',
								'image/jpg',
								'image/png',
								'image/x-png',
								'image/gif'
							);
							
	private $image;
	private $thumb;
	private $error = array();
	
	public function __construct(array $config) {
		
		$timestamp = time();
		
		$this->config = array_merge($this->config, $config);
		$this->image = $this->config['path_dir'].$this->config['upload_dir'].DIRECTORY_SEPARATOR.self::LARGE_IMG_PREFIX.$timestamp;
		$this->thumb = $this->config['path_dir'].$this->config['upload_dir'].DIRECTORY_SEPARATOR.self::THUMB_IMG_PREFIX.$timestamp;
	
		if(!is_dir($this->config['path_dir'].$this->config['upload_dir'])){
			mkdir($this->config['path_dir'].$this->config['upload_dir'], 0777);
			chmod($this->config['path_dir'].$this->config['upload_dir'], 0777);
		}
	}
	
	public function upload($file) {
		if($this->validate($file)) {
			move_uploaded_file($file['tmp_name'], $this->image);
			chmod($this->image, 0777);
			$this->resizeImage();
		} else {
			$this->getError();
		}
	}
	
	private function validate($file) {
		if(!is_uploaded_file($file['tmp_name'])) {
			array_push($this->error, "Arquivo não enviado");
		}
		
		if(!in_array($file['type'], $this->type)) {
			array_push($this->error, "Esse tipo de arquivo não é permitido");
		}
		
		if($file['size'] > ($this->config['max_filesize'] * 1048576)) {
			array_push($this->error, "Arquivo ultrapassou o tamanho máximo permitido {$this->config['max_filesize']}M");
		}
		
		if($file['error'] != 0) {
			switch($file['error']) {
				case 1:
					array_push($this->error, "Arquivo ultrapassou o tamanho máximo permitido {$this->config['max_filesize']}M");
					break;
				case 2:
					array_push($this->error, "Arquivo ultrapassou o tamanho máximo permitido {$this->config['max_filesize']}M");
					break;
				case 3:
					array_push($this->error, "O upload foi feito parcialmente");
					break;
				case 4:
					array_push($this->error, "Não foi feito o upload do arquivo"); 
			}
		}
		
		if(!empty($this->error)) {
			return false;
		}
		return true;
	}
	
	public function getError() {
		foreach ($this->error as $erro) {
			echo $erro;
		}
	}
	
	
	private function resizeImage() {
		
		$this->process($this->image, false);
			
	}

	public function resizeThumbnailImage() {
		
		$this->process($this->thumb, true);
	}
	
	private function process($image, $flag) {
		$info = $this->getInfo($image);
		$scale = $this->getScale($info['width'], $flag);
		
		$newImage = $this->newImage(
								array(
										'width'		=> $info['width'],
										'height'	=> $info['height'],
										'type'		=> $info['type'],
										'scale'		=> $scale
										)
								);
		$image = $this->resize(
								array(
										'newImage'	=> $newImage['newImage'],
										'width'		=> $info['width'],
										'newWidth'	=> $newImage['newWidth'],
										'height'	=> $info['height'],
										'newHeight' => $newImage['newHeight'],
										'type'		=> $info['type']
										),
								$flag
								);
		
		chmod($image, 0777);
	}
		
	private function newImage(array $data) {
		$imageType = image_type_to_mime_type($data['type']);
		$newImageWidth = ceil($data['width'] * $data['scale']);
		$newImageHeight = ceil($data['height'] * $data['scale']);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		return array(
						'newImage' 	=> $newImage,
						'newWidth'	=> $newImageWidth,
						'newHeight'	=> $newImageHeight
					);
	}
		
	private function getInfo($image) {
		list($imagewidth, $imageheight, $imagetype) = getimagesize($this->image);
		return array(
						'width'		=> $imagewidth,
						'height'	=> $imageheight,
						'type'		=> $imagetype
						);
	}
	
	private function getScale($width, $isThumb = false) {
		
		if(!$isThumb) {
			if ($width > $this->config['max_img_width']){
				$scale = $this->config['max_img_width']/$width;
			} else {
				$scale = 1;
			}
		} else {
			$scale = $this->config['thumb_width']/$width;
		}
		
		return $scale;
	}
	
	private function resize(array $data, $isThumb = false) {
		
		if($isThumb) {
			$image = $this->thumb;
		} else {
			$image = $this->image;
		}
		
		if(!isset($data['start_width'])) {
			$data['start_width'] = 0;
			$data['start_height'] = 0;
		}
		
		switch($data['type']) {
			case "image/gif":
				$source = imagecreatefromgif($image); 
				imagecopyresampled($data['newImage'],$source,0,0,$data['start_width'], $data['start_height'],$data['newImageWidth'],$data['newImageHeight'],$data['width'],$data['height']);
				imagegif($data['newImage'],$this->image); 
				break;
		    case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source = imagecreatefromjpeg($image); 
				imagecopyresampled($data['newImage'],$source,0,0,$data['start_width'], $data['start_height'],$data['newImageWidth'],$data['newImageHeight'],$data['width'],$data['height']);
				imagejpeg($data['newImage'],$image, 90); 
				break;
		    case "image/png":
			case "image/x-png":
				$source = imagecreatefrompng($this->image); 
				imagecopyresampled($data['newImage'],$source,0,0,0,0,$data['newImageWidth'],$data['newImageHeight'],$data['width'],$data['height']);
				imagepng($data['newImage'],$image); 
				break;
		}
		
		return $image;
	}
}