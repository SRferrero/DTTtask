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
	
	
	
    function display($row){
        $html = file_get_contents("templateArticles.html");
  	    $html = str_replace("{{name}}", $row["title"], $html);
  	    $html = str_replace("{{id}}", $row["id"], $html);
  	    $html = str_replace("{{date}}", $row["publishdate"], $html);
  	    $html = str_replace("{{sumary}}", $row["sumary"], $html);
  	    return $html;
   }
   
   function setTitle($str = ""){
        $title = file_get_contents("DTTHeader.html");
  	    $title = str_replace("{{TEST}}", $str, $title);
	    return $title;
   }
   
   function showArticle($row){
        $article = file_get_contents("article.html");
        
        return $article;
   
   }
