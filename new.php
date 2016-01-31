<?php
    require_once("DTTMenu.php");
    
	echo setTitle();
	
	try {  
  		$query = $pdo->prepare("SELECT * FROM articleTable LIMIT 5");	
        if ($query->execute()) { 
		    $count = 0;
		    while ($row = $query->fetch()){
  					echo display($row); 
			}	
		}
	} catch (Exception $e) {
  		$pdo->rollBack();
  		echo "Fail: " . $e->getMessage();
	}
	$query = null;
	$pdo = null;
	
	//Override link for footer.
	$link = '<a href="article.php?a=allStories">Article Archive</a>';
    $footer = file_get_contents("DTTFooter.html");
  	$footer = str_replace("{{link}}", $link, $footer);
    echo $footer;
