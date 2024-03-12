<?php
session_start();

if (isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password'])) {
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
        .container-md {
            border-style: solid;
            border-width: 1px;
            border-radius: 10px;
            padding: 20px;
            width: 90%; 
            margin: auto; 
        }

        #policeTable {
            font-size: 12px;
            width: 100%;
        }

        #policeTable th,
        #policeTable td {
            padding: 5px;
        }

        #policeTable img {
            height: 80px;
            width: 80px;
        }
    </style>

</head>
<body>
    <?php
    require "admin_header.php";
    ?>
    <div class="container-md mt-5 p-5">
        <table id="policeTable" class="display">
            <thead>
                <tr>
                    <th>Police ID</th>
                    <th>Picture</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Street</th>
                    <th>Barangay</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Civil Status</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Division</th>
                    <th>Rank</th>
                    <th>Badge ID</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require "conn.php";
                    $query = "SELECT * FROM police";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['policeID'] ?></td>
                        <td><img src="<?php echo $row['pic']?>" style="height: 100px; width: 100px;"></td>
                        <td><?php echo $row['lname'] ?></td>
                        <td><?php echo $row['fname'] ?></td>
                        <td><?php echo $row['mname'] ?></td>
                        <td><?php echo $row['street_add'] ?></td>
                        <td><?php echo $row['barangay_add'] ?></td>
                        <td><?php echo $row['age'] ?></td>
                        <td><?php echo $row['gender'] ?></td>
                        <td><?php echo $row['civilstat'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['division'] ?></td>
                        <td><?php echo $row['rank'] ?></td>
                        <td><?php echo $row['badgeID'] ?></td>
                        <td><?php echo $row['password'] ?></td>
                        <td class="text-center">
                            <a href="admin_police_update.php?policeID=<?php echo $row['policeID']?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a><br>
                            <a href="admin_delete.php?policeID=<?php echo $row['policeID']?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php
                }
                $result->free_result();
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function () {
            $('#policeTable').DataTable();
        });
    </script>
</body>
</html>

<?php
} else {
    header("Location:invalid.php");
}
?>
