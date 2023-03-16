<?php

class DomDocumentParser {

	private $doc;

	public function __construct($url) {

		$options = array(
			'http'=>array('method'=>"GET", 'header'=>"User-Agent: Mozilla/5.0 (AdsBot Google; Googlebot/2.1; +http://www.google.com/bot.html)")
			);
		$context = stream_context_create($options);

		$this->doc = new DomDocument();
		@$this->doc->loadHTML(file_get_contents($url, false, $context));

	}

	public function getLinks() {
		return $this->doc->getElementsByTagName("a");
	}

	public function getTitletags() {
		return $this->doc->getElementsByTagName("title");
	}

	public function getMetaTags() {
		return $this->doc->getElementsByTagName("meta");
	}

	public function getImages() {
		return $this->doc->getElementsByTagName("img");
	}
	
	public function getVideos() {
		return $this->doc->getElementsByTagName("mp4");
	}

}

?>
