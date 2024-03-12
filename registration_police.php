<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/layout/logo_new.png" type="image/x-icon">
    <title>Registration Form | PinCrime</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: url('images/layout/back2.png') no-repeat center center fixed;
            background-size: cover;
        }
        .form-container {
            background-color: white;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            background-image: url('your_image.jpg');
            background-size: cover;
            background-position: left;
        }
    </style>
</head>
<body>

    <div class="container p-1">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h2 class="text-center mb-4">Police Registration</h2>

                <form action="registration_police.php" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : ''; ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="middleName">Middle Name</label>
                            <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo isset($_POST['middleName']) ? htmlspecialchars($_POST['middleName']) : ''; ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="strAddress">Street Address</label>
                            <input type="text" class="form-control" id="strAddress" name="strAddress" value="<?php echo isset($_POST['strAddress']) ? htmlspecialchars($_POST['strAddress']) : ''; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="braAddress">Barangay Address</label>
                            <select class="form-control" name="braAddress" id="braAddress" required>
                                <option value="" hidden></option>
                                <option value="" hidden></option>
                                <option value="Anonas">Anonas</option>
                                <option value="Bactad East">Bactad East</option>
                                <option value="Bayaoas">Bayaoas</option>
                                <option value="Bolaoen">Bolaoen</option>
                                <option value="Cabaruan">Cabaruan</option>
                                <option value="Cabuloan">Cabuloan</option>
                                <option value="Camanang">Camanang</option>
                                <option value="Camantiles">Camantiles</option>
                                <option value="Casantaan">Casantaan</option>
                                <option value="Catablan">Catablan</option>
                                <option value="Cayambanan">Cayambanan</option>
                                <option value="Consolacion">Consolacion</option>
                                <option value="Dilan-Paurido">Dilan-Paurido</option>
                                <option value="Labit Proper">Labit Proper</option>
                                <option value="Labit West">Labit West</option>
                                <option value="Mabanogbog">Mabanogbog</option>
                                <option value="Macalong">Macalong</option>
                                <option value="Nancalobasaan">Nancalobasaan</option>
                                <option value="Nancamaliran East">Nancamaliran East</option>
                                <option value="Nancamaliran West">Nancamaliran West</option>
                                <option value="Nancayasan">Nancayasan</option>
                                <option value="Oltama">Oltama</option>
                                <option value="Palina East">Palina East</option>
                                <option value="Palina West">Palina West</option>
                                <option value="Pedro T. Orata">Pedro T. Orata</option>
                                <option value="Pinmaludpod">Pinmaludpod</option>
                                <option value="Poblacion">Poblacion</option>
                                <option value="San Jose">San Jose</option>
                                <option value="San Vicente">San Vicente</option>
                                <option value="Santa Lucia">Santa Lucia</option>
                                <option value="Santo Domingo">Santo Domingo</option>
                                <option value="Sugcong">Sugcong</option>
                                <option value="Tiposu">Tiposu</option>
                                <option value="Tulong">Tulong</option>
                            </select>      
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="age">Age</label>
                            <input type="number" class="form-control" id="age" name="age" min="0" value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : ''; ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="" hidden></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="civilStatus">Civil Status</label>
                            <select class="form-control" id="civilStatus" name="civilStatus" required>
                                <option value="" hidden></option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" pattern="[0-9]{11}" minlength="11" maxlength="11" value="<?php echo isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : ''; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="division">Division/Unit</label>
                            <select class="form-control" name="division" id="division" required>
                                <option value="" hidden></option>
                                <option value="Intelligence Group (IG)">Intelligence Group (IG)</option>
                                <option value="Police Security and Protection Group (PSPG)">Police Security and Protection Group (PSPG)</option>
                                <option value="Criminal Investigation and Detective Group (CIDG)">Criminal Investigation and Detective Group (CIDG)</option>
                                <option value="Aviation Security Group (AVEGROUP)">Aviation Security Group (AVEGROUP)</option>
                                <option value="Highway Patrol Group (HPG)">Highway Patrol Group (HPG)</option>
                                <option value="Police Community Relations Group (PCRG)">Police Community Relations Group (PCRG)</option>
                                <option value="Civil Security Group (CSG)">Civil Security Group (CSG)</option>
                                <option value="Crime Laboratory (CL)">Crime Laboratory (CL)</option>
                                <option value="PNP Anti-Kidnapping Group (PNP-AKG)">PNP Anti-Kidnapping Group (PNP-AKG)</option>
                                <option value="PNP Anti-Cybercrime Group (PNP-ACG)">PNP Anti-Cybercrime Group (PNP-ACG)</option>
                            </select>      
                        </div>
                        <div class="form-group col-md-6">
                            <label for="officerRank">Officer Rank</label>
                            <select class="form-control" name="officerRank" id="officerRank" required>
                                <option value="" hidden></option>
                                <optgroup label="Commissioned Officers">
                                    <option value="Police General (PGEN)">Police General (PGEN)</option>
                                    <option value="Police Lieutenant General (PLTGEN)">Police Lieutenant General (PLTGEN)</option>
                                    <option value="Police Major General (PMGEN)">Police Major General (PMGEN)</option>
                                    <option value="Police Brigadier General (PBGEN)">Police Brigadier General (PBGEN)</option>
                                    <option value="Police Colonel (PCOL)">Police Colonel (PCOL)</option>
                                    <option value="Police Lieutenant Colonel (PLTCOL)">Police Lieutenant Colonel (PLTCOL)</option>
                                    <option value="Police Major (PMAJ)">Police Major (PMAJ)</option>
                                    <option value="Police Captain (PCPT)">Police Captain (PCPT)</option>
                                    <option value="Police Lieutenant (PLT)">Police Lieutenant (PLT)</option>   
                                </optgroup>
                                <optgroup label="Non-Commissioned Officers">
                                    <option value="Police Executive Master Sergeant (PEMS)">Police Executive Master Sergeant (PEMS)</option>
                                    <option value="Police Chief Master Sergeant (PCMS)">Police Chief Master Sergeant (PCMS)</option>
                                    <option value="Police Senior Master Sergeant (PSMS)">Police Senior Master Sergeant (PSMS)</option>
                                    <option value="Police Master Sergeant (PMSg)">Police Master Sergeant (PMSg)</option>
                                    <option value="Police Staff Sergeant (PSSg)">Police Staff Sergeant (PSSg)</option>
                                    <option value="Police Corporal (PCpl)">Police Corporal (PCpl)</option>
                                    <option value="Patrolman or Patrolwoman (Patmn/Patwmn)">Patrolman or Patrolwoman (Patmn/Patwmn)</option>
                            </select>    
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="badgeNumber">Badge Number / ID (6 digits)</label>
                        <input type="tel" class="form-control" id="badgeNumber" name="badgeNumber" pattern="\d{6}" minlength="6" maxlength="6" value="<?php echo isset($_POST['badgeNumber']) ? htmlspecialchars($_POST['badgeNumber']) : ''; ?>" required>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="profilePicture">Profile Picture</label>
                        <input type="file" class="form-control-file" id="profilePicture" name="profilePicture" accept="image/*" required>
                    </div>


                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-light" style="background-color: #FF2400; color: white;" name="reg">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
        require "conn.php";

        if (isset($_POST['reg'])) {
            $lname = $_POST['lastName'];
            $fname = $_POST['firstName'];
            $mname = $_POST['middleName'];
            $street = $_POST['strAddress'];
            $barangay = $_POST['braAddress'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $status = $_POST['civilStatus'];
            $phone = $_POST['phoneNumber'];
            $email = $_POST['email'];
            $division = $_POST['division'];
            $rank = $_POST['officerRank'];
            $badge = $_POST['badgeNumber'];
            $password = $_POST['password'];
            $confirm_pass = $_POST["confirmPassword"];


            if ($password !== $confirm_pass) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Password and Confirm Password do not match!'
                    });
                </script>";
            } else {


                $file_name = $_FILES['profilePicture']['name'];
                $type = $_FILES['profilePicture']['type'];
                $size = $_FILES['profilePicture']['size'];
                $temp = $_FILES['profilePicture']['tmp_name'];

                $allowedFileTypes = array('jpg', 'jpeg', 'png');
                $uploadedFileType = pathinfo($file_name, PATHINFO_EXTENSION);
                $file_location = "images/profile_pics/police/" . $file_name;

                $queryDuplicateCitizenPhone = $conn->query("SELECT phone FROM citizens WHERE phone='$phone'");
                $queryDuplicatePolicePhone = $conn->query("SELECT phone FROM police WHERE phone='$phone'");

                if ($queryDuplicateCitizenPhone->num_rows > 0 || $queryDuplicatePolicePhone->num_rows > 0) {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Phone number is already registered!'
                            });
                        </script>";
                } else {
                    $queryCitizenEmail = $conn->query("SELECT email FROM citizens WHERE email='$email'");
                    $queryPoliceEmail = $conn->query("SELECT email FROM police WHERE email='$email'");
                    $queryAdminEmail = $conn->query("SELECT email FROM admin WHERE email='$email'");
                    $queryPoliceBadge = $conn->query("SELECT badgeID FROM police WHERE badgeID='$badge'");
                    

                    if ($queryCitizenEmail->num_rows > 0 || $queryPoliceEmail->num_rows > 0 || $queryAdminEmail->num_rows > 0 ) {
                        echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Email address is already registered!'
                                });
                            </script>";
                    } elseif ($queryPoliceBadge->num_rows > 0) {
                        echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Username is already taken!'
                                });
                            </script>";
                    } else {
                        move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $file_location);

                        $insertQuery = "INSERT INTO police (pic, lname, fname, mname, street_add, barangay_add, age, gender, civilstat, phone, email, division, rank, badgeID, password) VALUES ('$file_location', '$lname', '$fname', '$mname', '$street', '$barangay', '$age', '$gender', '$status', '$phone', '$email', '$division', '$rank', '$badge', '$password')";

                        if ($conn->query($insertQuery)) {
                            echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registration Successful',
                                    text: 'You have successfully registered!',
                                    timer: 3000, // 3 seconds
                                    showConfirmButton: false
                                }).then(function () {
                                    window.location.href = 'login.php';
                                });
                            </script>";
                        }
                    }
                }
            }
        }
    ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
