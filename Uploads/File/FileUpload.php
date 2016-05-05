<?php 
namespace Uploads\File;
class Upload{
	protected $destination; #path að folder
	protected $max = 51200; #max stærð á skrám
	protected $messages = []; #error messages array(tómur)
	protected $permitted = [ #leyfðar MIME týpur
		'image/gif',
		'image/jpeg',
		'image/pjpeg',
		'image/png'
	];

	public function __construct($path) {
		if (!is_dir($path) || !is_writable($path)) {
			throw new \Exception("$path must be a valid, writeable directory.");
		}
		$this->destination = $path;
	}

	public function upload(){ #Upload fall
		$uploaded = current($_FILES);
		if ($this->checkFile($uploaded)) {
			$this->moveFile($uploaded);
		}
	}

	protected function checkFile($file){ #athugar hvort það sé í lagi með skrá
		return true;
	}

	protected function moveFile($file){ #Færir skrár úr TMP yfir í upload_test folder
		$success = move_uploaded_file($file['tmp_name'],$this->destination . $file['name']);
		if ($success) {
			$result = $file['name'] . ' was uploaded successfully';
			$this->messages[] = $result;
		} else {
			$this->messages[] = 'Could not upload ' . $file['name'];
		}
	}

	public function getMessages(){
		return $this->messages;
	}
}