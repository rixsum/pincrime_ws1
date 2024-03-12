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
    <title>Manage Citizens | PinCrime</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    <style>
        .container-md{       
            background-color: white;    
            max-width: 750px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <?php
    require "admin_header.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];
        $title = $_POST['newTitle'];
        $status = $_POST['newStat'];
        $crime = $_POST['newCrime'];
        $content = $_POST['newContent'];
        $username = $_POST['newUsername'];
    
        $updateContentSQL = "UPDATE report SET title = '$title', status = '$status', crime = '$crime', content = '$content', username = '$username' WHERE reportID = $id";
    
        if ($conn->query($updateContentSQL) === TRUE) {
            if (!empty($_FILES['evidence']['name'])) {
                $file_name = $_FILES['evidence']['name'];
                $file_location = "images/evidences/" . $file_name;
    
                if (move_uploaded_file($_FILES["evidence"]["tmp_name"], $file_location)) {
                    $updateImageSQL = "UPDATE report SET pic_evidence = '$file_location' WHERE reportID = $id";
                    if ($conn->query($updateImageSQL) !== TRUE) {
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error updating image: " . $conn->error . "'
                            });
                        </script>";
                    }
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error moving uploaded image.'
                        });
                    </script>";
                }
            }  
            header("Location: admin_mng_reports.php");
            exit;
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error updating report content: " . $conn->error . "'
                });
            </script>";
        }
    }
    
    if (isset($_GET['reportID'])) {
        $id = $_GET['reportID'];

        $result = $conn->query("SELECT * from report WHERE reportID = $id");
        $row = $result->fetch_assoc();

        $conn->close();
    }
    ?>
    <div class="container-md mt-1 p-2">
        <div class="text-center py-2"><h2>Report ID No. <?php echo $id; ?></h2></div>
            <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">         
                <div class="row justify-content-center">
                    <label class="col col-form-label fw-bold" for="newTitle">Title: </label>
                </div>
                <div class="row justify-content-center mb-2">
                    <div class="col"><input class="form-control" type="text" name="newTitle" value="<?php echo $row['title']; ?>"></div>
                </div>
                <div class="row justify-content-center">
                    <label class="col-6 col-form-label fw-bold" for="newAge">Status: </label>
                    <label class="col-6 col-form-label fw-bold" for="newGender">Crime: </label>
                </div>
                <div class="row justify-content-center mb-2">
                    <div class="col-6">
                        <select class="form-select" name="newStat" id="newStat">
                            <option value="Reported" <?php echo ($row['status'] == 'Reported') ? 'selected' : ''; ?>>Reported</option>
                            <option value="In Progress" <?php echo ($row['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                            <option value="Resolved" <?php echo ($row['status'] == 'Resolved') ? 'selected' : ''; ?>>Resolved</option>
                            <option value="Closed" <?php echo ($row['status'] == 'Closed') ? 'selected' : ''; ?>>Closed</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <select class="form-select" name="newCrime" id="newCrime">
                            <option value="Theft" <?php echo ($row['crime'] == 'Theft') ? 'selected' : ''; ?>>Theft</option>
                            <option value="Rape" <?php echo ($row['crime'] == 'Rape') ? 'selected' : ''; ?>>Rape</option>
                            <option value="Physical Injury" <?php echo ($row['crime'] == 'Physical Injury') ? 'selected' : ''; ?>>Physical Injury</option>
                            <option value="Robbery" <?php echo ($row['crime'] == 'Robbery') ? 'selected' : ''; ?>>Robbery</option>
                            <option value="Murder" <?php echo ($row['crime'] == 'Murder') ? 'selected' : ''; ?>>Murder</option>
                            <option value="Carnapping" <?php echo ($row['crime'] == 'Carnapping') ? 'selected' : ''; ?>>Carnapping</option>
                            <option value="Homicide" <?php echo ($row['crime'] == 'Homicide') ? 'selected' : ''; ?>>Homicide</option>
                        </select>    
                    </div>
                </div>
                <div class="row justify-content-center">
                    <label class="col col-form-label fw-bold" for="date">Date: </label>
                </div> 
                <div class="row justify-content-center mb-2">
                    <div class="col">
                        <input class="form-control" type="text" name="date" id="date" value="<?php echo $row['date']; ?>" readonly>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <label class="col col-form-label fw-bold" for="evidence">Upload New Evidence: </label>
                </div> 
                <div class="row justify-content-center mb-2">
                    <div class="col">
                        <input class="form-control" type="file" name="evidence" id="evidence">
                    </div>
                </div>  
                <div class="row justify-content-center">
                    <label class="col col-form-label fw-bold" for="newContent">Content: </label>
                </div>
                <div class="row justify-content-center mb-2">
                    <textarea class="form-control" name="newContent" id="newContent" style="height: 300px"><?php echo $row['content']; ?></textarea>
                </div>
                <div class="row justify-content-center">
                    <label class="col col-form-label fw-bold" for="newUsername">Username: </label>
                </div> 
                <div class="row justify-content-center mb-2">
                    <div class="col">
                        <input class="form-control" type="text" name="newUsername" id="newUsername" value="<?php echo $row['username']; ?>">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <label class="col-6 col-form-label fw-bold" for="latitude">Latitude: </label>
                    <label class="col-6 col-form-label fw-bold" for="longitude">Longitude: </label>
                </div> 
                <div class="row justify-content-center mb-2">
                    <div class="col-6">
                        <input class="form-control" type="text" name="latitude" id="latitude" value="<?php echo $row['latitude']; ?>" readonly>
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="text" name="longitude" id="longitude" value="<?php echo $row['longitude']; ?>" readonly>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <label class="col-form-label fw-bold" for="address">Address: </label>
                </div>
                <div class="row justify-content-center mb-2">
                    <div class="col">
                        <input class="form-control" type="text" name="address" id="address" value="<?php echo $row['address']; ?>" readonly>
                    </div>
                </div>
                <div class="d-grid col-2 mx-auto my-2">
                    <input type="submit" class="btn btn-light my-4" name="edit" value="Update Changes" style="background-color: #FF2400; color: white;">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
} else {
    header("Location:invalid.php");
}
?>
