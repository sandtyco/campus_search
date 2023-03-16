<?php

include("config.php"); 
include("classes/DomDocumentParser.php");

$alreadyCrawled = array(); // finished crawling
$crawling = array(); // to be crawled
$alreadyFoundImages = array(); // all found images


function insertLink($url, $title, $description, $keywords) {

	global $con;

	$query = $con->prepare("INSERT into sites (url, title, description, keywords)
							values (:url, :title, :description, :keywords)");
	
	$query->bindParam(":url", $url);
	$query->bindParam(":title", $title);
	$query->bindParam(":description", $description);
	$query->bindParam(":keywords", $keywords);

	return $query->execute();

}


function linkExists($url) {

	global $con;

	$query = $con->prepare("SELECT * from sites WHERE url = :url");
	
	$query->bindParam(":url", $url);
	$query->execute();

	return $query->rowCount() != 0;

}


function insertImage($url, $src, $alt, $title) {

	global $con;

	$query = $con->prepare("INSERT into images (siteUrl, imageUrl, alt, title)
							values (:siteUrl, :imageUrl, :alt, :title)");
	
	$query->bindParam(":siteUrl", $url);
	$query->bindParam(":imageUrl", $src);
	$query->bindParam(":alt", $alt);
	$query->bindParam(":title", $title);

	return $query->execute();

}


function createLinks ($src, $url) {

	$scheme = parse_url($url)["scheme"]; // http, https etc.
	$host = parse_url($url)["host"]; // www.example.com website links

	// host page link, primary link of website
	if (substr($src, 0, 2) == "//") {
		$src = $scheme . ":" . $src;
	}
	// relative to index page
	else if (substr($src, 0, 1) == "/") {
		$src = $scheme . "://" . $host . $src;
	}
	// start from current directory
	else if(substr($src, 0, 2) == "./") {
		$src = $scheme . "://" . $host . dirname(parse_url($url)["path"]) . substr($src, 1);
	}
	// go back to previous directory
	else if (substr($src, 0, 3) == "../") {
		$src = $scheme . "://" . $host . "/" . $src;
	}
	//starts with letters, check if not starting with https or http
	else if (substr($src, 0, 5) !== "https" && substr($src, 0, 4) !== "http") {
		$src = $scheme . "://" . $host . "/" . $src;
	}

	return $src;

}


function getDetails($url) {

	global $alreadyFoundImages;

	$parser = new DomDocumentParser($url);
	$titleArray = $parser->getTitletags();

	if (sizeof($titleArray) == 0 || $titleArray->item(0) == NULL) {
		return;
	}

	$title = $titleArray->item(0)->nodeValue;
	$title = str_replace("\n", "", $title);

	if ($title == "") {
		return;
	}

	$description = "";
	$keywords = "";

	$metasArray = $parser->getMetaTags();

	foreach ($metasArray as $meta) {
		if ($meta->getAttribute("name") == "description") {
			$description = $meta->getAttribute("content");
		}

		if ($meta->getAttribute("name") == "keywords") {
			$keywords = $meta->getAttribute("content");
		}
	}

	$description = str_replace("\n", "", $description);
	$keywords = str_replace("\n", "", $keywords);

	if (linkExists($url)) {
		echo "$url already exists<br>";
	}
	else if (insertLink($url, $title, $description, $keywords)){
		echo "SUCCESS: $url<br>";
	}
	else {
		echo "ERROR: Failed to insert $url<br>";
	}

	$imageArray = $parser->getImages();

	foreach ($imageArray as $image) {
		$src = $image->getAttribute("src");
		$alt = $image->getAttribute("alt");
		$title = $image->getAttribute("title");

		if (!$title && !$alt) {
			continue;
		}

		$src = createLinks($src, $url);

		if (!in_array($src, $alreadyFoundImages)) {
			$alreadyFoundImages[] = $src;

			insertImage($url, $src, $alt, $title);
		}

	}

}


function followLinks($url) {

	global $crawling;
	global $alreadyCrawled;

	$parser = new DomDocumentParser($url);
	$linkList = $parser->getLinks();

	foreach($linkList as $link) {
		$href = $link->getAttribute("href");

		if (strpos($href, "#") !== false) {
			continue;
		}
		else if (substr($href, 0, 11) == "javascript:") {
			continue;
		}

		$href = createLinks($href, $url);

		if (!in_array($href, $alreadyCrawled)) {
			$alreadyCrawled[] = $href;
			$crawling[] = $href;

			getDetails($href);
		}

	}

	array_shift($crawling); // pop out first element of array

	foreach ($crawling as $site) {
		followLinks($site);
	}

}

$site = "https://cse.google.com/cse?cx=016415709156547965879:2ypcpoot8sk";
"https://www.google.com/";
"https://educollabs.org/";
"https://lldikti6.kemdikbud.go.id/";
"https://pddikti.kemdikbud.go.id/";
followLinks($site);

?>