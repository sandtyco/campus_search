<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Institution's Crawl Engine  &middot; Educollabs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">

      /* Sticky footer styles
      -------------------------------------------------- */

      html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -60px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      #footer {
        background-color: #f5f5f5;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }



      /* Custom page CSS
      -------------------------------------------------- */
      /* Not required for template or sticky footer method. */

      .container {
        width: auto;
        max-width: 680px;
      }
      .container .credit {
        margin: 20px 0;
      }

    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    
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


    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
			<a href="index.php"><img src="assets/images/logo.png" width="125" title="Educollabs" alt="site-logo" align="right"/></a>
			<div class="container">
				<ul class="nav nav-tabs">
					<li class="active"><a href="addurl.php">Add Sites</a></li>
					<li><a href="addimage.php">Add Images</a></li>
				</ul>
			</div>
			<div class="navbar">
				<p align="justify" class="muted">This page is intended for those of you who want to contribute to provide the latest information in terms of education both website information, news, gallery folo and so on.</p>
			</div>
        </div>
      </div>
	  
	  <div class="container well">
		<h4>Please entry your suggest URL to this form.</h4><hr>
		<form class="form-horizontal" method="post" action="addsites.php">
			<div class="control-group">
				<label class="control-label">URL</label>
				<div class="controls">
					<input class="input-block-level" type="text" name="url" placeholder="http:// or https://">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Title</label>
				<div class="controls">
					<input class="input-block-level" type="text" name="title" placeholder="Title Meta">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Description</label>
				<div class="controls">
					<textarea class="input-block-level" type="text" name="description" placeholder="Description"></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Keyword</label>
				<div class="controls">
					<input class="input-block-level" type="text" name="keywords" placeholder="Please using separator text1, text2, ...., etc for keyword field.">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">On Click</label>
				<div class="controls">
					<input type="text" name="clicks" placeholder="On Click"><span class="help-inline"> Default Value is <b>0</b>.</span>
					<p class="muted">This is default for first access on click!</p>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-info">Suggest</button>
				</div>
			</div>
		</form>
		<p class="muted">All data that you send via the suggest URL form will be immediately found in our database, it's just that for optimization it takes time to validate data. The time needed is approximately 1 to 2 days.</p>
	  </div>

      <div id="push"></div>
    </div>

    <div id="footer">
      <div class="container">
			<p align="center" class="muted credit">Copyright <strong>&copy;</strong> 2022 <a href="http://educollabs.org">Educollabs.</a>Resource By Smart Edutechno Collaboration & <a href="https://pddikti.kemdikbud.go.id/" target="_blank">PD-DIKTI KEMDIKBUD</a>.</p>
      </div>
    </div>



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
