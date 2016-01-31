<?php
    require_once("DTTCore.php");
    $action = $_GET["a"];
    //we dont have sesion yet
    $template = file_get_contents("DTTHeader.html");
    echo setTitle($template);
    
    if($action==null){
        $query = $pdo->prepare("INSERT INTO 'users'('name', 'password') VALUES ('samuel',bcrypt('DTTemployee'))");
        $query->execute();
        header("Location: DTTadmin.php?a=login");
        
    }else if($action=="login"){
    
        require_once("logIn.html");
        
    }else if($action=="check"){

        $user=$_POST["user"];
        $pass=$_POST["password"];

        $_SESSION["error"]=login($user, $pass);
        header("Location: DTTadmin.php?a=login");

   //Pagina de registro
    }else if($action=="admin"){
    
        if(!isset($_SESSION["id"])){

        }else{
	        echo file_get_contents("widgetAdmin.html");
        }
    }else{
        header("Location: DTTadmin.php?a=login");
    }
	echo "<a href='index.php'>building</a>";

