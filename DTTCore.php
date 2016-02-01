<?php
   ////////////////////////////
    /*         Database       */
  ////////////////////////////
  
	$username = "root"; // username
	$password = "mono"; // password
    session_name("DTT");
    session_start();
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=articles;charset=utf8', $username, $password, 
      		array(PDO::ATTR_PERSISTENT => true));
  		//echo "Conectado\n";
	} catch (Exception $e) {
        die("No se pudo conectar: " . $e->getMessage());
	}
	
    function display($row){
        $html = file_get_contents("templateArticles.html");
  	    $html = str_replace("{{name}}", $row["title"], $html);
  	    $html = str_replace("{{id}}", $row["id"], $html);
  	    $html = str_replace("{{date}}", showDate($row["publishdate"], 1), $html);
  	    $html = str_replace("{{sumary}}", $row["sumary"], $html);
  	    return $html;
   }
   
   function setTitle($template, $str = ""){
        $template = str_replace("{{TEST}}", $str, $template); 
        return $template; 
   }
   
   function setFoot($link = ""){
        $footer = file_get_contents("DTTFooter.html");
  	    $footer = str_replace("{{link}}", $link, $footer);
        return $footer; 
   }
   
   function showArticle($row){
        $article = file_get_contents("article.html");
        $article = str_replace("{{sumary}}", $row["sumary"], $article);
        $article = str_replace("{{content}}", $row["article"], $article);
        $article = str_replace("{{date}}", showDate($row["publishdate"]), $article);
        
        return $article;
   }
   
   
    function showDate($date, $opt = 0){
  	    $orderdate = explode('-', $date);
        $year = $orderdate[0];
        $month   = $orderdate[1];
        $day  = $orderdate[2];
        $dateObj   = DateTime::createFromFormat('!m', $month);
        $monthName = strtoupper($dateObj->format('F'));    
        //this is going to be day and month
        if($opt==1){
            return $day . " " . $monthName;        
        }else if($opt==2){
        
            
        }else{ 
            return $day . " " . $monthName . " " .$year;        
        }
   
    }
    
    function showTable($row, $count){
        $article = file_get_contents("tableArticles.html");
        $article = str_replace("{{TITLE}}", $row["title"], $article);
        $article = str_replace("{{DATE}}", showDate($row["publishdate"],1), $article);
        $article = str_replace("{{COUNT}}", $count, $article);
        return $article;
    }
    
    function loadFormEdit($row){
        $form = file_get_contents("formArticle.html");
        $form = str_replace("{{TITLE}}", $row["title"], $form);
        $form = str_replace("{{SUMARY}}", $row["sumary"], $form);
        $form = str_replace("{{ARTICLE}}", $row["article"], $form);
        $form = str_replace("{{DATE}}", $row["publishdate"], $form);
        $form = str_replace("{{ID}}", $row["id"], $form);
        $form = str_replace("{{BUTTON}}", "update", $form);
        return $form;
    }
    
    function newArticle($nArt = "nuevo articulo"){
        $form = file_get_contents("formArticle.html");
        $form = str_replace("{{TITLE}}", $nArt, $form);
        $form = str_replace("{{SUMARY}}", $nArt, $form);
        $form = str_replace("{{ARTICLE}}", $nArt, $form);
        $form = str_replace("{{DATE}}", $nArt, $form);
        $form = str_replace("{{BUTTON}}", "save", $form);
        
        return $form;
   }
   
   
    function login($user, $password){ 

        $error=0;
        if (!empty($user) && !empty($password)){
     
            global $pdo; 
            //TODO sqlinject thing
            $query = $pdo->prepare("SELECT * FROM users WHERE name = :name"); 
            $query->execute(array('name' => $user));
            $num = $query->rowCount(); 

            if($num!=0){
                $row = $query->fetch();

                //Check with hash password
                if(password_verify($password, $row["password"])){
                    
                    $_SESSION["name"] = $row["name"];
                       
                }else{ $error="Wrong Password"; }
            }else{ $error="user not in the system"; }
        }else{ $error=-1; }

        return $error;

    }

    function bcrypt($password){ 
        $options = array('cost' => 10);
        $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
        return $password_hash;
    }

    function logout(){ 
        session_destroy();
    }
   
