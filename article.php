<?php
	
	
	include("DTTMenu.php");
	 $action = $_GET["a"];
	 //var_dump($action);
	 //just loading the page first time
	if($action == null){
        header("Location: new.php");
	}else if(is_numeric($action)){
	//TODO if $action < count all right else new.php
	    $query = $pdo->prepare("SELECT * FROM articleTable WHERE id =" . $action);	
        if ($query->execute()) { 
            $row = $query->fetch();
	        echo setTitle($row["title"]);
	        echo showArticle($row);
		}else{
		    header("Location: new.php");
		}
	
	}else if($action=="allStories"){
	//TODO show maybe 15 and add a load more.
        echo setTitle("Article Archive");
	    try {  
  		    $query = $pdo->prepare("SELECT * FROM articleTable");	
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
	
	}else{
		header("Location: new.php");
	}
	$pdo = null;
	
	//Override link for footer.
	$link = '<a href="new.php">Return to homepage</a>';
	$footer = file_get_contents("DTTFooter.html");
  	$footer = str_replace("{{link}}", $link, $footer);
    echo $footer;
