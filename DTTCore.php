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
   
