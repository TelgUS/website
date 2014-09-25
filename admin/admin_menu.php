<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/index.php"><img
				src="/images/telgus_menu_logo.png" alt="Logo"></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li id="menu_home"><a href="/admin/index.php">Admin Home</a></li>

				<!-- New menu -->
				<li id="menu_new" class="dropdown"><a href="#"
					class="dropdown-toggle" data-toggle="dropdown">New <span
						class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li id="menu_new_article"><a href="/admin/new_article.php">Article</a></li>
						<li id="menu_new_movie_now"><a href="/admin/new_movie_now.php">Movie
								In Theaters</a></li>
						<li id="menu_new_movie_future"><a
							href="/admin/new_movie_future.php">Movie Coming Soon</a></li>
						<li id="menu_new_event"><a href="/admin/new_event.php">Event</a></li>
					</ul></li>


				<!-- Edit menu -->
				<li id="menu_edit" class="dropdown"><a href="#"
					class="dropdown-toggle" data-toggle="dropdown">Edit <span
						class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li id="menu_edit_article"><a href="/admin/edit_article.php">Article</a></li>
						<li id="menu_edit_movie_now"><a href="/admin/edit_movie_now.php">Movie
								In Theaters</a></li>
						<li id="menu_edit_movie_future"><a
							href="/admin/edit_movie_future.php">Movie Coming Soon</a></li>
						<li id="menu_edit_event"><a href="/admin/edit_event.php">Event</a></li>
					</ul></li>

				<!-- Delete menu -->
				<li id="menu_del" class="dropdown"><a href="#"
					class="dropdown-toggle" data-toggle="dropdown">Remove <span
						class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li id="menu_del_article"><a href="/admin/remove_article.php">Article</a></li>
						<li id="menu_del_movie_now"><a href="/admin/remove_movie_now.php">Movie
								In Theaters</a></li>
						<li id="menu_del_movie_future"><a
							href="/admin/remove_movie_future.php">Movie Coming Soon</a></li>
						<li id="menu_del_event"><a href="/admin/remove_event.php">Event</a></li>
					</ul></li>

			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li id="logon_user" style="padding-top: 16px; font-weight: normal;">
				  <?php echo $_SESSION ['logon_user']; ?></li>
				<li id="menu_logout"><a href="/admin/logout.php">Logout</a></li>
			</ul>

		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container-fluid -->
</nav>