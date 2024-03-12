<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['badgeID']) && isset($_SESSION['password'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Homepage | PinCrime</title>
    <style>
        body {
            background: url('images/layout/back.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .container{         
            background-color: white; 
            max-width: 1020px;
            border-radius: 10px;
        }

        .container-md {
            max-width: 1020px;
            border-radius: 5px;
        }

    </style>
</head>
<body >
    <?php
        require "police_header.php";
    ?>
    <div class="container-md my-4 p-2">
        <form class="d-flex my-1" action="police_home.php" method="POST">
            <input class="form-control me-2 p-2" type="search" placeholder="Enter any report title, status, crime or date (YYYY-MM-DD)" aria-label="Search" name="search_data" >
            <button class="btn btn-outline-primary" type="submit" style="background-color: #FF2400; border-color: white; color: white;">Search</button>
        </form>
    </div>

    <?php
        if (isset($_POST['search_data'])) {
            $searchTerm = $_POST['search_data'];
            $query = "SELECT * FROM report WHERE title LIKE '%$searchTerm%' OR status LIKE '%$searchTerm%' OR crime LIKE '%$searchTerm%' OR date LIKE '%$searchTerm%' ORDER BY date DESC";
            $result = $conn->query($query);
    
            if ($result === false) {
                die("Error executing query: " . $conn->error);
            }

            while($row = $result->fetch_assoc()) {
    ?>
            <div class="container my-4 p-3">
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
                            <p><?php echo $row['content']?></p>
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
        } else { 
            $result = $conn->query("SELECT * FROM report ORDER BY date DESC");
            while($row = $result->fetch_assoc()) {
    ?>
            <div class="container my-4 p-3">
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
                            <p><?php echo $row['content']?></p>
                        </div>
                        <div class="row">
                            <a href="police_post.php?reportID=<?php echo $row['reportID'];?>" class="col-4 text-start" style="color: #FF2400;">Read More</a>
                            <p class="col-8 text-end"><?php echo "Posted by: " . $row['username']?></p>
                        </div>
                    </div>       
                </div>
            </div>
    <?php
            }
            $result->free_result();
            $conn->close();
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
