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
            switch ($adminArt) {
            case null:
                header("Location: index.php");
                break;
            case "add":
                echo setTitle($template, "New Article");
                echo loadFormEdit($row);
                break;
            case "check":
                $save = $_POST["save"];
	            $cancel = $_POST["cancel"];	
	            if (isset($save)) {
	                $title = $_POST["artTit"];
	                $sumary = $_POST["sumary"];
	                $content = $_POST["Article"];
	                $date = $_POST["date"];
	                //who expects the own admin injectin bad querys?
	                $query = $pdo->prepare("INSERT INTO articleTable (id, title, sumary, article, publishdate) VALUES ()"); 
	            }
	            if (isset($cancel)) {header("Location: DTTadmin.php?a=admin");}
                break;
            case "edit":
                $id = $_GET["c"];//if not null also
	            if($id== null){
	            }else{
	                echo setTitle($template, "Edit Article");
	                $query = $pdo->prepare("SELECT * FROM articleTable WHERE id = :id"); 
                    $query->execute(array('id' => $id));
                    $row = $query->fetch();
	                echo loadFormEdit($row);
	                $link = '<a href = "article.php?a=admin&b=delete&c=' . $id . '">Delete This Article</a>';
	                echo setFoot($link);
	            }
                break;
            case "delete":
                $id = $_GET["c"];//if not null delete else go admin and dont play with urls
                if(!isset($id))
                    header("Location: DTTadmin.php?a=admin");
	            $query = $pdo->prepare("DELETE FROM articleTable WHERE if = :id"); 
                $query->execute(array('id' => $id));
	            header("Location: DTTadmin.php?a=admin");
                break;
            default:
                header("Location: DTTadmin.php?a=login");
            }
          
	    }
	}else{
		header("Location: index.php");
	}
	
	$pdo = null;
	
	//Override link for footer.

