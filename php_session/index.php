<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$database = "deneme";
$message = "";
try{
    $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST["login"])){
        if(empty($_POST["username"]) || empty($_POST["password"])){
            $message = '<label>All field is required</label>';
        }else{
            $query = "SELECT * FROM user WHERE username = :username AND password = :password";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    'username' => $_POST["username"],
                    'password' => $_POST["password"],
                    )
            );
            $count = $statement->rowCount();
            if($count > 0){
                $_SESSION["username"] = $_POST["username"];
                header("location:login_success.php");
            }else{
                $message = '<label>Username or Password is wrong</label>';
            }
        }
    }
}catch(PDOException $error){
        $message = $error->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    <div class="row">
        <div class="form-group col-2 col-sm-2 bg-light p-4">
            <form action="" method="POST">
                <h2 class="mb-4">LOGIN</h2>
                <div class="form-outline mb-4">
                    <input type="username" id="username" name="username" class="form-control" placeholder="Username"/>
                </div>
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password"/>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="login" value="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>