<?php

require_once 'lib/facebook.php';
/** 
 * @author thiagovalentim
 * 
 * 
 */
class Facebook_Init extends Facebook {
	
	public function __construct($array) {
		parent::__construct($array);
		$this->getPermission();
	}
	
	public function getSession() {
		return $this->getUser();
	}
	
	public function getLikes() {
		return $this->graphFactory('/me/likes');
	}
	
	public function getProfile() {
		return $this->graphFactory('/me');
	}
	
	public function makeShare($name, $link, $picture, $caption, $description, $menssage) {
		return $share = <<<EOD
			FB.ui(
			   {
			     method: 'feed',
			     name: '$name',
			     link: '$link',
			     picture: '$picture',
			     caption: '$caption',
			     description: '$description',
			     message: '$menssage'
			   }
			 );
EOD;
	}
	
	public function sendToSomeone($to, $name, $link, $description) {
		return $send = <<<EOD
				FB.ui(
						{
				          method: 'send',
				          to: '$to',
				          name: '$name',
				          link: '$link',
				          description: '$description'
		          		}
		          	);
EOD;
	}
	
	public function makeInit($xfbml = true, $cookie = true) {
		return $init = <<<EOD
					FB.init({appId: '$this->getAppId()', xfbml: $xfbml, cookie: $cookie});
EOD;
	}
	
	public function getFriends() {
		return $this->graphFactory('me/friends');
	}
	
	
	private function getPermission() {
		if(!$this->getSession()) {
			Response::redirect($this->getLoginUrl());
		}	
	}
	
	private function graphFactory($query) {
		if($this->getSession()) {
			return $this->api($query);
		}
		return null;
	}
	
	
}


?>