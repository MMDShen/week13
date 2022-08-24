<?php
/* READ USERS DATA FROM DATA BASE */
// $users = json_decode(file_get_contents('../dataBase/dataBase.json'), true) ?? [];

    // DATABASE COMMON REQUIRES
    $server = "localhost";
    $database = "chatroom";
    $usr = "root";
    $pass = "";
    $dsn = "mysql:host=$server;dbname=$database";
    $pdo = new PDO($dsn, $usr, $pass);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // DATABASE COMMON REQUIRES
    $users = $pdo->query("SELECT * FROM users ");
$error = "";
if (isset($_POST['register'])) {
    if (!usernameIsExist($_POST['username'], $users)) {
        if (!emailIsExist($_POST['email'], $users)) {
            addUser($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password']);
        } else $error = "The email is already available please enter another";
    } else {

        $error = "The User name you selected is already exist Please enter another";
    }

    echo $error;
}

function usernameIsExist($username, $users): bool
{


    // WITH-IN FUNCTION INJECTION CODE 

    while ($row = $users->fetch())
        if ($row["username"] == $username){
            echo $row["username"];
            return true;}
    return false;
    // WITH-IN FUNCTION INJECTION CODE 
}

function emailIsExist($email, $users): bool
{
     // WITH-IN FUNCTION INJECTION CODE 

     while ($row = $users->fetch())
     if ($row["email"] === $email){
         return true;}
    return false;
 // WITH-IN FUNCTION INJECTION CODE 
}

function addUser($name, $username, $email, $password)
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
        $sql = $pdo->query("INSERT INTO users (name,username,password,email) VALUES ('$name','$username','$password','$email') ");
        // $statement ->prepare($sql);
        // $statement->execute();

    // $users [] = new User($name, $username, $password, $email);
    // file_put_contents('../dataBase/dataBase.json', json_encode($users));
}

// class User
// {
//     public $name, $username, $password, $email, $blocked;

//     public function __construct($name, $username, $password, $email)
//     {
//         $this->name = $name;
//         $this->username = $username;
//         $this->password = $password;
//         $this->email = $email;
//         $this->blocked = false;
//     }

// }

?>
<html lang="en">
<head>
    <link rel="stylesheet" href="../bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css">
    <script src="../bootstrap-5.2.0-beta1-dist/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php if (empty($error)) { ?>
    <div class="container mt-4">
        <div class="px-4 py-4 alert alert-success text-center" role="alert">
            <p class="lead">you are successfully registered !</p>
        </div>
        <div class="text-center">
            <a class="nav-link" href="../login/login.php">
                Go To Login Page
            </a>
        </div>
    </div>
<?php } else { ?>
    <div class="container mt-4">
        <div class="px-4 py-4 alert alert-danger text-center" role="alert">
            <p class="lead"> <?php echo $error ?>!</p>
        </div>
        <div class="text-center">
            <a class="nav-link" href="../login/login.php">
                Go To Login Page
            </a>
        </div>
    </div>
<?php } ?>

</body>
</html>
