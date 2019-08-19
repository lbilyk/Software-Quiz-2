<?php
require_once 'server/dbconfig.php';
$floorNumber = filter_input(INPUT_POST,'floorNumber');
global $mysqli;

if($floorNumber != null) {
    $query = "UPDATE carNode SET floorNumber = ? WHERE nodeID = 1";
    $statement = $mysqli->prepare($query);
    $statement->bind_param('i', $floorNumber);
    $statement->execute();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Software Quiz 2</title>
    <meta name="author" content="Lyubomyr Bilyk">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/index.css" rel="stylesheet">
</head>
<body id="page-top" class="bg-white">
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1 text-white">Members Only</a>
    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link d-inline active">Welcome, lbilyk</a>
        </li>
    </ul>
</nav>
<div class="container container-fluid pt-xl-5 text-center">
    <div class="row pt-5 justify-content-center">
        <div class="col-xl-4 col-xl-2 mb-4 text-center justify-content-center">
            <div class="card shadow justify-content-center">
                <div class="card-body text-center">
                    <div class="container container-fluid pt-xl-5 text-center">
                        Go To Floor:
                            <div class="form-group text-center d-inline-block justify-content-center">
                                <form action="member.php" method="POST" class="text-center justify-content-center">
                                    <div class="form-group my-2">
                                        <input type="text" id="floorNumber" name="floorNumber" class="form-control d-inline-block"
                                               required="required" autofocus="autofocus">
                                    </div>
                                    <input type="submit" value="Go!" class="btn btn-primary btn-block text-center">
                                </form>
                            </div>
                        </div>
                </div>
            </div>    
            <div class="card shadow justify-content-center mt-4">
                <div class="card-body text-left">
                    <div class="container container-fluid pt-xl-5 text-left">
                        <a href="#" class="list-group-item list-group-item-action text-left queueItem"><div class="row d-flex w-100 small font-weight-bold mr-5"><div class="col-sm-3 d-inline-block">nodeID</div><div class="col-sm-3">info</div><div class="col-sm-3">status</div><div class="col-sm-3">floorNumber</div></div></a>
                        <?php
                        $query = "SELECT elevatorNodes.nodeID, elevatorNodes.info, elevatorNodes.status, carNode.floorNumber FROM elevatorNodes LEFT JOIN carNode ON elevatorNodes.nodeID = carNode.nodeID";
                        $databaseEntries = array();
                        $statement = $mysqli->prepare($query);
                        $statement->execute();
                        $result = $statement->get_result();
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<a href="#" class="list-group-item list-group-item-action text-left queueItem"><div class="row d-flex w-100 small"><div class="col-sm-3 d-inline-block">' . $row['nodeID']. '</div><div class="col-sm-3">' . $row['info']. '</div><div class="col-sm-3">' . $row['status']. '</div><div class="col-sm-3">' . $row['floorNumber']. '</div></div></a>';
                        }
                        ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/jquery/jquery.min.js"></script>
</body>
</html>
