<!doctype html>
<html lang="zxx">
<head>
	<?php require("partials/head.php"); ?>
</head>

    <body>
		<!-- START PRELOADER AREA -->
		<?php require("partials/loader.php"); ?>
		<!-- END PRELOADER AREA -->

		<!-- START HEADER AREA -->
		<?php require("partials/header.php"); ?>
		<!-- END HEADER AREA -->

		<!-- START PAGE TITLE AREA -->
		<div class="page-title-area bg-7">
			<div class="container">
				<div class="page-title-content">
					<h2>Join Us</h2>
					<ul>
						<li>
							<a href="/">
								Home 
							</a>
						</li>

						<li class="active">Join Us</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- END PAGE TITLE AREA -->

		<!-- START APPOINTMENT AREA -->
		<section class="appointment-area ptb-100">
			<div class="container">
				<div class="row">
					<div data-aos="fade-up" data-aos-duration="1200" class="col-lg-6">
						<div class="appointment-here-form">

							<h2>Love To Work With You</h2>
		
							<form id="application-form" action="/requests/application-form.php" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-6 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control mandatory" id="name" name="name" placeholder="Enter Your Name">
											<i class="bx bx-user"></i>
										</div>
									</div>
		
									<div class="col-lg-6 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control mandatory" id="email" name="email" placeholder="Enter Your Email">
											<i class="bx bx-user"></i>
										</div>
									</div>
		
									<div class="col-lg-6 col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control mandatory" id="phone" name="phone" placeholder="Enter Your Phone">
											<i class="bx bx-mobile-alt"></i>
										</div>
									</div>

									<div class="col-lg-12">
										<div class="form-group">
											<textarea name="message" class="form-control" id="message" cols="30" rows="8" placeholder="Do you have any questions ?"></textarea>
											<i class="bx bx-message"></i>
										</div>
									</div>

									<div class="col-lg-12">
										<label for="formFile" class="form-label">Your CV (should be .pdf)</label>
										<input class="form-control mandatory" name="file" type="file" id="file">
									</div>
									
									<div class="col-12 mt-3">
										<button type="button" id="apply" class="default-btn">Apply</button>
									</div>
								</div>
							</form>
						</div>
					</div>

					<div data-aos="fade-up" data-aos-duration="1600" class="col-lg-6">
						<div class="appointment-img"></div>
					</div>
				</div>
			</div>
		</section>
		<!-- END APPOINTMENT AREA -->

		<!-- Footer -->
		<?php require("partials/footer.php"); ?>
		
		<!-- START GO TOP AREA -->
		<?php require("partials/chevronUp.php"); ?>
		<!-- END GO TOP AREA -->

        <<!-- Scripts -->
		<?php require("partials/scripts.php"); ?>
    </body>
</html>