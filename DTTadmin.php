<?php
    require_once("DTTCore.php");
    $action = $_GET["a"];
    //we dont have sesion yet
    $template = file_get_contents("DTTHeader.html");
    echo setTitle($template);
    
    if($action==null){

        header("Location: DTTadmin.php?a=login");
        
    }else if($action=="login"){
    
        require_once("logIn.html");
                
        /*$query = $pdo->prepare("INSERT INTO users(name, password) VALUES (?,?)");
        $query->bindParam(1, $name);
        $query->bindParam(2, $pass);
        $name = "samuel";
        $pass = bcrypt('DTTemployee');
        $query->execute();*/
        
    }else if($action=="check"){

        $user=$_POST["user"];
        $pass=$_POST["password"];

        $_SESSION["error"]=login($user, $pass);
        header("Location: DTTadmin.php?a=admin");

   //Pagina de registro
    }else if($action=="admin"){
    
        if(!isset($_SESSION["name"])){
            header("Location: DTTadmin.php?a=login");

        }else{
            //var_dump($_SESSION["name"]);
	        echo file_get_contents("widgetAdmin.html");
        }
    }else{
        header("Location: DTTadmin.php?a=login");
    }
	echo "<a href='index.php'>building</a>";

