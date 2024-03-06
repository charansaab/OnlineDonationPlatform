<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $db = require __DIR__ . "/connection.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $db->query($sql);
    
    $user = $result->fetch_assoc();
}
?>

<?php
$db = require __DIR__ . "/connection.php";

$msg = "";
if (isset($_POST['submit'])){
    $target = "images/".basename($_FILES['image']['name']);
    $image = $_FILES['image']['name'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO images(image, title, content) VALUES('$image', '$title', '$content')";
    mysqli_query($db, $sql);
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        $msg = "Date Uploaded Successfully.";
    }else{
        $msg = "There is a problem uploading data.";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Online Marketplace</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/market.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyA1NxbqhKaKFylMn0vQ9-twXIkOjABvjxo"></script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Marketplace</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Products
                </a>
                      <div class="dropdown-menu bg-warning" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Food</a>
                      <a class="dropdown-item" href="#">Hosehold</a>
                      <a class="dropdown-item" href="#">Clothes</a>
                      <a class="dropdown-item" href="#">Electronics</a>
                      <a class="dropdown-item" href="#">Furniture</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">All Products List</a>
                      </div>
                </li>
                
            </ul>

        </div>
        <?php if (isset($user)): ?>
        
        <h6 class="text-center" style="margin:auto; color: white;">Hello <?= htmlspecialchars($user["name"])?> !</h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <p class="text-center" style="margin: auto;"><a class="btn btn-danger btn-sm" href="logout.php">Log out</a></p>
        
    <?php else: ?>
        
        <p class="text-center" style="margin:auto;"><a class="btn btn-warning btn-sm" href="login.php">Log In</a>
        <a class="btn btn-warning btn-sm" style="margin:auto;" href="signup.php">Sign Up</a></p>
        
    <?php endif; ?>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="text-center mb-2">
        <h1>Welcome to Our Online Donation Marketplace</h1>
        <p>Discover a wide range of charitable from all over India.</p>
        <a href="#products" class="btn btn-warning">Explore Now</a>
    </section>

 <!-- search location -->

     <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p><h4>Search your City</h4></p>
                   <div class="form-group">
                    <label>Location:</label>
                    <input type="text" class="form-control" id="search_input" placeholder="Type address..." />
                   </div>
            </div>
       </div>
     </div>

<script>
var searchInput = 'search_input';
 
$(document).ready(function () {
 var autocomplete;
 autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
  types: ['geocode'],
  /*componentRestrictions: {
   country: "USA"
  }*/
 });
  
 google.maps.event.addListener(autocomplete, 'place_changed', function () {
  var near_place = autocomplete.getPlace();
 });
});
</script>


    <!-- Upload data -->
    
    <div class="container mt-5">
    <h2 id="products">Uploaded Content</h2>
        <div class="card-deck">
           <?php
            $db = require __DIR__ . "/connection.php";
            $sql = "SELECT * FROM images";
            $result = mysqli_query($db, $sql);

    while($row = mysqli_fetch_array($result)) {
        echo "<div class='col-md-4'>";
        echo "<div class='card mb-4'>";
        echo "<img class='card-img-top' src='images/".$row['image']."'>";
        echo "<div class='card-body bg-light'>";
        echo "<h5 class='card-title'>".$row['title']."</h5>";
        echo "<p class='card-text'>".$row['content']."</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
         ?>
        </div>
        
        <section id="contact">
        <div class="container">
        <h2>Upload Content</h2>
        <form id="contactForm" action="market.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control text" id="content" name="content"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Select Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-dark" name="submit">Upload</button>
        </form>
        <hr>
</div>
</section>
        </div>

    <!-- Bootstrap JS and jQuery (for modal) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


