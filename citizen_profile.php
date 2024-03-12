<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password'])) {
        require "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/layout/logo_new.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>View Profile | PinCrime</title>
    <style>
        body {
            background: url('images/layout/back.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .container{
            background-color: white;           
            max-width: 600px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <?php
        require "citizen_header.php";

        $user = $_SESSION['email'];
        
        $userQuery= "SELECT * FROM citizens WHERE email = '$user'";
        $result = $conn->query($userQuery);
        $row = $result->fetch_assoc();

    ?>
    <div class="container my-4 p-4">
        <div class="text-center py-2"><h2>Username: <?php echo $row['username'];?></h2></div>
            <div class="row justify-content-center my-3">
                <img src="<?php echo $row['pic'] ?>" style="border-radius: 125px; width: 250px; height: 250px; object-fit: cover; object-position: center;">
            </div> 
            <div class="d-grid col-3 mx-auto my-4">
                <a href="citizen_profile_edit.php?citizenID=<?php echo $row['citizenID'];?>" class="btn btn-light" style="background-color: #FF2400; color: white;">Update Profile</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php
    } else {
        header("Location:invalid.php");
    }
?>