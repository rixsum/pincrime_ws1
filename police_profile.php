<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['badgeID']) && isset($_SESSION['password'])) {
        require "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/layout/logo_new.png" type="image/x-icon">
    <title>View Profile | PinCrime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/15d9447ee4.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: url('images/layout/back.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .container{
            background-color: white;           
            max-width: 700px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <?php
        require "police_header.php";
        $user = $_SESSION['email'];
        
        $userQuery= "SELECT * FROM police WHERE email = '$user'";
        $result = $conn->query($userQuery);
        $row = $result->fetch_assoc();
    ?>
    <div class="container my-4">
        <div class="text-center py-2"><h2>Badge ID: <?php echo $row['badgeID'];?></h2></div>
            <div class="row justify-content-center my-3">
                <img src="<?php echo $row['pic'] ?>" style="border-radius: 125px; width: 250px; height: 250px; object-fit: cover; object-position: center;">
            </div>
            <div class="d-grid col-3 mx-auto my-4">
                <a href="police_profile_edit.php?policeID=<?php echo $row['policeID'];?>" class="btn btn-light" style="background-color: #FF2400; color: white;">Update Profile</a>
            </div>
            <div class="row justify-content-center text-center mt-1">
                <label class="col-12 col-form-label fw-bold">Full Name</label>
            </div>
            <div class="row justify-content-center mb-2 ">
                <div class="col-12">
                    <input class="form-control text-center" type="text" value="<?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?>" readonly>
                </div>
            </div>
            <div class="row justify-content-center text-center">
                <label class="col-6 col-form-label fw-bold">Full Address</label>
            </div>
            <div class="row justify-content-center mb-2">
                <div class="col-12">
                    <input class="form-control text-center" type="text" value="<?php echo $row['street_add'] . ' ' . $row['barangay_add']; ?>" readonly>
                </div>
            </div>
            <div class="row justify-content-center">
                <label class="col-4 col-form-label fw-bold" >Division/Unit: </label>
                <label class="col-4 col-form-label fw-bold" >Officer Rank: </label>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-6">
                    <input class="form-control text-center" type="text" value="<?php echo $row['division']; ?>" readonly>
                </div>
                <div class="col-6">
                    <input class="form-control text-center" type="text" value="<?php echo $row['rank']; ?>" readonly>
                </div>
            </div>
            <div class="row justify-content-center text-center">
                <label class="col-4 col-form-label fw-bold">Age</label>
                <label class="col-4 col-form-label fw-bold">Gender</label>
                <label class="col-4 col-form-label fw-bold">Civil Status</label>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-4">
                    <input class="form-control text-center" type="number" value="<?php echo $row['age']; ?>" readonly>
                </div>
                <div class="col-4">
                    <input class="form-control text-center" type="text" value="<?php echo $row['gender']; ?>" readonly>
                </div>
                <div class="col-4">
                    <input class="form-control text-center" type="text" value="<?php echo $row['civilstat']; ?>" readonly>
                </div>
            </div> 
            <div class="row justify-content-center text-center">
                <label class="col-6 col-form-label fw-bold">Phone Number</label>
                <label class="col-6 col-form-label fw-bold">Email</label>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-6 mb-4">
                    <input class="form-control text-center" type="number" value="<?php echo $row['phone']; ?>" readonly>
                </div>
                <div class="col-6 mb-4">
                    <input class="form-control text-center" type="email" value="<?php echo $row['email']; ?>" readonly>
                </div>
            </div> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php
    } else {
        header("Location:invalid.php");
    }
?>