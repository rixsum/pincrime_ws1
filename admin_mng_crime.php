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

        #citizensTable {
            font-size: 12px;
            width: 100%;
        }

        #citizensTable th,
        #citizensTable td {
            padding: 5px;
        }
    </style>

</head>
<body>
    <?php
    require "admin_header.php";
    ?>
    <div class="container-md mt-5 p-5">
        <table id="crimesTable" class="display">
            <thead>
                <tr>
                    <th>Crime ID</th>
                    <th>Crime</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require "conn.php";
                    $query = "SELECT * FROM type_crimes";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['crime_id'] ?></td>
                        <td><?php echo $row['crime'] ?></td>
                        <td style="text-align: justify;"><?php echo $row['description'] ?></td>
                        <td class="text-center">
                            <a href="admin_crime_update.php?crime_id=<?php echo $row['crime_id']?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a><br>
                            <a href="admin_delete.php?crime_id=<?php echo $row['crime_id']?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
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
            $('#crimesTable').DataTable();
        });
    </script>
</body>
</html>

<?php
} else {
    header("Location:invalid.php");
}
?>
