<?php
   ////////////////////////////
    /*         Database       */
  ////////////////////////////
  
	$username = "root"; // username
	$password = "mono"; // password

	try {
		$pdo = new PDO('mysql:host=localhost;dbname=articles;charset=utf8', $username, $password, 
      		array(PDO::ATTR_PERSISTENT => true));
  		//echo "Conectado\n";
	} catch (Exception $e) {
        die("No se pudo conectar: " . $e->getMessage());
	}
    session_name("DTT");
    session_start();
	
	
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
        }else{ 
            return $day . " " . $monthName . " " .$year;        
        }
   
   }
/*function login($user, $password){ 

    $error=0;
    if (!empty($user) && !empty($password)){

     global $pdo; 
     $query = $pdo->prepare("SELECT * FROM users WHERE user='$user'"); //Busco el user
     $query->execute();
     $num = $query->rowCount(); 

     if($num!=0){
        $row = $query->fetch()

            //Ahora que se que existe el user compruebo el password
        if(password_verify($password, $row["password"])){

               //Creo la sesion asignando variables de sesion con los datos del usuario
            $_SESSION["id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["user"] = $row["user"];
            $_SESSION['timeout'] = time();
            
         }else{ $error="Wrong Password"; }
         
     }else{ $error="user not in the system"; }

         //Libero de la memoria los resultados de la consulta
         mysqli_free_result($result);

    }else{ $error=-1; }

      return $error;

}*/

function bcrypt($password){ 
    $options = array('cost' => 10);
    $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
    return $password_hash;
}

function logout(){ 
    session_destroy();
}
   
