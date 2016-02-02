<?php
    require_once("DTTCore.php");
    $action = $_GET["a"];
    
    //we dont have sesion yet
    $template = file_get_contents("DTTHeader.html");

    
            /*$query = $pdo->prepare("INSERT INTO users(name, password) VALUES (?,?)");
        $query->bindParam(1, $name);
        $query->bindParam(2, $pass);
        $name = "samuel";
        $pass = bcrypt('DTTemployee');
        $query->execute();*/
    
    if($action==null){

        header("Location: DTTadmin.php?a=login");
        
    }else if($action=="login"){
        if(isset($_SESSION["name"]))
            header("Location: DTTadmin.php?a=admin");
        echo setTitle($template);
        require_once("logIn.html");
        
        if(isset($_SESSION["error"])){
            include("javascript.php");
            //so it wont be messing when you go out of the log without logging
            unset($_SESSION["error"]);
        }
            
        echo setFoot();
    }else if($action=="check"){
    
        $user = $_POST["user"];
        $pass = $_POST["password"];

        $_SESSION["error"] = login($user, $pass);
        header("Location: DTTadmin.php?a=admin");

    }else if($action=="admin"){
    
        if(!isset($_SESSION["name"])){
            header("Location: DTTadmin.php?a=login");

        }else{
            //var_dump($_SESSION["name"]);
	        $admin = file_get_contents("widgetAdmin.html");
	        echo setTitle($template, "", $admin);
	        require_once("adminArt.html");
	        $query = $pdo->prepare("SELECT * FROM articleTable");	
	        $count = 0;
            if ($query->execute()) { 
		        while ($row = $query->fetch()){
		            $count+=1;
  					echo showTable($row, $count);
  					 
			    }	
			
		    }
	        $link = '</table> <br/>'. $count .' articles in total<br/><br/><a href = "article.php?a=admin&b=add">Add a New Article</a>';
	        echo setFoot($link);
        }
    }else if($action=="logout"){
        logout();
        header("Location: index.php");
    
    }else{
        header("Location: DTTadmin.php?a=login");
    }


