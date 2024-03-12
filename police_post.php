<?php
    session_start();
    if (isset($_SESSION['email']) && isset($_SESSION['badgeID']) && isset($_SESSION['password'])) {
        require "conn.php";

        if (isset($_GET['reportID'])) {
            $id = $_GET['reportID'];

            $result = $conn->query("SELECT * from report WHERE reportID = $id");
            $row1 = $result->fetch_assoc();
        }

        ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/15d9447ee4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <title><?php echo $row1['title'];?> | PinCrime</title>
    <style>
        body {
            background: url('images/layout/back.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .container{       
            background-color: white;    
            max-width: 1000px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <?php
        require "police_header.php";
    ?>
    <div class="container my-4 p-3">
        <ul class="nav nav-tabs" id="myTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="citizen-tab" data-bs-toggle="tab" href="#citizen" role="tab" aria-controls="citizen" aria-selected="true" style="color: black">Citizen Report</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="police-tab" data-bs-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="false" style="color: black;">Report's Location</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="police-tab" data-bs-toggle="tab" href="#police" role="tab" aria-controls="police" aria-selected="false" style="color: black;">Police Statements</a>
            </li>           
        </ul>

        <div class="tab-content mt-3" id="myTabsContent">
            <div class="tab-pane fade show active" id="citizen" role="tabpanel" aria-labelledby="citizen-tab">
                <div class="row">
                    <div class="col-8 text-start"><h3><?php echo $row1['title'];?></h3></div>
                    <div class="col-4 text-end">
                        <p>
                            <form action="" method="post">
                                <label for="stat">Status:</label>
                                <select name="stat">
                                    <?php
                                    $allowedStatus = ['Reported', 'In Progress', 'Resolved', 'Closed'];

                                    foreach ($allowedStatus as $status) {
                                        echo "<option value=\"$status\"";
                                        if ($row1['status'] == $status) {
                                            echo " selected";
                                        }
                                        echo ">$status</option>";
                                    }
                                    ?>
                                </select>
                                <input type="submit" value="Update" name="set_status" style="background:#FA3C04;color:white;">
                            </form>
                            <?php
                            if (isset($_POST['set_status'])) {
                                $update_id = $id;
                                $set_stat = $_POST['stat'];

                                $status_sql = "UPDATE `report` SET `status`='$set_stat' WHERE reportID = $id";
                                $conn->query($status_sql);
                                header("Refresh:0;url=police_home.php");
                                exit;
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 text-start"><p><?php echo "Crime: " . $row1['crime'];?></p></div>
                    <div class="col-4 text-end"><p><?php echo "Date: " . date('Y-m-d g:i A', strtotime($row1['date']));?></p></div>
                </div>
                <div class="row mb-3">
                    <p class="col text-start"><?php echo "Posted by: " . $row1['username']?></p>
                </div>
                <div class="row justify-content-center mb-4">
                    <img src="<?php echo $row1['pic_evidence'];?>" alt="Image" style="height: 450px; max-width: 900px;">
                </div>
                <div class="row justify-content-center mb-2">
                    <p><?php echo $row1['content']?></p>
                </div>
                <hr>
                <p><b>Citizen Comments:</b></p>
                <?php
                    $result2 = $conn->query("SELECT * FROM citizen_comments WHERE reportID = $id ORDER BY date DESC");
                    while ($row2 = $result2->fetch_assoc()) {
                        $commentUser = $row2['username'];

                        $commentUserResult = $conn->query("SELECT pic FROM citizens WHERE username = '$commentUser'");
                        $commentUserRow = $commentUserResult->fetch_assoc();
                ?>
                        <div class="row">
                            <div class="col-1">
                                <img src="<?php echo $commentUserRow['pic']; ?>" alt="User Profile Image" class="img-fluid rounded-circle" style="height: 50px; width: 50px;">
                            </div>
                            <div class="col-11">
                                <div class="row">
                                    <div class="col">
                                        <b><?php echo $row2['username'] ?></b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <?php echo $row2['comment'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-end">
                                        <i><?php echo "Commented at: " . date('Y-m-d g:i A', strtotime($row2['date']));?></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                    $result2->free_result();
                ?>
            </div>

            <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                <div class="row">
                    <div class="col-12 text-center"><h4>Location Details</h4></div>
                </div>
                <div id="map" style="height: 700px;"></div>
                <script>
                    var map = L.map('map').setView([<?php echo $row1['latitude']; ?>, <?php echo $row1['longitude']; ?>], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 18, 
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    var marker = L.marker([<?php echo $row1['latitude']; ?>, <?php echo $row1['longitude']; ?>])
                        .addTo(map)
                        .bindPopup("<b>Report's Location Info:</b><br>Full Address: <?php echo $row1['address']; ?><br>Latitude: <?php echo $row1['latitude']?><br>Longitude: <?php echo $row1['longitude']?>")
                        .openPopup(); 
                </script>
            </div>

            <div class="tab-pane fade" id="police" role="tabpanel" aria-labelledby="police-tab">
                <form action="#police" method="post">
                    <label class="form-label fw-bold" for="comment">Add a Statement</label><br>
                    <textarea class="form-control" name="comment" id="" style="height:60px"></textarea><br>
                    <input type="submit" value="Post a Statement" name="postState">
                </form>
                <br>
                <hr>
                <p>Statements</p>
                <?php
                    if (isset($_POST['postState'])) {
                        $reportID = $id;
                        $badge = $_SESSION['badgeID'];
                        $comment = $_POST['comment'];

                        $userProfileResult = $conn->query("SELECT * FROM police WHERE badgeID = '$badge'");
                        $userProfileRow = $userProfileResult->fetch_assoc();

                        $profile = $userProfileRow['pic'];
                        $rank = $userProfileRow['rank'];
                        $fname = $userProfileRow['fname'];
                        $lname = $userProfileRow['lname'];
                        $policeID = $userProfileRow['policeID'];

                        $sql = "INSERT INTO police_comments (reportID, pic, rank, fname, lname, policeID, comment, date) VALUES ('$reportID', '$profile', '$rank', '$fname', '$lname', '$policeID', '$comment', NOW())";
                        $conn->query($sql);
                    }

                    $result2 = $conn->query("SELECT * FROM police_comments WHERE reportID = $id ORDER BY date DESC");
                    while ($row2 = $result2->fetch_assoc()) {
                        $user_rank = $row2['rank'];
                        $user_fname = $row2['fname'];
                        $user_lname = $row2['lname'];
                        $userID = $row2['policeID'];

                        $commentUserResult = $conn->query("SELECT pic FROM police WHERE policeID = '$userID'");
                        $commentUserRow = $commentUserResult->fetch_assoc();
                        ?>
                        <div class="row">
                            <div class="col-1">
                                <img src="<?php echo $commentUserRow['pic']; ?>" alt="User Profile Image" class="img-fluid rounded-circle" style="height: 50px; width: 50px;">   
                            </div>
                            <div class="col-11">
                                <div class="row">
                                    <div class="col">
                                        <b><?php echo $user_rank . " " . $user_fname . " " . $user_lname ?></b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <?php echo $row2['comment'] ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-end">
                                        <i><?php echo "Stated at: " . date('Y-m-d g:i A', strtotime($row2['date'])); ?></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    $result2->free_result();
                    $conn->close();
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
<?php
    ob_end_flush();
    } else {
        echo '<script type="text/javascript">window.location.href = "invalid.php";</script>';
        exit;
    }
?>