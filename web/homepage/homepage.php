<?php include "templates/header.php"; ?>

 <div class="container">
    <!-- Nav bar-->
    <nav class="navbar navbar-expand-lg navbar-light ">
      <a class="navbar-brand" hreg="#">SH</a>
    </nav>
    <!-- Jumbotron -->
    <div class="jumbotron bg-secondary" id="banner">
      <h1>Sheri Hansen</h1>
      <p id="quote">The meaning of life is to find your gift. The purpose of life is to give it away.
        <br/> Anonymous
      </p>
      <a href="assignments.php" class="btn btn-info" role="button">Assignments</a>
    </div>
    <!-- Cards -->
    <div class="row">
      <div class="col-md-4" id="interest1">
        <div class="topImg">
          <img class="card-img-top" src="images/books.jpeg">
          <div class="overlay">
              <p class="text">Family</p>
            </div>
        </div>
        <div class="card  mb-4 box-shadow">
          <div class="card-body ">
            <h2 class="card-title">Reading</h2>
            <p class="card-text">I love to read and can't wait till I have a little more time to read all of the books I haven't gotten to yet </p>
          </div><!--body-->
        </div><!--card-->
      </div><!--column-->
      <div class="col-md-4" id="interest1">
        <img class="card-img-top" src="images/typingOnLaptop.jpeg">
        <div class="card  mb-4 box-shadow">
          <div class="card-body ">
            <h2 class="card-title">School</h2>
            <p class="card-text">I am a senior at BYUI and am excited and nervous to only have 4 semesters left till I graduate</p>
         </div><!--body-->
        </div><!--card-->
      </div><!--column-->
      <div class="col-md-4" id="interest1">
        <img class="card-img-top" src="images/succulent.jpeg">
        <div class="card  mb-4 box-shadow">
          <div class="card-body ">
            <h2 class="card-title">Succulents</h2>
            <p class="card-text">I received my first succulent as a gift last year, and am in love! Despite the lack of light and cold weather here, I have managed to keep it alive so far. </p>
          </div><!--body-->
        </div><!--card-->
      </div><!--column-->
  </div><!--row-->
</div><!--container-->

<?php include "templates/footer.php"; ?>