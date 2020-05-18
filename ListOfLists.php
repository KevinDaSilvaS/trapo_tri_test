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
    
    ?>
    <header class="z-depth-2">
        <nav class="norwegian-red">
        </nav>
    </header>

    <div id="main" class="row content">
        <div class=" col s1 m1 l1">
            <ul>
                <li><a href="UpdateProfile.php">Update Profile</a></li>
                <li><a href="List.php">To-Do</a></li>
                <li><a href="ListOfLists.php">To-Do Lists</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div id="register" class=" col s11 m11 l11">
            <div class="card white">
                <div id="slide-register hide"></div>
                
                <div id="form-register" class="card-content ">
                    <div class="card-title">Register</div>

                    <table>
                        <thead>
                            <tr>
                                <th>List</th>
                                <th>Desc</th>
                                <th>Date</th>
                                <th>Update</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getLists = $handler->selectWhere("id,name, description, created","list","user = '$idUser'");
                            if (is_array($getLists)) {
                                foreach ($getLists as $key => $value) {
                                    
                            ?>
                                <tr>
                                    <form action="List.php" method="post">
                                        <td><?php echo $value['name'];?></td>
                                        <td><?php echo $value['description'];?></td>
                                        <td><?php echo $value['created'];?></td>
                                        <td><button class="btn" name="idlist" value="<?php echo $value['id'];?>">Update</button></td>
                                        <td><a class="btn red" href="removeList.php?listId=<?php echo $value['id'];?>">Remove</a></td>
                                    </form>
                                </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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