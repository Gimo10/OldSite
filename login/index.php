<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>loginSystem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-
alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-
GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="videocontainer">
        <video autoplay loop muted id="video-background">
            <source src="video/ink_-_58193 (1080p).mp4" type="video/mp4">
        </video>
    </div>



    <form action="login.php" method="post">
        <img src="FINAL_SEAL.png" alt="">
        <?php if (isset($_GET['error'])) { ?>
            <p class="error">
                <?php echo $_GET['error']; ?>
            </p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit">Login</button>
        <a href="signup.php">Sign Up</a>

    </form>

    <h5>@Moan Wyeth Frejas.Gilyn Rovilla Login System</h5>

</body>


</html>