<?php 
session_start();
isset($_SESSION['iduser']) ? 
$idUser = $_SESSION['iduser'] 
: header('Location: logout.php');

isset($_POST['idlist']) ? 
$idList = $_POST['idlist'] 
: $idList = 0 ;
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

        $name = "";
        $desc = "";
        if ($idList > 0) {
            $getListData = $handler->selectWhere("name, description","list","id = '$idList'");
            if (is_array($getListData)) {
                $name = $getListData[0]['name'];
                $desc = $getListData[0]['description'];
            }
        }
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
                    <div class="card-title">Create List</div>

                    <form class="row" id="reg" action="listManager.php" method="POST">
                        
                        <div>
                            <input type="text" value="<?php echo $name;?>" name="name" id="name" required>
                            <label for="name" >Name</label>
                        </div>
                        <div>
                            <textarea name="desc" id="desc" cols="30" rows="10"><?php echo $desc;?></textarea>
                            <label for="desc">Desc</label>
                        </div>

                        <div id="wrapper" class="card card-content row green lighten-4">
                           
                            
                        </div>

                        <div id="wrapper" class="card card-content row blue lighten-4">
                           <?php
                            if ($idList > 0) {
                                $searchTasks = $handler->selectWhere("id,description,due,completed","tasks","list = '$idList'");
                                if (is_array($searchTasks)) {
                                    foreach ($searchTasks as $key => $value) {
                                        ?>
                                        <div>
                                            <div class=" col s1 m1 l1 tooltipped" style="padding-top: 18px;" data-position="bottom" data-tooltip="Select to remove or mark as done.">
                                                <p>
                                                    <label>
                                                        <input class="marked" type="checkbox" value="<?php echo $value['id']; ?>" />
                                                        <span></span>
                                                    </label>
                                                </p>
                                            </div>
                                            <div class=" col s6 m6 l6">
                                                <input type="text" value="<?php echo $value['description'];?>" name="createdtask[]" required>
                                                <label for="nametask">Task</label>
                                            </div>
                                            <div class=" col s3 m3 l3">
                                                <input type="date" value="<?php echo $value['due'];?>" name="createddue[]" required>
                                                <label for="due">Due</label>
                                            </div>
                                            <div class=" col s2 m2 l2">
                                                <input type="text" value="<?php echo $value['completed'];?>" readonly>
                                                <label for="">Date Of Conclusion</label>
                                            </div>
                                            
                                            <input type="text" readonly style="display: none;" value="<?php echo $value['id'];?>" name="taskid[]" >
                                        </div>
                                        <?php
                                    }
                                }
                            }
                           ?>
                            
                        </div>
                       
                        <div>
                            <button value="<?php echo $idList;?>" name="idlist" class="btn">Save</button>
                            <a onclick="AddHtml();" class="btn">Add Task</a>
                            <a onclick="getMarkedChecks(1);" class="btn red">Remove</a>
                            <a onclick="getMarkedChecks(2);" class="btn blue">Done</a>
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
                                    <input type="text" name="task[]" required>
                                    <label for="nametask">Task</label>
                                </div>
                                <div class=" col s6 m6 l6">
                                    <input type="date" name="due[]" required>
                                    <label for="due">Due</label>
                                </div>
                            </div>`;
            document.getElementById("wrapper").insertAdjacentHTML('beforeend', elem);
        }
    </script>

    <script>
        function getMarkedChecks(goTo){

            const checkedBoxesValues = [];
            const allCheckboxes = document.querySelectorAll('input[type=checkbox]:checked');

            for (let i = 0; i < allCheckboxes.length; i++) {
                checkedBoxesValues.push(allCheckboxes[i].value);
            }

            if (goTo == 1) {
                window.location.href = "removeTasks.php?listId=<?php echo $idList;?>&taskIds=" + checkedBoxesValues;
                return; 
            }

            window.location.href = "markAsDone.php?listId=<?php echo $idList;?>&taskIds=" + checkedBoxesValues;
            return; 
        }
    </script>
</body>
</html>