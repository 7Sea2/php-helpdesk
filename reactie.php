<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="helpdesk-dashboard/style.css">
    <script src="https://kit.fontawesome.com/fbea3c1d87.js" crossorigin="anonymous"></script>
    <?php
    include 'config.php';
    ?>
</head>

<body>



    <div class="wrapper">
        <div class="sidebar">
            <h2>Morb-OS</h2>
            <h4> User: <?php
                        echo $current_user['naam'];
                        ?></h4>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i>Thuispagina</a></li>
                <li><a href="melding_visualize.php"><i class="fas fa-layer-group"></i>Zie Meldingen</a></li>
                <li><a href="melding_create.php"><i class="fas fa-plus"></i>Maak Melding</a></li>
            </ul>
            <li><a href="logoutConfirm.php" class="logout"><i class="fas fa-minus"></i>Log Out</a></li>

        </div>
        <div class="main_content">
            <div class="header">Welcome!</div>
            <div class="info">
                <div>
                    <?php
                    $mid = $_GET["meldingid"];
                    $sql1 = "SELECT meldingID, statusID, beschr_kort, beschr_lang, userID, prioID, statusID, itemID, reactieID, datum FROM  meldingen  WHERE meldingID = $mid";
                    $sql2 = "SELECT statusID, status FROM status";
                    $result2 = $conn->query($sql2);
                    $result = $conn->query($sql1);

                    while ($row = $result->fetch_assoc()) {
                        $mid = $row["meldingID"];
                        echo "<tr>";
                        echo "<td>" . $row["beschr_kort"] . "<br>  </td>";
                        echo "<td>" . $row["beschr_lang"] . "<br>  </td>";
                        echo "<td>" . $row["prioID"] . "<br>  </td>";
                        echo "<td>" . $row["userID"] . "<br>  </td>";
                        echo "<td>" . $row["meldingID"] . "<br> </td>";
                        echo "<td>" . $row["statusID"] . "<br> </td>";
                        echo "<td>" . $row["datum"] . "<br> </td>";
                        echo "</tr>";
                    }
                    echo 'Hello ' . htmlspecialchars($_GET["meldingid"]);
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>