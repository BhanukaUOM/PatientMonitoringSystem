<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>
   <meta http-equiv="refresh" content="4">
</head>
<body>
    <?php
        $servername = "localhost";
		$username = "bdhjdb_db";
		$password = "0000000000";
		$dbname = "bdhjdb_db";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    ?>
    
<header class="w3-container w3-light-grey">
  <h1 class="w3-center" style="font-size: 80px">Remote Patient Monitoring System</h1>
    <h2 class="w3-center"style="font-size: 70px">Group - 18 IT</h2>
</header>

<div class="w3-card-4 w3-margin">
    <div class="w3-container">
      <h2 style="font-size: 60px">Heart Rate</h2>        
      <img src="heart.png" width="30%" alt="Avatar" class="w3-left w3-circle">
      <div class="w3-panel w3-gray" style="width: 50%; height: 10%; float: right; margin-right: 10%">
          <h1 class="w3-opacity" style="font-size: 90px">
          <b>
              <?php 

            $sql = "SELECT HeartRate FROM `group_18` ORDER BY time DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo /*$row["time"] .*/$row["HeartRate"];
            }
        } else {
            echo "0";
        }
            ?>
              BPM</b></h1>
      </div>
    </div>

    <a href="heart.php" style="text-decoration: none;"><button class="w3-button w3-block w3-dark-grey" style="font-size: 60px">History</button>
	</a>
	
</div> 

<div class="w3-card-4 w3-margin">
    <div class="w3-container">
      <h2 style="font-size: 60px">Blood Pressure</h2>        
      <img src="pressure.png" width="30%" alt="Avatar" class="w3-left w3-circle">
      <div class="w3-panel w3-gray" style="width: 50%; height: 10%; float: right; margin-right: 10%">
          <h1 class="w3-opacity" style="font-size: 90px">
          <b>
              <?php 

            $sql = "SELECT BloodPressSYS, BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo /*$row["time"] .*/$row["BloodPressSYS"] ."/". $row["BloodPressDIA"];
            }
        } else {
            echo "0";
        }
            ?>
              mmHg</b></h1>
      </div>
    </div>

    <a href="pressure.php" style="text-decoration: none;"><button class="w3-button w3-block w3-dark-grey" style="font-size: 60px">History</button>
	</a>
	
</div> 

<div class="w3-card-4 w3-margin">
    <div class="w3-container">
      <h2 style="font-size: 60px">Body Temprature</h2>        
      <img src="temp.png" width="30%" alt="Avatar" class="w3-left w3-circle">
      <div class="w3-panel w3-gray" style="width: 50%; height: 10%; float: right; margin-right: 10%">
          <h1 class="w3-opacity" style="font-size: 90px">
          <b>
              <?php 

            $sql = "SELECT Temp FROM `group_18` ORDER BY time DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo /*$row["time"] .*/$row["Temp"];
            }
        } else {
            echo "0";
        }
            ?><sup>o</sup>F</b></h1>
      </div>
    </div>

    <a href="temp.php" style="text-decoration: none;"><button class="w3-button w3-block w3-dark-grey" style="font-size: 60px">History</button>
	</a>
	
</div>

<div class="w3-card-4 w3-margin">
    <div class="w3-container">
      <h2 style="font-size: 60px">Respiration Rate</h2>        
      <img src="resp.png" width="30%" alt="Avatar" class="w3-left w3-circle">
      <div class="w3-panel w3-gray" style="width: 50%; height: 10%; float: right; margin-right: 10%">
          <h1 class="w3-opacity" style="font-size: 90px">
          <b>
              <?php 

            $sql = "SELECT Respiration FROM `group_18` ORDER BY time DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo /*$row["time"] .*/$row["Respiration"]." ";
            }
        } else {
            echo "0 ";
        }
            ?> RPM</b></h1>
      </div>
    </div>

    <a href="resp.php" style="text-decoration: none;"><button class="w3-button w3-block w3-dark-grey" style="font-size: 60px">History</button>
	</a>
	
</div>

<div class="w3-card-4 w3-margin">
    <div class="w3-container">
      <h2 style="font-size: 60px">Saline Level</h2>        
      <img src="saline.png" width="30%" alt="Avatar" class="w3-left w3-circle">
      <div class="w3-panel w3-gray" style="width: 50%; height: 10%; float: right; margin-right: 10%">
          <h1 class="w3-opacity" style="font-size: 90px">
          <b>
              <?php 

            $sql = "SELECT Saline FROM `group_18` ORDER BY time DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo /*$row["time"] .*/$row["Saline"]." ";
            }
        } else {
            echo "0 ";
        }
            ?></b></h1>
      </div>
    </div>

    <a href="saline.php" style="text-decoration: none;"><button class="w3-button w3-block w3-dark-grey" style="font-size: 60px">History</button>
	</a>
	
</div>

</body>
</html>