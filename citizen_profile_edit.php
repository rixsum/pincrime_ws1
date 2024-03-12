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
    <title>Edit Profile | PinCrime</title>
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
        require "citizen_header.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
            $id = $_POST['id'];
            $fname = $_POST['newFName'];
            $mname = $_POST['newMName'];
            $lname = $_POST['newLName']; 
            $stradd = $_POST['newStreet'];
            $baradd = $_POST['newBarangay'];
            $age = $_POST['newAge'];
            $gender = $_POST['newGender'];
            $stat = $_POST['newCivil'];
            $phone = $_POST['newPhone'];
            $_SESSION['email'] = $_POST['newEmail'];
            $_SESSION['username'] = $_POST['newUName'];
            $_SESSION['password'] = $_POST['newPass'];
            $email = $_SESSION['email'];
            $uname = $_SESSION['username'];
            $pass = $_SESSION['password'];

            $file_name = $_FILES['profile']['name'];
            $type = $_FILES['profile']['type'];
            $size = $_FILES['profile']['size'];
            $temp = $_FILES['profile']['tmp_name'];

            $allowedFileTypes = array('jpg', 'jpeg', 'png');
            $uploadedFileType = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_location = "images/profile_pics/citizen/" . $file_name;


            if ($file_location == "images/profile_pics/citizen/") {
                $sql = "UPDATE citizens SET fname = '$fname', mname = '$mname', lname = '$lname',  street_add = '$stradd', barangay_add = '$baradd', age = '$age', gender = '$gender', civilstat = '$stat', phone = '$phone', email = '$email', username = '$uname', password = '$pass' WHERE citizenID = $id";

                if ($conn->query($sql) === TRUE) {
                    $commentUpdateSql = "UPDATE citizen_comments SET username = '$uname' WHERE citizenID = '$id'";
                    $conn->query($commentUpdateSql);
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'User profile updated successfully!',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    </script>";
                    header("Location: citizen_profile.php");
                    exit;
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error updating profile: " . $connect->error . "'
                        });
                    </script>";
                }                
            }else{
                $sql = "UPDATE citizens SET pic = '$file_location', fname = '$fname', mname = '$mname', lname = '$lname',  street_add = '$stradd', barangay_add = '$baradd', age = '$age', gender = '$gender', civilstat = '$stat', phone = '$phone', email = '$email', username = '$uname', password = '$pass' WHERE citizenID = $id";
                if ($conn->query($sql) === TRUE) {
                    move_uploaded_file($_FILES["profile"]["tmp_name"], $file_location);
                    $commentUpdateSql = "UPDATE citizen_comments SET pic = '$file_location', username = '$uname' WHERE citizenID = '$id'";
                    $conn->query($commentUpdateSql);
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'User profile updated successfully!',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    </script>";

                    header("Location: citizen_profile.php");
                    exit;
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error updating profile: " . $connect->error . "'
                        });
                    </script>";
                } 
            }


        }

        if (isset($_GET['citizenID'])) {
            $id = $_GET['citizenID'];

            $result = $conn->query("SELECT * from citizens WHERE citizenID = $id");
            $row = $result->fetch_assoc();

            $conn->close();
        }

    ?>
    <div class="container my-4">
        <div class="text-center mt-3 py-3"><h2>User Profile</h2></div>
        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
             <div class="row justify-content-center mt-4">
                <label class="col col-form-label fw-bold" for="profile">Upload New Profile Picture: </label>
            </div> 
            <div class="row justify-content-center mb-4">
            <div class="col">
                <input class="form-control" type="file" name="profile" id="profile">
            </div>
            </div>           
            <div class="row justify-content-center">
                <label class="col-4 col-form-label fw-bold" for="newLName">Last Name: </label>
                <label class="col-4 col-form-label fw-bold" for="newFName">First Name: </label>
                <label class="col-4 col-form-label fw-bold" for="newMName">Middle Name: </label>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-4"><input class="form-control" type="text" name="newLName" value="<?php echo $row['lname']; ?>"></div>
                <div class="col-4"><input class="form-control" type="text" name="newFName" value="<?php echo $row['fname']; ?>"></div>
                <div class="col-4"><input class="form-control" type="text" name="newMName" value="<?php echo $row['mname']; ?>"></div>
            </div>
            <div class="row justify-content-center">
                <label class="col-6 col-form-label fw-bold" for="newStreet">Street Address: </label>
                <label class="col-6 col-form-label fw-bold" for="newBarangay">Barangay Address: </label>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-6"><input class="form-control" type="text" name="newStreet" value="<?php echo $row['street_add']; ?>"></div>
                <div class="col-6">
                    <select class="form-select" name="newBarangay" id="newBarangay">
                        <option value="Anonas" <?php echo ($row['barangay_add'] == 'Anonas') ? 'selected' : ''; ?>>Anonas</option>
                        <option value="Bactad East" <?php echo ($row['barangay_add'] == 'Bactad East') ? 'selected' : ''; ?>>Bactad East</option>
                        <option value="Bayaoas" <?php echo ($row['barangay_add'] == 'Bayaoas') ? 'selected' : ''; ?>>Bayaoas</option>
                        <option value="Bolaoen" <?php echo ($row['barangay_add'] == 'Bolaoen') ? 'selected' : ''; ?>>Bolaoen</option>
                        <option value="Cabaruan" <?php echo ($row['barangay_add'] == 'Cabaruan') ? 'selected' : ''; ?>>Cabaruan</option>
                        <option value="Cabuloan" <?php echo ($row['barangay_add'] == 'Cabuloan') ? 'selected' : ''; ?>>Cabuloan</option>
                        <option value="Camanang" <?php echo ($row['barangay_add'] == 'Camanang') ? 'selected' : ''; ?>>Camanang</option>
                        <option value="Camantiles" <?php echo ($row['barangay_add'] == 'Camantiles') ? 'selected' : ''; ?>>Camantiles</option>
                        <option value="Casantaan" <?php echo ($row['barangay_add'] == 'Casantaan') ? 'selected' : ''; ?>>Casantaan</option>
                        <option value="Catablan" <?php echo ($row['barangay_add'] == 'Catablan') ? 'selected' : ''; ?>>Catablan</option>
                        <option value="Cayambanan" <?php echo ($row['barangay_add'] == 'Cayambanan') ? 'selected' : ''; ?>>Cayambanan</option>
                        <option value="Consolacion" <?php echo ($row['barangay_add'] == 'Consolacion') ? 'selected' : ''; ?>>Consolacion</option>
                        <option value="Dilan-Paurido" <?php echo ($row['barangay_add'] == 'Dilan-Paurido') ? 'selected' : ''; ?>>Dilan-Paurido</option>
                        <option value="Labit Proper" <?php echo ($row['barangay_add'] == 'Labit Proper') ? 'selected' : ''; ?>>Labit Proper</option>
                        <option value="Labit West" <?php echo ($row['barangay_add'] == 'Labit West') ? 'selected' : ''; ?>>Labit West</option>
                        <option value="Mabanogbog" <?php echo ($row['barangay_add'] == 'Mabanogbog') ? 'selected' : ''; ?>>Mabanogbog</option>
                        <option value="Macalong" <?php echo ($row['barangay_add'] == 'Macalong') ? 'selected' : ''; ?>>Macalong</option>
                        <option value="Nancalobasaan" <?php echo ($row['barangay_add'] == 'Nancalobasaa') ? 'selected' : ''; ?>>Nancalobasaan</option>
                        <option value="Nancamaliran East" <?php echo ($row['barangay_add'] == 'Nancamaliran East') ? 'selected' : ''; ?>>Nancamaliran East</option>
                        <option value="Nancamaliran West" <?php echo ($row['barangay_add'] == 'Nancamaliran West') ? 'selected' : ''; ?>>Nancamaliran West</option>
                        <option value="Nancayasan" <?php echo ($row['barangay_add'] == 'Nancayasan') ? 'selected' : ''; ?>>Nancayasan</option>
                        <option value="Oltama" <?php echo ($row['barangay_add'] == 'Oltama') ? 'selected' : ''; ?>>Oltama</option>
                        <option value="Palina East" <?php echo ($row['barangay_add'] == 'Palina East') ? 'selected' : ''; ?>>Palina East</option>
                        <option value="Palina West" <?php echo ($row['barangay_add'] == 'Palina West') ? 'selected' : ''; ?>>Palina West</option>
                        <option value="Pedro T. Orata" <?php echo ($row['barangay_add'] == 'Pedro T. Orata') ? 'selected' : ''; ?>>Pedro T. Orata</option>
                        <option value="Pinmaludpod" <?php echo ($row['barangay_add'] == 'Pinmaludpod') ? 'selected' : ''; ?>>Pinmaludpod</option>
                        <option value="Poblacion" <?php echo ($row['barangay_add'] == 'Poblacion') ? 'selected' : ''; ?>>Poblacion</option>
                        <option value="San Jose" <?php echo ($row['barangay_add'] == 'San Jose') ? 'selected' : ''; ?>>San Jose</option>
                        <option value="San Vicente" <?php echo ($row['barangay_add'] == 'San Vicente') ? 'selected' : ''; ?>>San Vicente</option>
                        <option value="Santa Lucia" <?php echo ($row['barangay_add'] == 'Santa Lucia') ? 'selected' : ''; ?>>Santa Lucia</option>
                        <option value="Santo Domingo" <?php echo ($row['barangay_add'] == 'Santo Domingo') ? 'selected' : ''; ?>>Santo Domingo</option>
                        <option value="Sugcong" <?php echo ($row['barangay_add'] == 'Sugcong') ? 'selected' : ''; ?>>Sugcong</option>
                        <option value="Tiposu" <?php echo ($row['barangay_add'] == 'Tiposu') ? 'selected' : ''; ?>>Tiposu</option>
                        <option value="Tulong" <?php echo ($row['barangay_add'] == 'Tulong') ? 'selected' : ''; ?>>Tulong</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <label class="col-4 col-form-label fw-bold" for="newAge">Age: </label>
                <label class="col-4 col-form-label fw-bold" for="newGender">Gender: </label>
                <label class="col-4 col-form-label fw-bold" for="newCivil">Civil Status: </label>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-4"><input class="form-control" type="number" name="newAge" value="<?php echo $row['age']; ?>"></div>
                <div class="col-sm-2 form-check pt-2">
                    <input class="form-check-input" type="radio" id="male" name="newGender" value="Male" <?php if ($row['gender'] === 'Male') echo 'checked'; ?>>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="col-sm-2 form-check pt-2">
                    <input class="form-check-input" type="radio" id="female" name="newGender" value="Female" <?php if ($row['gender'] === 'Female') echo 'checked'; ?>>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="col-4">
                    <select class="form-select" name="newCivil" id="newCivil">
                        <option value="Single" <?php echo ($row['civilstat'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                        <option value="Married" <?php echo ($row['civilstat'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                        <option value="Divorced" <?php echo ($row['civilstat'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                        <option value="Widowedd" <?php echo ($row['civilstat'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center">
                <label class="col-6 col-form-label fw-bold" for="newPhone">Phone Number: </label>
                <label class="col-6 col-form-label fw-bold" for="newEmail">Email: </label>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-6"><input class="form-control" type="number" name="newPhone" value="<?php echo $row['phone']; ?>"></div>
                <div class="col-6"><input class="form-control" type="email" name="newEmail" value="<?php echo $row['email']; ?>"></div>
            </div>
            <div class="row justify-content-center">
                <label class="col-6 col-form-label fw-bold" for="newUName">Username: </label>
                <label class="col-6 col-form-label fw-bold" for="newPass">Password: </label>
            </div>
            <div class="row justify-content-center mb-4">
                <div class="col-6"><input class="form-control" type="text" name="newUName" value="<?php echo $row['username']; ?>"></div>
                <div class="col-6"><input class="form-control" type="text" name="newPass" value="<?php echo $row['password']; ?>"></div>
            </div>
            <div class="d-grid col-2 mx-auto my-2">
                <input type="submit" class="btn btn-light my-4" name="edit" value="Submit Changes" style="background-color: #FF2400; color: white;">
            </div>
        </form>
    </div>
    <?php
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php
    } else {
        header("Location:invalid.php");
    }
?>