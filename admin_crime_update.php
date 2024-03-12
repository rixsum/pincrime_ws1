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
        $crime = $_POST['newCrime'];
        $description = $_POST['newDesc'];
    
        $updateContentSQL = "UPDATE type_crimes SET crime = '$crime', description = '$description' WHERE crime_id = $id";
    
        if ($conn->query($updateContentSQL) === TRUE) { 
            header("Location: admin_mng_crime.php");
            exit;
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error updating crime details: " . $conn->error . "'
                });
            </script>";
        }
    }
    
    if (isset($_GET['crime_id'])) {
        $id = $_GET['crime_id'];

        $result = $conn->query("SELECT * from type_crimes WHERE crime_id = $id");
        $row = $result->fetch_assoc();

        $conn->close();
    }
    ?>
    <div class="container-md mt-1 p-2">
        <div class="text-center py-2"><h2>Crime ID No. <?php echo $id; ?></h2></div>
        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">         
            <div class="row justify-content-center">
                <label class="col-form-label fw-bold" for="newCrime">Crime: </label>
            </div>
            <div class="row justify-content-center mb-2">
                <div class="col">
                    <input class="form-control" type="text" name="newCrime" id="newCrime" value="<?php echo $row['crime']; ?>">
                </div>
            </div>
            <div class="row justify-content-center">
                <label class="col-form-label fw-bold" for="newDescription">Description: </label>
            </div>
            <div class="row justify-content-center mb-2">
                <textarea class="form-control" name="newDesc" id="newDesc" style="height: 300px"><?php echo $row['description']; ?></textarea>
            </div>
            <div class="d-grid col-2 mx-auto my-2">
                <input type="submit" class="btn btn-light my-4" name="edit" value="Update Changes" style="background-color: #FF2400; color: white;">
            </div>
        </form>
    </div>
</body>
</html>
<?php
} else {
    header("Location:invalid.php");
}
?>
