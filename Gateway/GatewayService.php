<?php
  require_once './GatewayBL.php';
  $gatewayBL = new GatewayBL();
  $gatewayDTO = new GatewayDTO();


  $gatewayDTO->data = file_get_contents('php://input');
  $headers = apache_request_headers();
 
 if(isset($_GET["id"]))
 {
      $gatewayDTO->Id = $_GET["id"];
 }     
 else
 {
      $gatewayDTO->Id = "";
 }
  if(isset($headers['Authorization']))
  {
        $gatewayDTO->TOKEN= $headers['Authorization'];
  }
  else{
      $gatewayDTO->TOKEN ="";
  }
  $gatewayBL->gatewayDTO = $gatewayDTO;

  
  switch($_GET["param"])
  {
    
      case "actor":
            {
                  $gatewayBL->actor($_SERVER["REQUEST_METHOD"]);
                  break;
            }  
      case "auth":
            {
                  $gatewayBL->auth($_SERVER["REQUEST_METHOD"]);
                  break;
            }
      case "pelicula":
            {
                   $gatewayBL->pelicula($_SERVER["REQUEST_METHOD"]);
                   break;
            }
       case "categoria":
            {
                   $gatewayBL->categoria($_SERVER["REQUEST_METHOD"]);
                   break;
            }
      case "usuario":
            {
                  $gatewayBL->usuario($_SERVER["REQUEST_METHOD"]);
                  break;
            }
      
    
      
  }
  
  

?>