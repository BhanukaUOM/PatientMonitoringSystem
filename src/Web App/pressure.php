<!DOCTYPE html><html><head>  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.js"></script>   <meta http-equiv="refresh" content="4"></head><?php        $servername = "localhost";	$username = "bdhjdb_db";	$password = "0000000000";	$dbname = "bdhjdb_db";        // Create connection        $conn = mysqli_connect($servername, $username, $password, $dbname);        // Check connection        if (!$conn) {            die("Connection failed: " . mysqli_connect_error());        }    ?>	<div style="display:  block" id="BloodSys">    <a href="project.html"><span class="w3-button w3-large w3-display-topright" style="z-index: 4;"><span style="font-size: 60px; padding:0px 10px 20px 0px;">&times;</span></span></a><canvas id="BloodSysChart" width="100%" height="70%" class="w3-modal w3-animate-zoom" style="background-color: cornsilk;"></canvas>    </div><script>var ctx = document.getElementById("BloodSysChart").getContext('2d');var myChart = new Chart(ctx, {    type: 'line',    data: {        labels: ["", "-1m 35s", "-1m 30s", "-1m 25s", "-1m 20s","-1m 15s", "-1m 10s", "-1m 5s", "-1m", "-55s","-50s", "-45s", "-40s", "-35s", "-30s","-25s", "-20s", "-15s", "-10s", "-5s", "Now"],        datasets: [{            label: 'Blood Pressure Systolic  (mmHg)',            data: [, <?php             $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 19,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 18,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 17,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 16,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }						$sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 15,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }                $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 14,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 13,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 12,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 11,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 10,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 9,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 8,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 7,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 6,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }						$sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 5,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }                $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 4,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 3,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 2,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 1,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressSYS FROM `group_18` ORDER BY time DESC LIMIT 0,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressSYS"];            }        } else {            echo "0";        }            ?>],            backgroundColor: [                'rgba(255, 99, 132, 0.2)'            ],            borderColor: [                'rgba(255,99,132,1)'            ],            borderWidth: 10,            fill: false,            pointRadius: 8        }]    },    options: {		animation: false,		responsive: true,		title:{			display:true,			text:'Systolic Blood Pressure (mmHg)',			fontSize: 50		},		tooltips: {			mode: 'index',			intersect: false,		},		hover: {			mode: 'nearest',			intersect: true		},		scales: {			scaleLabel: { fontSize: 30 },			xAxes: [{				display: true,				ticks: {					fontSize: 40				},				scaleLabel: {					display: true,					labelString: 'Time',					fontSize: 30				}			}],			yAxes: [{				display: true,				ticks: {					fontSize: 40,					beginAtZero:true				},				scaleLabel: {					display: true,					labelString: 'mmHg',					fontSize: 30				}			}],		}	}});</script><div style="display:  block;" id="BloodDia">    <a href="project.html"><span class="w3-button w3-large w3-display-topright" style="z-index: 4;"><span style="font-size: 60px; padding:0px 10px 20px 0px;">&times;</span></span></a><canvas id="BloodDiaChart" width="100%" height="70%" class="w3-modal w3-animate-zoom" style="background-color: cornsilk;margin-top: 80%;"></canvas>    </div><script>var ctx = document.getElementById("BloodDiaChart").getContext('2d');var myChart = new Chart(ctx, {    type: 'line',    data: {        labels: ["", "-1m 35s", "-1m 30s", "-1m 25s", "-1m 20s","-1m 15s", "-1m 10s", "-1m 5s", "-1m", "-55s","-50s", "-45s", "-40s", "-35s", "-30s","-25s", "-20s", "-15s", "-10s", "-5s", "Now"],        datasets: [{            label: 'Diastolic Blood Pressure  (mmHg)',            data: [, <?php             $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 19,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 18,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 17,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 16,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }						$sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 15,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }                $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 14,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 13,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 12,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 11,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 10,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 9,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 8,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 7,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 6,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }						$sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 5,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }                $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 4,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 3,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {           echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 2,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 1,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"].",";            }        } else {            echo "0,";        }        $sql = "SELECT BloodPressDIA FROM `group_18` ORDER BY time DESC LIMIT 0,1";            $result = mysqli_query($conn, $sql);        if (mysqli_num_rows($result) > 0) {            // output data of each row            while($row = mysqli_fetch_assoc($result)) {                echo /*$row["time"] .*/$row["BloodPressDIA"];            }        } else {            echo "0";        }            ?>],            backgroundColor: [                'rgba(255, 99, 132, 0.2)'            ],            borderColor: [                'rgba(255,99,132,1)'            ],            borderWidth: 10,            fill: false,            pointRadius: 8        }]    },    options: {		animation: false,		responsive: true,		title:{			display:true,			text:'Diastolic Blood Pressure  (mmHg)',			fontSize: 50		},		tooltips: {			mode: 'index',			intersect: false,		},		hover: {			mode: 'nearest',			intersect: true		},		scales: {			scaleLabel: { fontSize: 30 },			xAxes: [{				display: true,				ticks: {					fontSize: 40				},				scaleLabel: {					display: true,					labelString: 'Time',					fontSize: 30				}			}],			yAxes: [{				display: true,				ticks: {					fontSize: 40,					beginAtZero:true				},				scaleLabel: {					display: true,					labelString: 'mmHg',					fontSize: 30				}			}],		}	}});</script></body></html>