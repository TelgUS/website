<!DOCTYPE html>
<html lang="en">
<?php
require_once 'db.inc';
$articles_per_page = 5;
$page = 1;

// determine page number and offset
if (! empty ( $_GET ['page'] )) {
	$page = $_GET ['page'];
}
?>

<head>
	<?php require_once "head.php"; ?>
	<title><?php echo MY_COMPANY; ?>: Home</title>

</head>

<body>
	<?php require_once '/menu.php';?>
	<div class="container">

		<div class="content">
			<?php
			// Show Jumbotron in page 1 only
			if ($page == 1) {
				?>
			<div class="jumbotron">
				<h1>Hello, world!</h1>
				<p>This section will have the upcoming movies and events in a
					carousel.</p>
				<p>
					<a class="btn btn-primary btn-lg" role="button">Learn more</a>
				</p>
			</div>
			<?php } // end Jumbotron display ?>
 <!-- HTML to write -->
 <a href="#" data-toggle="tooltip" title="Some tooltip text!">Hover over me</a>
 
 <!-- Generated markup by the plugin -->
 <div class="tooltip top" role="tooltip">
   <div class="tooltip-arrow"></div>
   <div class="tooltip-inner">
     Some tooltip text!
   </div>
 </div>
			<section class="main_articles">
	  			<?php
						$articles_displayed_count = $page * $articles_per_page;
						
						$prev_page = $page - 1;
						$next_page = $page + 1;
						$offset = $articles_per_page * ($page - 1);
						
						$con = db_connect ();
						
						$sql = "SELECT count(*) FROM articles
							WHERE sysdate() BETWEEN start_date AND ifnull(end_date, '9999-12-31')";
						$result = get_sql_result ( $con, $sql );
						$row = mysqli_fetch_row ( $result );
						$articles_count = $row [0];
						
						// get articles for current page
						$sql = "SELECT article_id, title, text, start_date
							FROM  articles
							WHERE sysdate() BETWEEN start_date AND ifnull(end_date, '9999-12-31')
							ORDER BY start_date DESC, article_id DESC
							LIMIT $articles_per_page OFFSET $offset";
						$result = get_sql_result ( $con, $sql );
						
						while ( $row = mysqli_fetch_array ( $result ) ) {
							// user comments count
							$sql = "SELECT count(*) FROM article_comments WHERE article_id = " . $row ['article_id'];
							$comments_result = get_sql_result ( $con, $sql );
							$comments_row = mysqli_fetch_row ( $comments_result );
							$comments_count = $comments_row [0];
							
							// images count
							$sql = "SELECT count(*) FROM article_images WHERE article_id = " . $row ['article_id'];
							$images_result = get_sql_result ( $con, $sql );
							$images_row = mysqli_fetch_row ( $images_result );
							$images_count = $images_row [0];
							
							echo "<article class='panel panel-default'>\n";
							echo "  <header class='panel-heading'>\n";
							echo "    <div class='row'>\n";
							echo "      <div class='col-md-9'><a href='article.php?id=" . $row ['article_id'] . "'>" . $row ['title'] . "</a></div>\n";
							echo "      <div class='col-md-1'>\n";
							echo "          <div id='comments_" . $row ['article_id'] . "' title='Comments' data-toggle='tooltip' data-placement='bottom'><a href='article.php?id=" . $row ['article_id'] . "'><span class='glyphicon glyphicon-comment'> $comments_count</span></a></div>";
							echo "      </div>\n";
							echo "      <div class='col-md-1'>\n";
							echo "          <div id='images_" . $row ['article_id'] . "' title='Photos'><a href='article.php?id=" . $row ['article_id'] . "'><span class='glyphicon glyphicon-camera'> $images_count</span></a></div>\n";
							echo "      </div>\n";
							echo "      <div class='col-md-1'>";
							echo "        <small><time datetime='" . $row ['start_date'] . "'>" . date ( "m/d/y", strtotime ( $row ['start_date'] ) ) . "</time></small>\n";
							echo "      </div>\n";
							echo "    </div>\n";
							echo "  </header>\n";
							echo "<div class='panel-body'>" . $row ['text'] . "\n</div>";
							echo "</article>\n\n";
						}
						
						db_disconnect ( $con );
						?>

				<!-- Previous and Next nav buttons -->
				<div class="btn-group btn-group-justified">
					<div class="btn-group">
						<?php
						if ($prev_page < 1) {
							echo "<button type='button' class='btn btn-default btn-lg' disabled>Previous</button>";
						} else {
							echo "<a href='index.php?page=$prev_page'><button type='button' class='btn btn-default btn-lg'>Previous</button></a>";
						}
						?>
					</div>
					<div class="btn-group">
						<?php
						if ($articles_displayed_count >= $articles_count) {
							echo "<button type='button' class='btn btn-primary btn-lg' disabled>Next</button>";
						} else {
							echo "<a href='index.php?page=$next_page'><button type='button' class='btn btn-primary btn-lg'>Next</button></a>";
						}
						?>
					</div>
				</div>

			</section>

			<!-- Side News (on right) -->
			<aside class="side_news">
				<h3>Recent News!</h3>
				<p>Some news that goes to the side</p>
			</aside>

		</div>
		<!-- end content -->

	</div>
	<!-- end container -->
	
	<?php require_once "/footer.php"; ?>
	
	<!-- The below script highlights the menu selection -->
	<script>
	$("#menu_home").addClass("active");
	</script>

</body>
</html>