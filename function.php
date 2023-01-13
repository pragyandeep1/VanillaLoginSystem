<?php 
	
class Functions{
	 public $page;
	public function __construct(){
		$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$this->page = parse_url($url, PHP_URL_PATH);
	}

	public function getPage(){
		return $this->page;
	}
}

?>