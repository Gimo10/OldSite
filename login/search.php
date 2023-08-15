<?php
session_start();

include ("db_conn.php");

if(isset($_POST['searchname'])){
    $searchName = $_POST ['searchname'];

    $sql = "SELECT * FROM users WHERE fullname LIKE '%$searchName%'";
    $result = mysqli_query($conn,$sql);
}else{
    $sql = "SELECT * FROM `users`";
    $result = mysqli_query($conn,$sql);
}

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

    
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
                                        href="delete.php?deleteid=' . $row['id'] . '" class="text-decoration-none
                                        text-light">Delete</a></button> </td>
                                        
                                    
                                    </tr>
                                    ';

                        }
                    }else{
                        echo '<tr><td colspan="6">No records found.</td></tr>';
                    }

                    ?>

                </tbody>
            </table>

            <a href="logout.php"><button type="button" class="btn btn-primary">Logout</button></a>
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