<?php
    session_start();

    if (isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/layout/logo_new.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>
<body>
    <?php
        require "conn.php";

        if (isset($_GET['reportID'])) {
            $id = $_GET['reportID'];

            $sql = "DELETE FROM report WHERE reportID = $id";
            
            if ($conn->query($sql) === TRUE) {
                echo '<script>
                        swal({
                            title: "Success",
                            text: "Report deleted successfully!",
                            icon: "success",
                            timer: 2000,
                            timerProgressBar: true,
                            onClose: () => {
                                window.location.href = "admin_mng_reports.php";
                            }
                        });
                     </script>';
            } else {
                echo '<script>
                        swal({
                            title: "Error",
                            text: "Error deleting report: ' . $conn->error . '",
                            icon: "error"
                        });
                     </script>';
            }
        } elseif (isset($_GET['citizenID'])) {
            $id = $_GET['citizenID'];

            $sql = "DELETE FROM citizens WHERE citizenID = $id";
            
            if ($conn->query($sql) === TRUE) {
                echo '<script>
                        swal({
                            title: "Success",
                            text: "Citizen deleted successfully!",
                            icon: "success",
                            timer: 2000,
                            timerProgressBar: true,
                            onClose: () => {
                                window.location.href = "admin_mng_citizens.php";
                            }
                        });
                     </script>';
            } else {
                echo '<script>
                        swal({
                            title: "Error",
                            text: "Error deleting citizen: ' . $conn->error . '",
                            icon: "error"
                        });
                     </script>';
            }
        } elseif (isset($_GET['policeID'])) {
            $id = $_GET['policeID'];

            $sql = "DELETE FROM police WHERE policeID = $id";
            
            if ($conn->query($sql) === TRUE) {
                echo '<script>
                        swal({
                            title: "Success",
                            text: "Police deleted successfully!",
                            icon: "success",
                            timer: 2000,
                            timerProgressBar: true,
                            onClose: () => {
                                window.location.href = "admin_mng_police.php";
                            }
                        });
                     </script>';
            } else {
                echo '<script>
                        swal({
                            title: "Error",
                            text: "Error deleting police: ' . $conn->error . '",
                            icon: "error"
                        });
                     </script>';
            }
        } elseif (isset($_GET['crime_id'])) {
            $id = $_GET['crimeID'];

            $sql = "DELETE FROM type_crimes WHERE crime_id = $id";
            
            if ($conn->query($sql) === TRUE) {
                echo '<script>
                        swal({
                            title: "Success",
                            text: "Crime deleted successfully!",
                            icon: "success",
                            timer: 2000,
                            timerProgressBar: true,
                            onClose: () => {
                                window.location.href = "admin_mng_crime.php";
                            }
                        });
                     </script>';
            } else {
                echo '<script>
                        swal({
                            title: "Error",
                            text: "Error deleting crime: ' . $conn->error . '",
                            icon: "error"
                        });
                     </script>';
            }
        }
    ?>
</body>
<?php
    } else {
        header("Location:invalid.php");
    }
?>
