<?php
	require ("includes/common.php");
	session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>EazyCart</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
	<link rel="stylesheet" href="style.css">
</head>
<body style="overflow-x:hidden; padding-bottom:100px;">
  	<?php
        include 'includes/header_menu.php';
    ?>
  	<div>
		<div class="container mt-5 ">
			<div class="row justify-content-around">
				<div class="col-md-5 mt-3">
				<h3 class="text-warning pt-3 title">Who We Are ?</h3>
				<hr />
				<img
					src="images/about.png"
					class="img-fluid d-block rounded mx-auto image-thumbnail">
				<p class="mt-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed atque, consequuntur cumque odit
					sapiente blanditiis, expedita ipsam molestiae voluptates reprehenderit ea modi eaque rerum dicta dolores,
					iusto ullam aliquid non?
					
					</p>
				</div>
				<div class="col-md-5 mt-3">
				<span class="text-warning pt-3">
					<h1 class="title">LIVE SUPPORT</h1>
					<h3>24 hours|7 days a week| 365 days a year Live Technical Support</h3>
				</span>
				<hr>
				<p>It is a long established fact that a reader will be distracted by the readable content of a page when
					looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of
					letters. There are many variations of passages of Lorel Ipsum available, but the majority have suffered
					alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
					If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing
					hidden in the middle of text.</p>

				</div>
			</div>
		</div>
	</div>
  <div class="container pb-3">
  </div>
  <div class="container mt-3 d-flex justify-content-center card pb-3 col-md-6">

    <form class="col-md-12" action="comments.php" method="POST" name="_next" onsubmit="validation()"> 
      <h3 class="text-warning pt-3 title mx-auto">Contact Form</h3>
	  <p style="color: red; font-size: 12px;">Must be logged in to post message!</p>
      <div class="form-group">
        <label for="exampleFormControlInput1">Email address</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter Your Email" name="email">
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Message</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="5"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button> <br><br>
	  <p><u><a href="comments.php">Check other Comments</a></u></p>
    </form>
	
  </div>
  </div>
  <?php include 'includes/footer.php'?>

  <script> 
		// validating form input by using js reg expn
        function validation() 
		{
            var email = document.getElementById('exampleFormControlInput1').value;
            var msg = document.getElementById('exampleFormControlTextarea1').value;
            
            var reEmail = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;
            if (!reEmail.test(email)) {
                alert("Please try again! Enter your email address with correct format.");
            }

			var reMsg = /^[\w ]+$/; // match only alphanumeric characters and spaces
            if (!reName.test(msg)) {
				alert("Error: Input contains invalid characters!");
                alert("Please enter your comment again with correct format.");
            }
			else 
				return (msg === "")?"No comment was entered.\n":"";

		}
        
    </script>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    $('[data-toggle="popover"]').popover();
  });
  $(document).ready(function () {

    if (window.location.href.indexOf('#login') != -1) {
      $('#login').modal('show');
    }

  });
</script>
<?php if(isset($_GET['error'])){ $z=$_GET['error']; echo "<script type='text/javascript'>
$(document).ready(function(){
$('#signup').modal('show');
});
</script>"; echo "
<script type='text/javascript'>alert('".$z."')</script>";} ?>
<?php if(isset($_GET['errorl'])){ $z=$_GET['errorl']; echo "<script type='text/javascript'>
$(document).ready(function(){
$('#login').modal('show');
});
</script>"; echo "
<script type='text/javascript'>alert('".$z."')</script>";} ?>
</html>
