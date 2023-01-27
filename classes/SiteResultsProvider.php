<?php

	class SiteResultsProvider {

		private $con;

		public function __construct($con) {
			$this->con = $con;
		}


		public function getNumResults($term) {

			$query = $this->con->prepare("SELECT count(*) as total
											FROM sites WHERE title like :term
											OR url LIKE :term
											OR keywords LIKE :term
											OR description LIKE :term");

			$searchTerm = "%" . $term . "%";
			$query->bindParam(":term", $searchTerm);
			$query->execute();

			$row = $query->fetch(PDO::FETCH_ASSOC);
			return $row["total"];

		}


		public function getResultsHtml($page, $pageSize, $term) {

			$fromLimit = ($page - 1) * $pageSize;
			// page1 = (1 - 1) * 20
			// page2 = (2 - 1) * 20
			// page3 = (3 - 1) * 20
			// page4 = (4 - 1) * 20 etc...

			$query = $this->con->prepare("SELECT *
											FROM sites WHERE title like :term
											OR url LIKE :term
											OR keywords LIKE :term
											OR description LIKE :term
											ORDER BY clicks DESC
											LIMIT :fromLimit, :pageSize");

			$searchTerm = "%" . $term . "%";

			$query->bindParam(":term", $searchTerm);
			$query->bindParam(":fromLimit", $fromLimit, PDO::PARAM_INT);
			$query->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);
			
			$query->execute();

			$resultsHtml = "<div class='siteResults'>";

			while ($row = $row = $query->fetch(PDO::FETCH_ASSOC)) {

				$id = $row["id"];
				$url = $row["url"];
				$title = $row["title"];
				$description = $row["description"];

				$title = $this->trimField($title, 64);
				$description = $this->trimField($description, 256);
				$url = $this->trimField($url, 64);

				$resultsHtml .= "<div class='resultContainer'>

									<h3 class='title'>
										<a href='$url' class='result' data-linkId='$id'>
											$title
										</a>
									</h3>
									<span class='url'>$url</span>
									<span class='description'>$description</span>

								</div>";

			}

			$resultsHtml .= "</div>";

			return $resultsHtml;

		}


		private function trimField($string, $characterLimit) {

			$dots = strlen($string) > $characterLimit ? "..." : "";
			return substr($string, 0, $characterLimit) . $dots;

		}

	}

?>
