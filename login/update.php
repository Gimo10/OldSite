<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
} else {
    header("Location: index.php");
    exit();
}
?>

<?php
include('db_conn.php');
$id = $_GET['updateid'];
//echo var_dump($id);
$sql = "select * from `users` where id = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $fullname = $row['fullname'];
    $user_name = $row['user_name'];
    $password = $row['password'];
    $email = $row['email'];
    $contact = $row['contact'];
}
if (isset($_POST['submit'])) {
    // echo var_dump($_POST);
    $fullname = $_POST['fullname'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $sql = "update `users` set
    fullname='$fullname',user_name='$user_name',password='$password',email='$email',contact='$contact' where id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('location:home.php');
    } else {
        die(mysqli_error($conn));
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-
alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-
GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <div class="container">

        <div class="videocontainer">
            <video autoplay loop muted id="video-background">
                <source src="video/ink_-_58193 (1080p).mp4" type="video/mp4">
            </video>
        </div>


        <form method="post">

            <h1>Update</h1>

            <div class="mb-3">
                <label>Full Name</label>
                <input type="fullname" class="form-control" placeholder="Enter your Full name" name="fullname"
                    autocomplete="off" value="<?php echo $fullname ?>">
            </div>
            <div class="mb-3">
                <label>User Name</label>
                <input type="user_name" class="form-control" placeholder="Enter your User Name" name="user_name"
                    autocomplete="off" value="<?php echo $user_name ?>">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter your Password" name="password"
                    autocomplete="off" value="<?php echo $password ?>">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Enter your Email" name="email" autocomplete="off"
                    value="<?php echo $email ?>">
            </div>
            <div class="mb-3">
                <label>Contact</label>
                <input type="contact" class="form-control" placeholder="Enter your Contact" name="contact"
                    autocomplete="off" value="<?php echo $contact ?>">
            </div>

            <button type="submit" name="submit">Update</button>
            <a href="home.php">Back</a>

        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-

    </div>
    
alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-
w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>