<?php 
session_start();
isset($_SESSION['iduser']) ? 
$idUser = $_SESSION['iduser'] 
: header('Location: logout.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content=" ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Login</title>
</head>
<body class="norwegian-gradient">
    <?php
    require_once ('HandlerDataBase.php');

    $handler = new HandlerDataBase();
    
    $profileData = $handler->selectWhere("name, email, password","user","id = '$idUser'");
    if (is_array($profileData)) {
        $name = $profileData[0]['name'];
        $email = $profileData[0]['email'];
        $password = $profileData[0]['password'];
    }else{
        header('Location: logout.php');
        exit;
    }
    ?>
    <header class="z-depth-2">
        <nav class="norwegian-red">
        </nav>
    </header>

    <div id="main" class="row content">
        <div class=" col s12 m3 l3">
            <ul>
                <li><a href="UpdateProfile.php">Update Profile</a></li>
                <li><a href="List.php">To-Do</a></li>
                <li><a href="ListOfLists.php">To-Do Lists</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div id="register" class=" col s12 m6 l6">
            <div class="card white">
                <div id="slide-register hide"></div>
                
                <div id="form-register" class="card-content ">
                    <div class="card-title">Register</div>

                    <form class="row" id="reg" action="register.php" method="POST">
                        
                        <div>
                            <input type="text" value="<?php echo $name;?>" name="name" id="name" required>
                            <label for="name">Name</label>
                        </div>
                        <div>
                            <input type="email" value="<?php echo $email;?>" name="email" id="email" required>
                            <label for="email">Email</label>
                        </div>
                        <div>
                            <input type="password" name="password" id="password" required>
                            <label for="password">Password</label>
                        </div>
                        <div>
                            <button value="<?php echo $idUser;?>" name="id" class="btn">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class=" col s12 m3 l3"></div>

    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
          document.addEventListener('DOMContentLoaded', function() {
                var elems = document.querySelectorAll('.tooltipped');
                var instances = M.Tooltip.init(elems);
          });
    </script>
</body>
</html>