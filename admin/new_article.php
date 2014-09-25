<?PHP
require_once 'session.php';
?>

<head>
	<?php require_once "../head.php"; ?>
	<title><?php echo MY_COMPANY; ?>: New Article</title>

</head>

<body>
	<?php require_once 'admin_menu.php';?>

	<div class="container">

    	<div id="content">
			<h2>New Article</h2>

			<p>Use the below form to enter a new article that would be displayed
				on the home page, depending upon the start and end date/times.</p>

			<form name="new" class="form-horizontal" role="form" method="post"
				action="/admin/insert_article.php" enctype="multipart/form-data"
				onsubmit="return checkForm();">

				<!-- article title -->
				<div class="form-group">
					<label for="article_title" class="col-sm-2 control-label">Article
						Title</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="article_title"
							name="article_title" placeholder="Article Title" maxlength="240"
							required>
					</div>
				</div>

				<!-- article text -->
				<div class="form-group">
					<label for="article_text" class="col-sm-2 control-label">HTML Text</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="article_text"
							name="article_text" placeholder="HTML Text" rows="10"
							maxlength="4000" required></textarea>
						<span class="help-block">Use HTML to enter the article</span>
					</div>
				</div>

				<div class="form-group">
					<!-- article start date -->
					<label for="start_date" class="col-sm-2 control-label">Start Date</label>
					<div class="col-sm-4">
						<input type="datetime" class="form-control" id="start_date"
							name="start_date" placeholder="Start Date"
							pattern="\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{2}:\d{2}"> <span
							class="help-block">Format: yyyy-mm-dd hh24:mi:ss<br>This is the
							date/time the article goes live on the website. If you don't
							enter the start date, the current date/time will be used.
						</span>
					</div>

					<!-- article end date -->
					<label for="end_date" class="col-sm-2 control-label">End Date</label>
					<div class="col-sm-4">
						<input type="datetime" class="form-control" id="end_date"
							name="end_date" placeholder="End Date"
							pattern="\d{4}-\d{1,2}-\d{1,2}"> <span class="help-block">Format:
							yyyy-mm-dd hh24:mi:ss<br>This is the date/time the article
							expires and won't be displayed on the website. if you don't enter
							the end date, this article will never expire.
						</span>
					</div>
				</div>

				<!-- comments allowed flag -->
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
							<label> <input type="checkbox" id="comments_allowed_flag"
								name="comments_allowed_flag" checked> User Comments Allowed?
							</label>
						</div>
					</div>
				</div>
				<br>

				<!-- video URL -->
				<div class="form-group">
					<label for="video_url" class="col-sm-2 control-label">Video URL</label>
					<div class="col-sm-10">
						<input type="url" class="form-control" id="video_url"
							name="video_url" placeholder="Video URL"> <span
							class="help-block">Enter the video URL.</span>
					</div>
				</div>

				<!-- image #1 (file and URL) -->
				<div class="form-group">
					<label for="image1_file" class="col-sm-2 control-label">Image #1
						File</label>
					<div class="col-sm-4">
						<input type="file" class="form-control" id="image1_file"
							name="image1_file"> <span class="help-block">Upload image #1.</span>
					</div>
					<label for="image1_url" class="col-sm-2 control-label">Image #1 URL</label>
					<div class="col-sm-4">
						<input type="url" class="form-control" id="image1_url"
							name="image1_url" placeholder="Image #1 URL"> <span
							class="help-block">Enter the URL for image #1. If you upload
							image #1 as a file also, this URL will be ignored.</span>
					</div>
				</div>

				<!-- image #2 (file and URL) -->
				<div class="form-group">
					<label for="image2_file" class="col-sm-2 control-label">Image #2
						File</label>
					<div class="col-sm-4">
						<input type="file" class="form-control" id="image2_file"
							name="image2_file"> <span class="help-block">Upload image #2.</span>
					</div>
					<label for="image2_url" class="col-sm-2 control-label">Image #2 URL</label>
					<div class="col-sm-4">
						<input type="url" class="form-control" id="image2_url"
							name="image2_url" placeholder="Image #2 URL"> <span
							class="help-block">Enter the URL for image #2. If you upload
							image #2 as a file also, this URL will be ignored.</span>
					</div>
				</div>

				<!-- image #3 (file and URL) -->
				<div class="form-group">
					<label for="image3_file" class="col-sm-2 control-label">Image #3
						File</label>
					<div class="col-sm-4">
						<input type="file" class="form-control" id="image3_file"
							name="image3_file"> <span class="help-block">Upload image #3.</span>
					</div>
					<label for="image3_url" class="col-sm-2 control-label">Image #3 URL</label>
					<div class="col-sm-4">
						<input type="url" class="form-control" id="image3_url"
							name="image3_url" placeholder="Image #3 URL"> <span
							class="help-block">Enter the URL for image #3. If you upload
							image #2 as a file also, this URL will be ignored.</span>
					</div>
				</div>

				<!-- Save button -->
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-1">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
					<div class="col-sm-9 alert alert-danger" role="alert" id="output"
						style="display: none;"></div>
				</div>

			</form>

		</div>
		<!-- end content -->

	</div>
	<!-- end container -->

	<?php require_once "admin_footer.php"; ?>

	<!-- The below script highlights the menu selection -->
	<script>
	$("#menu_new").addClass("active");
	$("#menu_new_article").addClass("active");

	// function to check image
	function checkImage(imageFieldName, imageID, outputID) {
		// if image is empty, just exit this function
		if (!$(imageID).val()) {
			return true;
		}

		if (window.File && window.FileReader && window.FileList && window.Blob) {
	        var fsize = $(imageID)[0].files[0].size; //get file size
	        var ftype = $(imageID)[0].files[0].type; // get file type

	        //allow only valid image file types 
	        switch(ftype) {
	            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
					break;
	            default:
					$(outputID).html(imageFieldName + ": <strong>" + ftype + "</strong> Unsupported file type!");
					$(outputID).show();
					return false;
			}

			// Allowed file size is less than 2 MB (2097152)
	        if(fsize > 2097152) {
	            $(outputID).html(imageFieldName + ": <strong>" + fsize +
	    	            "</strong> Too big Image file! <br>Please reduce the size of your photo using an image editor.");
	            $(outputID).show();
	            return false;
	        }
	        
		} else {
	        //Output error to older browsers that do not support HTML5 File API
	        $(outputID).html(imageFieldName + ": Please upgrade your browser, because your current browser lacks some new features we need!");
	        $(outputID).show();
	        return false;
		}

		return true;
	} // end function checkImage

	//function to check file size before uploading.
	function checkForm() {
		// check whether browser fully supports all File API
		if (!checkImage("Image 1", "#image1_file", "#output")) {
			alert("check image failed");
			return false;
		}

		return true;
	}
	</script>
</body>
</html>