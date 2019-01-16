<?php 
$css = "assignStyle.css";
include "templates/header.php"; 
?>

<div class="container">
    <!-- Nav bar-->
    <nav class="navbar navbar-expand-lg navbar-light ">
      <a class="navbar-brand" href="homepage.php">SH</a>
    </nav>
    <!-- Jumbotron -->
    <div class="jumbotron bg-info" id="banner">
      <h1>Assignments</h1>
      <p>CS 313 Web Engineering II</p>
    </div>
    <!-- Cards -->
    <div class="row">
      <div class="col-md-4 ">
        <div class="card mb-4 bg-secondary box-shadow">
          <div class="card-body ">
            <a href="#">
              <h2 class="assignCard-title">Team Teach 02</h2>
              </a>
          </div><!--body-->
        </div><!--card-->
      </div><!--column-->
      <div class="col-md-4 ">
        <div class="card mb-4 bg-secondary box-shadow">
          <div class="card-body ">
            <a href="homepage.php">
              <h2 class="assignCard-title">Prove 02: Homepage</h2>
              </a>
          </div><!--body-->
        </div><!--card-->
      </div><!--column-->
      <div class="col-md-4 ">
        <div class="card mb-4 bg-secondary box-shadow">
          <div class="card-body ">
            <a href="#">
              <h2 class="assignCard-title">Team Teach 03 <br/> Coming Soon</h2>
              </a>
          </div><!--body-->
        </div><!--card-->
      </div><!--column-->
      <div class="col-md-4 ">
        <div class="card mb-4 bg-secondary box-shadow">
          <div class="card-body ">
            <a href="#">
              <h2 class="assignCard-title">Prove 03 <br/> Shopping Cart <br/> Coming Soon</h2>
              </a>
          </div><!--body-->
        </div><!--card-->
      </div><!--column-->
      <div class="col-md-4 ">
        <div class="card mb-4 bg-secondary box-shadow">
          <div class="card-body ">
            <a href="#">
              <h2 class="assignCard-title">Team Teach 04 <br/> Coming Soon</h2>
              </a>
          </div><!--body-->
        </div><!--card-->
      </div><!--column-->
      
  </div><!--row-->
</div><!--container-->
<?php include "templates/footer.php"; ?>