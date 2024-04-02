<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['login_id'])) {
    $login_id = $_SESSION['login_id'];
    require_once "connect.php";

    // Use prepared statement to avoid SQL injection
    $sql = "SELECT driver_id FROM tbl_driver WHERE login_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $login_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $driver_id = $row['driver_id'];

        // Use prepared statement to avoid SQL injection
        $sql1 = "SELECT fname FROM tbl_driver WHERE driver_id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("i", $driver_id);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            $name = $row1['fname'];

        } else {
            // Handle the case when no records are found for reg_id
            echo "Error: No records found for reg_id.";
        }

        $stmt1->close();
    } else {
    
    }

    $stmt->close();

    $current_page = basename($_SERVER['PHP_SELF']);

    function isActive($page, $current_page) {
        return ($page == $current_page) ? 'active' : '';
    }


$conn->close();
?>
<style>
    .dropdown-menu a.dropdown-item:hover {
    background-color: #007bff; /* Change to the desired hover background color */
    color: #fff; /* Change to the desired hover text color */
}

</style>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
        <a class="navbar-brand" href="driver_page.php">Driver Login</a>
            <a class="navbar-brand" href="driver_page.php">ACE <span>Car Rentals</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
           
            <div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav ml-auto"> <!-- Change ml-auto to mr-auto for left alignment -->
    <li class="nav-item <?php echo isActive('driver_page.php', $current_page); ?>"><a href="driver_page.php" class="nav-link">Home</a></li>
                <li class="nav-item <?php echo isActive('driver_rental_details.php', $current_page); ?>"><a href="driver_rental_details.php" class="nav-link">Rental Details</a></li>


    </ul>
    <div class="dropdown" >
        <button class="btn bg-transparent dropdown-toggle navbar-brand" style="text-transform:none; font-weight:normal" onclick="showDropdown()" type="button" id="dropdownMenuButton" data-mdb-dropdown-init data-mdb-ripple-init aria-expanded="false" class="nav-item">
            <img src="whitebg_user.png" alt="Account Image" style="width: 20px; height: 20px;">
            <?php echo isset($name) ? $name : ''; ?>
        </button>
       
            <ul class="dropdown-menu dropdown-menu-end  border-0 rounded-0 rounded-bottom m-0" id="myDropdown" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="driveraccount.php">Account <img src="642902-200.png" alt="Account Image" style="width: 20px; height: 20px;"></a></li>
            <li><a class="dropdown-item" href="driver_documents.php">Documents <img src="Daco_755096.png" alt="Account Image" style="width: 20px; height: 20px;"></a></li>

            <li><a class="dropdown-item" href="logout.php">Logout <img src="126467.png" alt="Logout Image" style="width: 20px; height: 20px;"></a></li>
            </ul>
    </div>
</div>

        </div>
    </nav>
 
<?php

} else {
    $current_page = basename($_SERVER['PHP_SELF']);
    function isActive($page, $current_page) {
        return ($page == $current_page) ? 'active' : '';
    }
?>
 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
    <a class="navbar-brand" href="index.php">ACE <span>Car Rentals</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo isActive('driver_page.php', $current_page); ?>"><a href="driver_page.php" class="nav-link">Home</a></li>
                <li class="nav-item <?php echo isActive('driver_rental_details.php', $current_page); ?>"><a href="driver_rental_details.php" class="nav-link">Rental Details</a></li>
                
            </ul>
        </div>
    </div>
</nav>
<?php
}
?>

    <script>
    function showDropdown() {
        var dropdown = document.getElementById("myDropdown");
        dropdown.classList.add("show");

        // Automatically close the dropdown after 1000 milliseconds (1 second)
        setTimeout(function () {
            dropdown.classList.remove("show");
        }, 4000); 
    }
</script>
