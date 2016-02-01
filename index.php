<?php
    require_once("DTTCore.php");
    $template = file_get_contents("DTTHeader.html");
	echo setTitle($template);
	
	try {  
  		$query = $pdo->prepare("SELECT * FROM articleTable LIMIT 5");	
        if ($query->execute()) { 
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
	$link = '<a href = "article.php?a=allStories">Article Archive</a>';
    echo  setFoot($link);
