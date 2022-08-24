<?php
session_start();





$users = json_decode(file_get_contents('../dataBase/dataBase.json'), true) ?? [];
$loginSuccessfully = true;


if (isset($_POST['login'])) {
    if (loginSuccessfully($_POST['username'], $_POST['password'], $users)) {
        header('Location: ../chat/chat.php');
    } else $loginSuccessfully = false;
}

// WHERE DATABASE GOES
function loginSuccessfully($username, $password, $users): bool
{
    // DATABASE COMMON REQUIRES
    $server = "localhost";
    $database = "chatroom";
    $user = "root";
    $pass = "";
    $dsn = "mysql:host=$server;dbname=$database";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // DATABASE COMMON REQUIRES

    // WITH-IN FUNCTION INJECTION CODE 
    $stmt = $pdo->query("SELECT * FROM users ");
    while ($row = $stmt->fetch())
        if ($row["username"] == $username and $row["password"] == $password){
            $_SESSION['user'] = ["name"=>$row["name"],"username"=>$row["username"],"blocked"=>$row["blocked"]];
            return true;}
    return false;
    // WITH-IN FUNCTION INJECTION CODE 

}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <script src="../bootstrap-5.2.0-beta1-dist/js/bootstrap.min.js"></script>
    <script src="../jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>

</head>

<body>

    <div class="container mt-4 mb-5">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-6">
                <div class="card px-5 py-5">

                    <span class="circle"><i class="fa fa-check"></i></span>

                    <h5 class="mt-3">Welcome to <span class="text-primary">BEST </span>messenger <span class="text-warning">Login Page</span>
                        <br>you can connect with
                        every body
                    </h5>

                    <ul id="properties" class="my-5">
                        <li><small>Instant messaging.</small></li>
                        <li><small>Photo sharing.</small></li>
                        <li><small>Group chats – users can chat with their Facebook friends and phone book contacts</small>
                        </li>
                    </ul>

                    <form action="#" method="post">

                        <!--                USER NAME-->
                        <div class="form-input">
                            <input id="username" type="text" name="username" class="text-light form-control" placeholder="User name">
                        </div>

                        <!--                PASSWORD-->
                        <div class="form-input">
                            <input id="password" type="password" name="password" class="text-light form-control" placeholder="password">
                        </div>

                        <div class="d-flex justify-content-center w-100">
                            <input name="login" id="login" type="submit" value="Login" class="w-50 fw-bolder btn btn-primary mt-4 signup">
                        </div>

                    </form>
                    <?php if (!$loginSuccessfully) { ?>
                        <script>
                            $('#username').addClass('is-invalid');
                            $('#password').addClass(('is-invalid'));
                            $('#properties').after("<p class='alert-danger py-1 alert w-75 text-center mx-auto'>The Username or Password is invalid</p>")
                            setTimeout(() => {
                                $('p').fadeOut();
                            }, 3500);
                        </script>
                    <?php } ?>

                    <div class="text-center mt-4">
                        <span class="d-block">Back to register menu</span>
                        <a href="../register/register.html" class="text-decoration-none">Register</a>
                    </div>

                </div>
            </div>
        </div>


    </div>
    <script>
        $('#username').focus(function() {
            $(this).removeClass('is-invalid');
        })
        $('#password').focus(function() {
            $(this).removeClass('is-invalid');
        })
    </script>


</body>

</html>