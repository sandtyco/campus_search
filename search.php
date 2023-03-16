<?php

	include("config.php");
	include("classes/SiteResultsProvider.php");
	include("classes/ImageResultsProvider.php");

	if(isset($_GET["term"])) {
		$term = $_GET["term"];
	}
	else {
		exit("You must enter a search term");
	}

	$type = isset($_GET["type"]) ? $_GET["type"] : "sites";
	$page = isset($_GET["page"]) ? $_GET["page"] : 1;

?>

<!DOCTYPE html>

<html>

<head>

	<title>Institution's Crawl Engine ~ Educollabs</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstraps.css">
	<link rel="stylesheet" href="assets/css/bootstrap-responsive.css">

	<link rel="shortcut icon" href="assets/ico/favicon.png">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<style>
		body {
			background-image: url('assets/images/bg.jpg');
			background-repeat: no-repeat;
			background-size: cover;
			background-attachment:fixed;
			}
	</style>
</head>

<body>

	<div class="wrapper">

		<div class="header">
			
			<div class="headerContent">
				
				<div class="logoContainer">
					
					<a href="index.php">
						<img src="assets/images/logo.png" />	
					</a>
					
				</div>

				<div class="searchContainer">
					
					<form action="search.php" method="GET">
						
						<div class="searchBarContainer">
							<input type="hidden" name="type" value="<?php echo $type; ?>">
							<input class="searchBox" type="text" name="term" value="<?php echo $term; ?>">
							<button class="searchButton">
								<img src="assets/ico/search.png" />
							</button>
						</div>

					</form>

				</div>

			</div>

			<div class="tabsContainer">

				<ul class="tabList">

					<li class="<?php echo $type == 'sites' ? 'active' : '' ?>">
						<a href='<?php echo "search.php?term=$term&type=sites"; ?>'>
							Sites
						</a>
					</li>

					<li class="<?php echo $type == 'images' ? 'active' : '' ?>">
						<a href='<?php echo "search.php?term=$term&type=images"; ?>'>
							Images
						</a>
					</li>

				</ul>

			</div>

		</div>

		<div class="mainResultsSection">
			
			<?php

				if ($type == "sites") {
					$resultsProvider = new SiteResultsProvider($con);
					$pageSize = 20;	
				}
				else {
					$resultsProvider = new ImageResultsProvider($con);
					$pageSize = 250;
				}

				$numResults =  $resultsProvider->getNumResults($term);

				echo "<p class='resultsCount'>$numResults results found</p>";

				echo $resultsProvider->getResultsHtml($page, $pageSize, $term);
			
			?>

		</div>

		<div class="paginationContainer">
			
			<div class="pageButtons">

				<div class="pageNumberContainer">
					<img src="assets/images/edu.png" alt="First segment of pagination" />
				</div>

				<?php

					$pagesToShow = 10;
					$numPages = ceil($numResults / $pageSize);
					$pagesLeft = min($pagesToShow, $numPages);

					$currentPage = $page - floor($pagesToShow / 2);

					if ($currentPage < 1) {
						$currentPage = 1;
					}

					if ($currentPage + $pagesLeft > $numPages + 1) {
						$currentPage = $numPages + 1 - $pagesLeft;
					}

					while($pagesLeft != 0 && $currentPage <= $numPages) {

						if ($currentPage == $page) {
							echo "<div class='pageNumberContainer'>
									<img src='assets/images/pageSelected.png' />
									<span class='pageNumber'>$currentPage</span>
								  </div>";
						}
						else {
							echo "<div class='pageNumberContainer'>
									<a href='search.php?term=$term&type=$type&page=$currentPage'>
										<img src='assets/images/page.png' />
										<span class='pageNumber'>$currentPage</span>
								  	</a>
								  </div>";
						}

						$currentPage++;
						$pagesLeft--;

					}

				?>

				<div class="pageNumberContainer">
					<img src="assets/images/collabs.png" alt="Last segment of pagination" />
				</div>

			</div>

		</div>

	</div>
	
	<script async src="https://cse.google.com/cse.js?cx=016415709156547965879:2ypcpoot8sk"></script>
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script type="text/javascript" src="assets/js/masonry.js"></script>
	<script type="text/javascript" src="assets/js/script.js"></script>

</body>

</html>
