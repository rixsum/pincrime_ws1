
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/layout/logo_new.png" type="image/x-icon">
    <title>Login | PinCrime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
  <style>
        body {
            background: url('images/layout/back5.png') no-repeat center center fixed;
            background-size: cover;
        } 
    </style>
<body>

    <section class="vh-100" >
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="row g-0">

                <div class="col-md-6 col-lg-5 d-none d-md-block">
                    <img src="images/layout/back6.png" 
                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">

                    <form action="" method="post">

                      <div class="d-flex align-items-center mb-3 pb-1">
                        <span class="h1 fw-bold mb-0">LOGIN</span>
                      </div>

                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control form-control-lg" placeholder="email" name="email" required>
                            <label for="email" class="form-label">Email</label>
                        </div>

                  
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required>
                            <label class="form-label" for="password">Password</label>
                        </div>

                        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
                        <div class="pt-1 mb-4">
                          <button class="btn btn-light btn-lg btn-block" type="submit" style="background-color: #FF2400; color: white" name="login">Login</button>
                        </div>
                    </form>
                      <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="registration_citizen.php"
                          style="color: #393f81;">Register as Citizen</a> / <a href="registration_police.php"
                          style="color: #393f81;">Register as Police</a>
                      </p>
                      <?php
                        require "conn.php";
                        if (isset($_POST['login'])) {
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            $citizenResult = $conn->query("SELECT * FROM citizens WHERE email = '$email' AND password = '$password'");
                            $policeResult = $conn->query("SELECT * FROM police WHERE email = '$email' AND password = '$password'");
                            $adminResult = $conn->query("SELECT * FROM admin WHERE email = '$email' AND password = '$password'");

                            if ($citizenResult->num_rows > 0) {
                                $row = $citizenResult->fetch_assoc();
                                if ($row['ban'] == 'Yes') {
                                  echo '<script>
                                            Swal.fire({
                                                icon: "error",
                                                title: "Account Banned",
                                                text: "Sorry, your account has been suspended."
                                            });
                                        </script>';
                                } else {
                                  session_start();
                                  $_SESSION['user_type'] = 'citizen';
                                  $_SESSION['email'] = $row['email'];
                                  $_SESSION['username'] = $row['username'];
                                  $_SESSION['password'] = $row['password'];
                                  echo '<script>
                                          Swal.fire({
                                              icon: "success",
                                              title: "Login Successful",
                                              text: "Redirecting to Citizen Homepage...",
                                              timer: 1500, 
                                              showConfirmButton: false
                                          }).then(function() {
                                              window.location.href = "citizen_home.php";
                                          });
                                        </script>';
                                }         
                            } elseif ($policeResult->num_rows > 0) {
                                session_start();
                                $row = $policeResult->fetch_assoc();
                                $_SESSION['user_type'] = 'police';
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['badgeID'] = $row['badgeID'];
                                $_SESSION['password'] = $row['password'];
                                echo '<script>
                                        Swal.fire({
                                            icon: "success",
                                            title: "Login Successful",
                                            text: "Redirecting to Police Homepage...",
                                            timer: 1500, 
                                            showConfirmButton: false
                                        }).then(function() {
                                            window.location.href = "police_home.php";
                                        });
                                      </script>';
                            } elseif ($adminResult->num_rows > 0) {
                                session_start();
                                $row = $adminResult->fetch_assoc();
                                $_SESSION['user_type'] = 'admin';
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['username'] = $row['username'];
                                $_SESSION['password'] = $row['password'];
                                echo '<script>
                                        Swal.fire({
                                            icon: "success",
                                            title: "Login Successful",
                                            text: "Redirecting to Admin Dashboard...",
                                            timer: 1500, 
                                            showConfirmButton: false
                                        }).then(function() {
                                            window.location.href = "admin_mng_reports.php";
                                        });
                                      </script>';
                            } else {
                                echo '<script>
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "Invalid Credentials!"
                                        });
                                      </script>';
                            }
                            $conn->close();
                        }
                      ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>