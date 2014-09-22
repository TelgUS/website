<!DOCTYPE html>
<html lang="en">
<?php require_once 'db.inc'; ?>

<head>
	<?php require_once "head.php"; ?>
	<title><?php echo MY_COMPANY; ?>: Home</title>
</head>

<body>
	<div class="container">

	    <?php require_once '/menu.php';?>

		<div class="content">
			<section id="main_articles">
				<h2>Articles</h2>
	  		<?php
					$articles_per_page = 5;
					$page = 1;
					
					// determine page number and offset
					if (isset ( $_GET ['page'] )) {
						$page = $_GET ['page'];
					}
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
					$sql = "SELECT title, text, start_date
							FROM  articles
							WHERE sysdate() BETWEEN start_date AND ifnull(end_date, '9999-12-31')
							ORDER BY start_date DESC, article_id DESC
							LIMIT $articles_per_page OFFSET $offset";
					$result = get_sql_result ( $con, $sql );
					
					while ( $row = mysqli_fetch_array ( $result ) ) {
						echo "<article class='panel panel-default'>\n";
						echo "  <header class='panel-heading'>\n";
						echo "    <div class='row'>\n";
						echo "      <div class='col-md-8'><h3>" . $row ['title'] . "</h3></div>\n";
						echo "      <div class='col-md-4' style='text-align: right;'><small><time datetime='" . $row ['start_date'] . "'>" . $row ['start_date'] . "</time></small></div>\n";
						echo "    </div>\n";
						echo "  </header>\n";
						echo "<div class='panel-body'>" . $row ['text'] . "\n</div>";
						echo "</article>\n\n";
					}
					
					// Previous page navigation
					echo "<div class='row'>\n";
					if ($prev_page < 1) {
						// don't show Previous button
						echo "<div class='col-md-6'>&nbsp;</div>\n";
					} else {
						// show Previous button
						echo "<div class='col-md-6'><a href='index.php?page=$prev_page'>
								<button type='button' class='btn btn-default btn-large'>
								Previous</button></a></div>\n";
					}
					
					// Next page navigation
					if ($articles_displayed_count >= $articles_count) {
						// don't show Next button
						echo "<div class='col-md-6'>&nbsp;</div>\n";
					} else {
						// show Next button
						echo "<div class='col-md-6' style='text-align: right;'>
								<a href='index.php?page=$next_page'>
								<button type='button' class='btn btn-primary btn-large'>Next</button></a></div>\n";
					}
					echo "</div>\n";
					
					db_disconnect ( $con );
					
					/*
					 * echo "<p style='text-align: center;'>\n"; echo "page: $page<br>"; if ($page > 0) { $last = $page - 2; echo "<a href=\"index.php?page=$last\">Last</a> |"; echo "<a href=\"index.php?page=$page\">Next</a>"; echo "<br>page > 0, last: $last , page: $page"; } else if ($page == 0) { echo "<a href=\"index.php?page=$page\">Next</a>"; echo "<br>page == 0, page: $page"; } else if ($left_article < $articles_per_page) { $last = $page - 2; echo "<a href=\"index.php?page=$last\">Last</a>"; echo "<br>left_article < articles_per_page, page: $page"; } echo "</p>\n";
					 */
					?>
			</section>

			<aside id="side_news">
				<h3>Recent News!</h3>
				<p>Some news that goes to the side</p>
			</aside>

		</div>
		<!-- end content -->
		
		<?php require_once "/footer.php"; ?>
		
	</div>
	<!-- end container -->


	<!-- The below script highlights the menu selection -->
	<script>
	$("#menu_home").addClass("active");
	</script>

</body>
</html>