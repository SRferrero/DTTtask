<?php
   ////////////////////////////
    /*         Database       */
  ////////////////////////////
  class DB {


	private $conexion;
    //session_name("DTT");
    //session_start();
    public function __construct(){
	     try {
		      $pdo = new PDO('mysql:host=localhost;dbname=articles;charset=utf8',
                  'root',
                  'mono',
      		        array(PDO::ATTR_PERSISTENT => true));
  		//echo "Conectado\n";
	     } catch (Exception $e) {
         die("No se pudo conectar: " . $e->getMessage());
	      }
      }

      //clean in the controller before sending?
      public function consulta($sql){
        $resultado = $pdo->query($sql);
        //$resultado = mysql_query($sql,$this->conexion);
        if(!$resultado){
          print_r($pdo->errorInfo());
          //echo 'MySQL Error: ' . mysql_error();
            exit;
        }
        return $resultado;
      }

    public function login($user, $password){

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

    private function bcrypt($password){
        $options = array('cost' => 10);
        $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
        return $password_hash;
    }

    public function logout(){
        session_destroy();
    }
  }
