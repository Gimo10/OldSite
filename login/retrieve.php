<?php
session_start();
include("db_conn.php");

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

    if (isset($_GET['deleteid'])) {
        $deleteId = $_GET['deleteid'];

        // Retrieve the record from the 'student' table
        $retrieveSql = "SELECT * FROM `users` WHERE id = '$deleteId'";
        $retrieveResult = mysqli_query($conn, $retrieveSql);
        $record = mysqli_fetch_assoc($retrieveResult);

        if ($record) {
            // Insert the record into the 'deleted_records' table
            $insertSql = "INSERT INTO `deleted_records` (id, fullname, user_name, password, email,contact) VALUES ";
            $insertSql .= "('" . $record['id'] . "', '" . $record['fullname'] . "', '" . $record['user_name'] . "', '" . $record['password'] . "', '" . $record['email'] . "', '" . $record['contact'] . "')";
            $insertResult = mysqli_query($conn, $insertSql);

            if ($insertResult) {
                // Delete the record from the 'student' table
                $deleteSql = "DELETE FROM `users` WHERE id = '$deleteId'";
                $deleteResult = mysqli_query($conn, $deleteSql);

                if ($deleteResult) {
                    echo '<div class="alert alert-success" role="alert">Record deleted successfully.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Failed to delete the record.</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">Failed to insert the record.</div>';
            }
        } else {
            echo '';
        }
    }
    
    if (isset($_GET['deleteid'])) {
        $deleteId = $_GET['deleteid'];
    
        // Delete the record from the 'deleted_records' table
        $deleteSql = "DELETE FROM `deleted_records` WHERE id = '$deleteId'";
        $deleteResult = mysqli_query($conn, $deleteSql);
    
        if ($deleteResult) {
            echo '<div class="alert alert-success" role="alert">Record deleted permanently.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Failed to delete the record.</div>';
        }
    }
    


    $sql = "SELECT * FROM `deleted_records`";
    $result = mysqli_query($conn, $sql);
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>HOME</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-
alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-
GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="Home.css">

    </head>

    <body>

        <img src="FINAL_SEAL.png" alt="">

        <div class="videocontainer">
            <video autoplay loop muted id="video-background">
                <source src="video/ink_-_58193 (1080p).mp4" type="video/mp4">
            </video>
        </div>

        <div class="container">

            <h1>Retrieve User</h1>
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Password</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Operations</th>
                    </tr>
                </thead>


                <tbody>

                    <?php
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                    <tr>
                        <th scope="row">' . $row['id'] . '</th>
                        <td>' . $row['fullname'] . '</td>
                        <td>' . $row['user_name'] . '</td>
                        <td>' . $row['password'] . '</td>
                        <td>' . $row['email'] . '</td>
                        <td>' . $row['contact'] . '</td>
                        <td>
                            <a href="retrieve.php?restoreid=' . $row['id'] . '" class="text-decoration-none text-light"><button class="btn btn-primary">Restore</button></a>
                            <a href="retrieve.php?deleteid=' . $row['id'] . '" class="text-decoration-none text-light"><button class="btn btn-danger">Delete Permanently</button></a>
                        </td>
                    </tr>
                    ';
                        }
                    } else {
                        die(mysqli_error($conn));
                    }
                    ?>

                </tbody>
            </table>

            <a href="home.php"><button type="button" class="btn btn-primary">Back</button></a>
        </div>


    </body>
    

    </html>

    <?php

} else {
    header("Location: index.php");
    exit();
}
?>