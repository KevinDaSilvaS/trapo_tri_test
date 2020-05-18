<?php 
session_start();
isset($_SESSION['iduser']) ? 
$idUser = $_SESSION['iduser'] 
: header('Location: ../logout.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
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
                <li><a href="EditarPerfil.php">Editar Perfil</a></li>
                <li><a href="Lista.php">To-Do</a></li>
                <li><a href="ListaListas.php">To-Do Listas</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <div id="register" class=" col s12 m6 l6">
            <div class="card white">
                <div id="slide-register hide"></div>
                
                <div id="form-register" class="card-content ">
                    <div class="card-title">Create List</div>

                    <form class="row" id="reg" action="listManager.php" method="POST">
                        
                        <div>
                            <input type="text" name="name" id="name" required>
                            <label for="name">Name</label>
                        </div>
                        <div>
                            <textarea name="desc" id="desc" cols="30" rows="10"></textarea>
                            <label for="desc">Desc</label>
                        </div>

                        <div id="wrapper" class="card card-content row green lighten-4">
                           
                            
                        </div>
                       
                        <div>
                            <button value="id" class="btn">Salvar</button>
                            <a onclick="AddHtml();" class="btn">Add Task</a>
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

    <script>
        function AddHtml(){
            const elem = ` <div>
                                <div class=" col s6 m6 l6">
                                    <input type="text" name="task">
                                    <label for="name">Task</label>
                                </div>
                                <div class=" col s6 m6 l6">
                                    <input type="date" name="due" required>
                                    <label for="due">Due</label>
                                </div>
                            </div>`;
            document.getElementById("wrapper").insertAdjacentHTML('beforeend', elem);
        }
    </script>
</body>
</html>