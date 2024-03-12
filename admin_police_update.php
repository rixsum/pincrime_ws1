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
            $fname = $_POST['newFName'];
            $mname = $_POST['newMName'];
            $lname = $_POST['newLName']; 
            $stradd = $_POST['newStreet'];
            $baradd = $_POST['newBarangay'];
            $age = $_POST['newAge'];
            $gender = $_POST['newGender'];
            $stat = $_POST['newCivil'];
            $phone = $_POST['newPhone'];
            $division = $_POST['newDivision'];
            $rank = $_POST['newRank'];
            $email = $_POST['newEmail'];
            $badge = $_POST['newBadge'];
            $pass = $_POST['newPass'];

            $file_name = $_FILES['profile']['name'];
            $type = $_FILES['profile']['type'];
            $size = $_FILES['profile']['size'];
            $temp = $_FILES['profile']['tmp_name'];

            $allowedFileTypes = array('jpg', 'jpeg', 'png');
            $uploadedFileType = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_location = "images/profile_pics/police/" . $file_name;


            if ($file_location == "images/profile_pics/police/") {
                $sql = "UPDATE police SET fname = '$fname', mname = '$mname', lname = '$lname',  street_add = '$stradd', barangay_add = '$baradd', age = '$age', gender = '$gender', civilstat = '$stat', phone = '$phone', division = '$division', rank = '$rank', email = '$email', badgeID = '$badge', password = '$pass' WHERE policeID = $id";
                if ($conn->query($sql) === TRUE) {
                    $commentUpdateSql = "UPDATE police_comments SET rank = '$rank', fname = '$fname', lname = '$lname' WHERE policeID = '$id'";
                    $conn->query($commentUpdateSql);
                    header("Location: admin_mng_police.php");
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
                $sql = "UPDATE police SET pic = '$file_location', fname = '$fname', mname = '$mname', lname = '$lname',  street_add = '$stradd', barangay_add = '$baradd', age = '$age', gender = '$gender', civilstat = '$stat', phone = '$phone', division = '$division', rank = '$rank', email = '$email', badgeID = '$badge', password = '$pass' WHERE policeID = $id";
                if ($conn->query($sql) === TRUE) {
                    move_uploaded_file($_FILES["profile"]["tmp_name"], $file_location);
                    $commentUpdateSql = "UPDATE police_comments SET pic = '$file_location', rank = '$rank', fname = '$fname', lname = '$lname' WHERE policeID = '$id'";
                    $conn->query($commentUpdateSql);
                    header("Location: admin_mng_police.php");
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

        if (isset($_GET['policeID'])) {
            $id = $_GET['policeID'];

            $result = $conn->query("SELECT * from police WHERE policeID = $id");
            $row = $result->fetch_assoc();

            $conn->close();
        }

    ?>
    <div class="container-md mt-1 p-2">
        <div class="text-center py-2"><h2>Police ID No. <?php echo $id; ?></h2></div>
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
                    <label class="col-6 col-form-label fw-bold" for="newDivision">Division/Unit: </label>
                    <label class="col-6 col-form-label fw-bold" for="newRank">Rank: </label>
                </div>
                <div class="row justify-content-center mb-4">
                    <div class="col-6">
                        <select class="form-select" name="newDivision">
                            <option value="" hidden></option>
                            <option value="Intelligence Group (IG)" <?php echo ($row['division'] == 'Intelligence Group (IG)') ? 'selected' : ''; ?>>Intelligence Group (IG)</option>
                            <option value="Police Security and Protection Group (PSPG)" <?php echo ($row['division'] == 'Police Security and Protection Group (PSPG)') ? 'selected' : ''; ?>>Police Security and Protection Group (PSPG)</option>
                            <option value="Criminal Investigation and Detective Group (CIDG)" <?php echo ($row['division'] == 'Criminal Investigation and Detective Group (CIDG)') ? 'selected' : ''; ?>>Criminal Investigation and Detective Group (CIDG)</option>
                            <option value="Highway Patrol Group (HPG)" <?php echo ($row['division'] == 'Highway Patrol Group (HPG)') ? 'selected' : ''; ?>>Highway Patrol Group (HPG)</option>
                            <option value="Police Community Relations Group (PCRG)" <?php echo ($row['division'] == 'Police Community Relations Group (PCRG)') ? 'selected' : ''; ?>>Police Community Relations Group (PCRG)</option>
                            <option value="Civil Security Group (CSG)" <?php echo ($row['division'] == 'Civil Security Group (CSG)') ? 'selected' : ''; ?>>Civil Security Group (CSG)</option>
                            <option value="Crime Laboratory (CL)" <?php echo ($row['division'] == 'Crime Laboratory (CL)') ? 'selected' : ''; ?>>Crime Laboratory (CL)</option>
                            <option value="PNP Anti-Kidnapping Group (PNP-AKG)" <?php echo ($row['division'] == 'PNP Anti-Kidnapping Group (PNP-AKG)') ? 'selected' : ''; ?>>PNP Anti-Kidnapping Group (PNP-AKG)</option>
                            <option value="PNP Anti-Cybercrime Group (PNP-ACG)" <?php echo ($row['division'] == 'PNP Anti-Cybercrime Group (PNP-ACG)') ? 'selected' : ''; ?>>PNP Anti-Cybercrime Group (PNP-ACG)</option>
                        </select> 
                    </div>
                    <div class="col-6">
                        <select class="form-select" name="newRank" id="newRank">
                            <option value="" hidden></option>
                            <optgroup label="Commissioned Officers">
                                <option value="Police General (PGEN)" <?php echo ($row['rank'] == 'Police General (PGEN)') ? 'selected' : ''; ?>>Police General (PGEN)</option>
                                <option value="Police Lieutenant General (PLTGEN)" <?php echo ($row['rank'] == 'Police Lieutenant General (PLTGEN)') ? 'selected' : ''; ?>>Police Lieutenant General (PLTGEN)</option>
                                <option value="Police Major General (PMGEN)" <?php echo ($row['rank'] == 'Police Major General (PMGEN)') ? 'selected' : ''; ?>>Police Major General (PMGEN)</option>
                                <option value="Police Brigadier General (PBGEN)" <?php echo ($row['rank'] == 'Police Brigadier General (PBGEN)') ? 'selected' : ''; ?>>Police Brigadier General (PBGEN)</option>
                                <option value="Police Colonel (PCOL)" <?php echo ($row['rank'] == 'Police Colonel (PCOL)') ? 'selected' : ''; ?>>Police Colonel (PCOL)</option>
                                <option value="Police Lieutenant Colonel (PLTCOL)" <?php echo ($row['rank'] == 'Police Lieutenant Colonel (PLTCOL)') ? 'selected' : ''; ?>>Police Lieutenant Colonel (PLTCOL)</option>
                                <option value="Police Major (PMAJ)" <?php echo ($row['rank'] == 'Police Major (PMAJ)') ? 'selected' : ''; ?>>Police Major (PMAJ)</option>
                                <option value="Police Captain (PCPT)" <?php echo ($row['rank'] == 'Police Captain (PCPT)') ? 'selected' : ''; ?>>Police Captain (PCPT)</option>
                                <option value="Police Lieutenant (PLT)" <?php echo ($row['rank'] == 'Police Lieutenant (PLT)') ? 'selected' : ''; ?>>Police Lieutenant (PLT)</option>
                            </optgroup>
                            <optgroup label="Non-Commissioned Officers">
                                <option value="Police Executive Master Sergeant (PEMS)" <?php echo ($row['rank'] == 'Police Executive Master Sergeant (PEMS)') ? 'selected' : ''; ?>>Police Executive Master Sergeant (PEMS)</option>
                                <option value="Police Chief Master Sergeant (PCMS)" <?php echo ($row['rank'] == 'Police Chief Master Sergeant (PCMS)') ? 'selected' : ''; ?>>Police Chief Master Sergeant (PCMS)</option>
                                <option value="Police Senior Master Sergeant (PSMS)" <?php echo ($row['rank'] == 'Police Senior Master Sergeant (PSMS)') ? 'selected' : ''; ?>>Police Senior Master Sergeant (PSMS)</option>
                                <option value="Police Master Sergeant (PMSg)" <?php echo ($row['rank'] == 'Police Master Sergeant (PMSg)') ? 'selected' : ''; ?>>Police Master Sergeant (PMSg)</option>
                                <option value="Police Staff Sergeant (PSSg)" <?php echo ($row['rank'] == 'Police Staff Sergeant (PSSg)') ? 'selected' : ''; ?>>Police Staff Sergeant (PSSg)</option>
                                <option value="Police Corporal (PCpl)" <?php echo ($row['rank'] == 'Police Corporal (PCpl)') ? 'selected' : ''; ?>>Police Corporal (PCpl)</option>
                                <option value="Patrolman or Patrolwoman (Patmn/Patwmn)" <?php echo ($row['rank'] == 'Patrolman or Patrolwoman (Patmn/Patwmn)') ? 'selected' : ''; ?>>Patrolman or Patrolwoman (Patmn/Patwmn)</option>           
                            </optgroup>
                        </select> 
                    </div>
                </div>
                <div class="row justify-content-center">
                    <label class="col-6 col-form-label fw-bold" for="newBadge">Badge ID: </label>
                    <label class="col-6 col-form-label fw-bold" for="newPass">Password: </label>
                </div>
                <div class="row justify-content-center mb-4">
                    <div class="col-6"><input type="tel" class="form-control" name="newBadge" pattern="\d{6}" minlength="6" maxlength="6" value="<?php echo $row['badgeID']; ?>"></div>
                    <div class="col-6"><input class="form-control" type="text" name="newPass" value="<?php echo $row['password']; ?>"></div>
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
