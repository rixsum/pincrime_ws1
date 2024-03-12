<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-white" style="box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="police_home.php">
                <img src="images/layout/logo_new.png" alt="PinCrime Logo" style="max-height: 50px; margin-right: 10px;">
                <b style="color: #FF2400;">Crime Reporting Management System</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="color: #FF2400; background-color: #FF2400; border: 1px solid #FF2400;"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="police_home.php" style="color: #FF2400; font-size: 20px;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="police_profile.php" style="color: #FF2400; font-size: 20px;">
                        <?php
                            require "conn.php";
                            $currentUser = $_SESSION['badgeID'];

                            $userResult = $conn->query("SELECT * from police WHERE badgeID = '$currentUser'");
                            while ($userRow = $userResult->fetch_assoc()) {
                        ?>
                        <img src="<?php echo $userRow['pic']?>" style="height: 31px; width: 31px; margin-right: 9px; border-radius: 50%; object-fit: cover; object-position: center;"><?php echo $userRow['badgeID']?>
                        <?php
                            }
                            $userResult->free_result();
                        ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" style="color: #FF2400; font-size: 20px;">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
