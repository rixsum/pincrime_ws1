<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PinCrime</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style1.css" rel="stylesheet">
  <style>
    .container-md{
      background-color: white;
      max-width: 1250px;
      border-radius: 10px;
      border: 1px solid #FF2400;
    }
  </style>
</head>

<body>
  <<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <div class="logo me-auto">
        <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      </div>
      <nav id="navbar" class="navbar navbar-expand-lg">
        <ul class="nav navbar-nav ms-auto order-last order-lg-0">
          <li class="nav-item"><a class="nav-link active" href="#hero">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="login.php">Sign In</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container text-start text-md-left" data-aos="fade-up">
      <h1>Welcome to <span>PinCrime</span></h1>
      <h2>Navigating Crime, Empowering Change</h2>
    </div>
  </section>

  <section id="latest-posts" class="container mt-5 text-center">
    <h2 class="mb-4">Latest Reported Posts</h2>
    <div class="row">
    <?php
      require "conn.php";
      $result = $conn->query("SELECT * FROM report ORDER BY date DESC");
      while($row = $result->fetch_assoc()) {
    ?>
      <div class="container-md my-4 p-3">
          <div class="row">
              <div class="col-4 d-flex justify-content-center align-items-center">
                  <img src="<?php echo $row['pic_evidence'];?>" alt="Image" style="max-height: 200px; max-width: 300px;">
              </div>
              <div class="col-8">
                  <div class="row">
                      <div class="col-9 text-start"><h4><?php echo $row['title'];?></h4></div>
                      <div class="col-3 text-end"><i><p>Status: <b><?php echo $row['status']?></b></p></i></div>
                  </div>
                  <div class="row">
                      <div class="col-8 text-start"><p><?php echo "Crime: " . $row['crime'];?></p></div>
                      <div class="col-4 text-end"><p><?php echo "Date: " . date('Y-m-d g:i A', strtotime($row['date'])); ?></p></div>
                  </div>
                  <div class="row justify-content-center">
                      <p class="text-start"><?php echo $row['content']?></p>
                  </div>
                  <div class="row">
                      <a href="citizen_post.php?reportID=<?php echo $row['reportID'];?>" class="col-4 text-start" style="color: #FF2400;">Read More</a>
                      <p class="col-8 text-end"><?php echo "Posted by: " . $row['username']?></p>
                  </div>
              </div>       
          </div>
      </div>
    <?php
        }
        $result->free_result();
        $conn->close();
    ?>
    </div>
  </section>

  <footer class="bg-light text-danger text-center py-3 mt-5">
    <div class="container">
      <p>&copy; 2024 PinCrime. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

  <script src="assets/js/main.js"></script>

</body>

</html>
