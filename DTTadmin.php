<?php
    require_once("DTTCore.php");
    //if(!isset($_SESSION["id"]){
        $template = file_get_contents("DTTHeader.html");
	    echo setTitle($template);
	    require_once("logIn.html");
        //if(login()){}
    //}else{
    
    
    //}





	echo "<a href='index.php'>building</a>";

