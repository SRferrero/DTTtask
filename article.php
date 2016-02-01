<?php	
	require_once("DTTCore.php");
	 $action = $_GET["a"];
	 $template = file_get_contents("DTTHeader.html");

	 //just loading the page first time
	if($action == null){
        header("Location: index.php");
	}else if(is_numeric($action)){
	
	    //no need for protection because if its not number does not go in
	    $query = $pdo->prepare("SELECT * FROM articleTable WHERE id =" . $action);	
        if ($query->execute()) { 
            $row = $query->fetch();
	        echo setTitle($template, $row["title"]);
	        echo showArticle($row);
	        $link = '<a href="index.php">Return to homepage</a>';
	        echo  setFoot($link);
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
		    $link = '<a href="index.php">Return to homepage</a>';
	        echo  setFoot($link);
	    } catch (Exception $e) {
  		    $pdo->rollBack();
  		    echo "Fail: " . $e->getMessage();
	    }
	
	}else if($action=="admin"){
	
	    if(!isset($_SESSION["name"])){
            header("Location: DTTadmin.php?a=login");

        }else{ 
            $adminArt = $_GET["b"];//if null

            if($adminArt=="add"){
        
	
	        }else if($adminArt=="add"){
	   
	
	        }else if($adminArt=="check"){
	            $save = $_POST["save"];
	            $cancel = $_POST["cancel"];	
	            if (isset($save)) {//add to de database
	            }
	            if (isset($cancel)) {header("Location: index.php");}
	        }else if($adminArt=="edit"){
	            $id = $_GET["c"];//if not null also
	            
	            echo setTitle($template, "Edit Article");
	       
	            //TODO sql injection protection
	            $query = $pdo->prepare("SELECT * FROM articleTable WHERE id = :id"); 
                $query->execute(array('id' => $id));
                $row = $query->fetch();
	            echo loadFormEdit($row);
	            $link = '<a href = "article.php?a=admin&b=delete&c=' . $id . '">Delete This Article</a>';
	            echo setFoot($link);
	        }else if($adminArt=="delete"){
	    
	            $id = $_GET["c"];//if not null
	            $query = $pdo->prepare("DELETE FROM articleTable WHERE if = :id"); 
                $query->execute(array('id' => $id));
	            header("Location: DTTadmin.php?a=admin");
	        }
	    }
	}else{
		header("Location: index.php");
	}
	
	$pdo = null;
	
	//Override link for footer.

