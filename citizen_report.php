<?php 
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password'])) {
        require "conn.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/layout/logo_new.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Report Crime | PinCrime</title>
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
<body onload = "getLocation()">
    <?php
        require "citizen_header.php";
    ?>
    <div class="container my-4">
        <div class="text-center mt-3 py-3"><h2>Report a Crime</h2></div>
        <form class="reportForm" action="citizen_report.php" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center mx-1 my-2">
                <label class="form-label fw-bold" for="title">Title: </label>
                <input class="form-control" type="text" name="title" id="title">
            </div>
            <div class="row justify-content-center mx-1 my-2">
                <label class="form-label fw-bold" for="category">Type of Crime: </label>
                <select class="form-select" name="category" id="category">
                    <option value="" hidden></option>
                <?php
                $crimes = $conn->query("SELECT crime from type_crimes") or die("error");
                while ($row1 = $crimes->fetch_assoc()) {
                ?>
                    <option value="<?php echo $row1['crime']?>"><?php echo $row1['crime']?></option>
                <?php
                }
                $crimes->free_result();
                ?>
                </select><br>
            </div>
            <div class="row justify-content-center mx-1 my-2">
                <label class="form-label fw-bold" for="content">Evidence: </label>
                <input class="form-control" type="file" name="pic" id="pic">
            </div>  
            <div class="row justify-content-center mx-1 my-2">
                <label class="form-label fw-bold" for="content">Content: </label>
                <textarea class="form-control" name="content" id="content" style="height:350px"></textarea>
            </div>    
            <div class="row justify-content mx-1 my-2">
                <label class="col-form-label fw-bold" for="title">Location: </label>
                <label class="col-2 col-form-label" for="latitude">Latitude: </label>
                <div class="col-4"><input class="form-control" type="number" name="latitude" id="latitude" readonly></div>
                <label class="col-2 col-form-label" for="longitude">Longitude: </label>
                <div class="col-4"><input class="form-control" type="number" name="longitude" id="longitude" readonly></div>   
            </div>       
            <div class="d-grid col-2 mx-auto my-2">
                <input class="btn btn-light my-4" type="submit" value="Submit Report" name="report" style="background-color: #FF2400; color: white;">
            </div>              
        </form>
    </div>
    <script type="text/javascript">
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            document.querySelector('.reportForm input[name = "latitude"]').value = position.coords.latitude;
            document.querySelector('.reportForm input[name = "longitude"]').value = position.coords.longitude;
        }
        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("You must allow location to be shared");
                    location.reload();
                    break;
            }
        }
    </script>  
    <?php
        require "conn.php";

        if (isset($_POST['report'])) {
            $title = $_POST['title'];
            $crimeType = $_POST['category'];

            $file_name = $_FILES['pic']['name'];
            $type = $_FILES['pic']['type'];
            $size = $_FILES['pic']['size'];
            $temp = $_FILES['pic']['tmp_name'];

            $allowedFileTypes = array('jpg', 'jpeg', 'png');
            $uploadedFileType = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_location = "images/evidences/" . $file_name;

            $content = $_POST['content'];
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];

            $userQuery = $conn->query("SELECT street_add, barangay_add FROM citizens WHERE username = '$currentUser'");
            $userData = $userQuery->fetch_assoc();
            $fullAddress = $userData['street_add'] . ', ' . $userData['barangay_add'];

            if (empty($title) || empty($crimeType) || empty($content) || !in_array(strtolower($uploadedFileType), $allowedFileTypes)) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Invalid or missing data'
                    });
                </script>";
            } else if (!empty($file_name)) {
                move_uploaded_file($temp, $file_location);
                $sql = "INSERT INTO report (title, status, crime, date, pic_evidence, content, username, latitude, longitude, address) VALUES ('$title', 'Reported', '$crimeType', NOW(), '$file_location', '$content', '$currentUser', '$latitude', '$longitude', '$fullAddress')";
                if ($conn->query($sql)) {
                    echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Report successfully added!'
                    });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error inserting data into the database'
                        });
                    </script>";
                }
            } else {
                $sql = "INSERT INTO report (title, status, crime, date, content, username, latitude, longitude, address) VALUES ('$title', 'Reported', '$crimeType', NOW(), '', '$content', '$currentUser', '$latitude', '$longitude', '$fullAddress')";
                if ($conn->query($sql)) {
                    echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Report successfully added!'
                    });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error inserting data into the database'
                        });
                    </script>";
                }
            }
        }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<?php
    } else {
        header("Location:invalid.php");
    }
?>
