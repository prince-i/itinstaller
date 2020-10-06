<?php
    define('title','Admin Page');
    require '../function/create_file.php'; //calling saving of file function
    require '../function/session.php';  //called session and server
    //server.php where the logout located will called by session.php as required here in the file
    if(isset($_POST["submit"])){
        $id = 0;
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        md5($password);
        if(empty($name) || empty($username) || empty($password)){
            echo "<script>alert('PLEASE COMPLETE THE CREDENTIALS')</script>";
        }else{
            $check = "SELECT *from user where username = '$username'";
            $stmt = $conn->prepare($check);
            $stmt->execute();
            $res = $stmt->fetchALL();
            if($stmt->rowCount() > 0){
                echo "<script>alert('USERNAME ALREADY EXISTS')</script>";
            }else {
                $insert = "INSERT INTO user VALUES('$id','$username','$password','$name')";
                $stmt = $conn->prepare($insert);
                if($stmt->execute()){
                    echo "<script>alert('SUCCESSFULLY SAVED')</script>";
                    echo "<script>window.location.replace('dashboard.php')</script>";
                }
        }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo title;?></title>
    <link rel="icon" href="../assets/favicon.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="../node_modules/materialize-css/dist/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="../node_modules/material-design-icons/iconfont/material-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <body>
    <nav class="green nav-extended">
            <div class="nav-wrapper">
                <a>IT SYSTEMS INSTALLER - <?=$name;?></a>

                <ul class="right">
                    <li><li><div id="time"></div></li></li>
                <li><a data-target="modal_logout" class="modal-trigger tooltipped" data-tooltip="Logout" data-position="left"><i class="material-icons">power_settings_new</i></a></li>
                </ul>
            </div>
            <div class="nav-content">
                <ul class="tabs tabs-transparent">
                <li class="tab"><a href="#tab1" ondblclick="refresh_files()">Shortcut Files</a></li>
               
            </ul>
        </div>
    </nav>

    <!-- content -->

    <div class="row">
        <div class="col s12" id="tab1">
            <!-- table for data files -->
            <table>
                    <caption>
                        <div class="input-field">
                              <input type="text" id="Searchtext"><label for="Searchtext">Search</label>
                            </div>
                    </caption>
                    <thead>
                        <th>File Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="databody"></tbody>
                </table>

            <!-- btn -->
            <div class="fixed-action-btn">
                <a class="btn-floating blue right modal-trigger" data-target="modal_create"><i class="material-icons">add</i></a>
            </div>
        </div>
        <!-- tab2
        <div class="col s12" id="tab2">
            <div class="row">
            <table class="">
                    <caption>
                        <div class="input-field">
                              <input type="text" id="SearchUser"><label>Search</label>
                            </div>
                    </caption>
                    <thead>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="userData"></tbody>
                </table>    
                <div class="fixed-action-btn">
                    <a class="btn-floating modal-trigger green" data-target="modal_add_user"><i class="material-icons">people_outline</i></a>
                </div>
            </div>
        </div>

    </div> -->

      <!-- modals -->
            <!-- modal add user -->
            <div class="modal modal-fixed-footer" id="modal_add_user">
                <div class="modal-content">
                    <h4 class="center">ADD USER</h4>
                    <div class="divider"></div>
                    
                    <form action="" method="post">
                        <div class="input-field">
                            <input type="text" name="name"><label for="">Name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="username"><label for="">Username</label>
                        </div>

                        <div class="input-field">
                            <input type="text" name="password"><label for="">Password</label>
                        </div>

                        <div class="input-field">
                            <input class="btn green" type="submit" name="submit" value="Save">
                        </div>
                    </form>
                     </div>
            </div>
            <!-- modal create shortcut form -->
            <div class="modal" id="modal_create">
                <div class="modal-content">
                    
                    <h4 class="center">CREATE SHORTCUT</h4>
                    <form method="POST">
                        <!-- SHORTCUT NAME -->
                            <div class="input-field">
                            <input type="text" name="sys_name"><label id="for_title">Shortcut name</label>
                            </div>
                        <!-- SYSTEM DIRECTORY -->
                            <div class="input-field">
                                <input type="text" name="dir_name"><label id="for_dir">File/System's directory</label>
                            </div>
                        <!-- submit -->
                            <div class=" input-field">
                               <input class="btn green" type="submit" name="btn_create" value="create">
                            </div>
                            </form>
                    
                </div>
            </div>


            <!-- modal delete -->

            <div class="modal" id="modal_delete">
                <div class="modal-content">
                    <input type="hidden" id="filename_del">
                    <p class="flow-text center">ARE YOU SURE YOU WANT TO DELETE THIS FILE?</p>
                </div>
                    <div class="modal-footer">
                        <button class="btn red" onclick="remove()">yes</button>
                        <button class="btn-flat modal-close">no</button>
                    </div>
            </div>
            <!-- modal LOGOUT -->
            <div class="modal" id="modal_logout">
                <div class="modal-content">
                    <p class="text-flow center">ARE YOU SURE YOU WANT TO LOGOUT?</p>
                    <form method="post" class="center">
                        <input class="btn-small green" type="submit" name="logout_btn" value="Confirm Logout">
                        <button class="btn-flat modal-close">Cancel</button>
                    </form>
                </div>
            </div>

            <div class="modal" id="del_user_modal">
                <div class="modal-content">
                    <div class="row">
                        <input type="text" id="user_del_info"> 
                        <p class="center flow-text">ARE YOU SURE YOU WANT TO REMOVE THIS USER?</p> 
                    </div>
                </div>
                    <div class="modal-footer">
                        <button class="btn red" onclick="delete_user()"><i class="material-icons">check</i></button>
                        <button class="btn-flat modal-close"><i class="material-icons">close</i></button>
                    </div>
            </div>

    <script type="text/javascript" src="../node_modules/materialize-css/dist/js/jquery.min.js"></script>
  
	<script type="text/javascript" src="../node_modules/materialize-css/dist/js/materialize.min.js"></script>
    <script type="text/javascript">
        // materialize calling js function
        $(document).ready(function(){
            $('.modal').modal();
            $('.tooltipped').tooltip();
            $('.tabs').tabs();
        });

        function refresh_files(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                document.getElementById("databody").innerHTML = response;
                M.toast({html:'Refreshed'});
            }
            };
            xmlhttp.open("GET","../function/process.php?process=admin_load_view", true);
            xmlhttp.send();
        }

        load_files();
        function load_files(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                document.getElementById("databody").innerHTML = response;
            }
            };
            xmlhttp.open("GET","../function/process.php?process=admin_load_view", true);
            xmlhttp.send();
        }

        // function get filename to delete
        
        function get_file(param){
            var str = param;
            document.getElementById("filename_del").value = str;

        }
        // function remove file
        function remove(){
            var file = document.querySelector("#filename_del").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                $('.modal').modal('close','#modal_delete');
                load_files();
                M.toast({html:'Deleted file successfully.'});
                
            }
            };
            xmlhttp.open("GET","../function/process.php?process=delete_file&&file="+file, true);
            xmlhttp.send();
        }
        // LOAD USER
        load_users();
        function load_users(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                document.getElementById("userData").innerHTML = response;
            }
            };
            xmlhttp.open("GET","../function/process.php?process=admin_load_user", true);
            xmlhttp.send();
        }

        function get_user(id){
            document.querySelector("#user_del_info").value = id;
        }

        function delete_user(){
            var id = document.querySelector("#user_del_info").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                if(response === 'success'){
                    M.toast({html:'Deleted'});
                    load_users();
                }
            }
            };
            xmlhttp.open("GET","../function/process.php?process=admin_del_user&&id="+id, true);
            xmlhttp.send();
        }
        // search admin list
		$(document).ready(function(){
		$("#Searchtext").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#databody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
        });
        
        // search user filter
        $("#SearchUser").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#userData tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
		});
    </script>
</body>