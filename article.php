<?php	
	require_once("DTTCore.php");
	 $action = $_GET["a"];
	 $template = file_get_contents("DTTHeader.html");

	 //just loading the page first time
	if($action == null){
        header("Location: index.php");
	}else if(is_numeric($action)){
	
	    $query = $pdo->prepare("SELECT * FROM articleTable WHERE id =" . $action);	
        if ($query->execute()) { 
            $row = $query->fetch();
	        echo setTitle($template, $row["title"]);
	        echo showArticle($row);
		}else{
		    header("Location: index.php");
		}
	
	}else if($action=="allStories"){
	//TODO show maybe 15 and add a load more
	    try {  
  		    $query = $pdo->prepare("SELECT * FROM articleTable");	
            if ($query->execute()) { 
		        $count = 0;
		        while ($row = $query->fetch()){
		            echo setTitle($template, "Article Archive");
  				    echo display($row);
			    }	
		    }
	    } catch (Exception $e) {
  		    $pdo->rollBack();
  		    echo "Fail: " . $e->getMessage();
	    }
	
	}else{
		header("Location: index.php");
	}
	$pdo = null;
	
	//Override link for footer.
	$link = '<a href="index.php">Return to homepage</a>';
	$footer = file_get_contents("DTTFooter.html");
  	$footer = str_replace("{{link}}", $link, $footer);
    echo $footer;
