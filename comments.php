<?php
	require ("includes/common.php");
	session_start();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EazyCart</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<body style="overflow-x:hidden; padding-bottom:50px;">
    <?php
        include 'includes/header_menu.php';
    ?>
    <br><br><br>
    <div style="margin: auto; width: 60%; border: 5px solid #FFFF00; padding: 10px;">
    <?php
        if(isset($_POST["email"]) && isset($_SESSION['email'])) {
            $em = $_POST["email"];

            // $cmt = $_POST["message"]; // vulnerable to XSS

            $cmt = strip_tags($_POST["message"]); // safe to insert comment into the db
            /* strip_tags() function strips a string from HTML, XML, and PHP tags. */ 

            $cmt = jsEscape($cmt); // helps to further santize the input 

            $sql = "INSERT INTO comments_tbl(comment) values('$cmt')";
            if(mysqli_query($con, $sql)){
                echo "<h3>Comment added successfully</h3>";
            } 
            
            else {
                echo "ERROR: $sql. ". mysqli_error($con);
            }
            echo "<br><hr noshade>";
        }

        if (!isset($_SESSION['email'])) {
            echo "<h4>You must be logged in to post comments!!!</h4><br>";
        }
    ?>
    <?php
        // unicode-escape input method
        function jsEscape($str) {
            $output = '';
            $str = str_split($str);
            for($i=0; $i<count($str); $i++) 
            {
                $chrNum = ord($str[$i]);
                $chr = $str[$i];
                if($chrNum === 226) 
                {
                    if(isset($str[$i+1]) && ord($str[$i+1]) === 128) {
                        if(isset($str[$i+2]) && ord($str[$i+2]) === 168) {
                            $output .= '\u2028';
                            $i += 2;
                            continue;
                        }

                        if(isset($str[$i+2]) && ord($str[$i+2]) === 169) {
                            $output .= '\u2029';
                            $i += 2;
                            continue;
                        }
                    }
                }

                // replaces special character with their unicode value
                switch($chr) {
                    case "'":
                    case '"':
                    case "\n";
                    case "\r";
                    case "&";
                    case "\\";
                    case "<":
                    case ">":
                        $output .= sprintf("\\u%04x", $chrNum);
                        break;
                    default:
                        $output .= $str[$i];
                        break;
                }
            }
            return $output;
        }
    ?> 

    <p> Check comments posted:</p><br>
    <?php
        $sql = "SELECT * FROM comments_tbl";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<b>Anonymous user</b> " . "<i>posted at </i>". $row["comment_at"]. "<br>";
                echo "&nbsp;&nbsp;" . $row["comment"]. "<br><br>";
        }
        } 
        else {
            echo "No comments have been posted yet.";
        }
    ?>
    </div>
    <?php include 'includes/footer.php'?>
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