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
            echo '<div class="alert alert-info" role="alert">No record found.</div>';
        }
    }

    $sql = "SELECT * FROM `users`";
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

            <h1>Display</h1>

            <div class="container my-3">
                <button class="btn btn-primary"><a href="retrieve.php" class="text-decoration-none text-light">Retrieve
                        User</a></button>
            </div>

            <form class="topnav" method="POST" action="search.php">
                <div class="mb-3">
                    <input type="text" placeholder="Search..."  name="searchname">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>

            </form>

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
                    $sql = "SELECT * FROM `users`";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $fullname = $row['fullname'];
                            $user_name = $row['user_name'];
                            $password = $row['password'];
                            $email = $row['email'];
                            $contact = $row['contact'];
                            echo '
                                    <tr>
                                        <th scope="row">' . $id . '</th>
                                        <td>' . $fullname . '</td>
                                        <td>' . $user_name . '</td>
                                        <td>' . $password . '</td>
                                        <td>' . $email . '</td>
                                        <td>' . $contact . '</td>
                                        <td> <button class="btn btn-success"><a
                                        href="update.php?updateid=' . $row['id'] . '" class="text-decoration-none
                                        text-light">Update</a></button>
                                        <button class="btn btn-danger"><a
                                        href="delete1.php?deleteid=' . $row['id'] . '" class="text-decoration-none
                                        text-light">Delete</a></button> </td>
                                        
                                    </tr>
                                    ';

                        }
                    } else {
                        echo '<tr><td colspan="6">No records found.</td></tr>';
                    }

                    ?>

                </tbody>
            </table>

            <a href="logout.php"><button type="button" class="btn btn-primary">Logout</button></a>
        </div>


    </body>

    </html>

    <?php
} else {
    header("Location: index.php");
    exit();
}
?>