<?php
    require_once '../DTO/GatewayDTO.php';
    class GatewayBL{
        public $gatewayDTO;
        private $url;
        private $link;
        private $linkPeli;
        private $linkCate;

        public function __construct()
        {
            $this->gatewayDTO = new GatewayDTO();
            $this->url='https://sakilala.herokuapp.com/Actores/actor/';
            $this->link= 'https://usuariosla.herokuapp.com/usuario/';
            $this->linkPeli='https://sakilala.herokuapp.com/Peliculas/Pelicula/';
            $this->linkCate='https://sakilala.herokuapp.com/Categorias/Categoria/';
            
        }
        
        public function actor($request)
        {
            if(self::auth('GET')>0)
            {

            
                switch ($request){
                    case 'PUT':{
                        self::http('PUT', $this->gatewayDTO, $this->url );
                        break;

                    }
                    case 'GET':{
                        self::http('GET', $this->gatewayDTO, $this->url. $_GET["id"] );
                    break;
                    }
                    case 'POST':{
                        self::http('POST', $this->gatewayDTO, $this->url );
                    break;
                    }
                    case 'DELETE':{
                        self::http('DELETE', $this->gatewayDTO, $this->url );
                    break;
                    }
                    default:{
                        echo "Default ";
                    
                    }

                }
           }
            else{
               $this->gatewayDTO->response = array('CODE'=>"ERROR", 'TEXT'=>"Token no valido, vuelve a intentarlo"); 
                echo json_encode($this->gatewayDTO->response);
            }
        }
        public function pelicula($request)
        {
            if(self::auth('GET')>0)
            {

            
                switch ($request){
                    
                    case 'GET':{
                        self::http('GET', $this->gatewayDTO, $this->linkPeli . $_GET["id"] );
                    break;
                    }
                    
                    default:{
                        echo "Default ";
                    
                    }

                }
           }
            else{
               $this->gatewayDTO->response = array('CODE'=>"ERROR", 'TEXT'=>"Token no valido, vuelve a intentarlo"); 
                echo json_encode($this->gatewayDTO->response);
            }
        }
        public function categoria($request)
        {
            if(self::auth('GET')>0)
            {

            
                switch ($request){
                    case 'PUT':{
                        self::http('PUT', $this->gatewayDTO, $this->linkCate );
                        break;

                    }
                    case 'GET':{
                        
                        self::http('GET', $this->gatewayDTO, $this->linkCate .$_GET["id"] );
                    break;
                    }
                    case 'POST':{
                        self::http('POST', $this->gatewayDTO, $this->linkCate );
                    break;
                    }
                    case 'DELETE':{
                        self::http('DELETE', $this->gatewayDTO, $this->linkCate );
                    break;
                    }
                    default:{
                        echo "Default ";
                    
                    }

                }
           }
            else{
               $this->gatewayDTO->response = array('CODE'=>"ERROR", 'TEXT'=>"Token no valido, vuelve a intentarlo"); 
                echo json_encode($this->gatewayDTO->response);
            }
        }
        public function auth($request)
        {
            switch ($request){
                case 'PUT':{
                    echo "es put";
                break;
                }
                case 'GET':{
                    return  self::checktoken('GET', $this->gatewayDTO, $this->link );
                break;
                }
                case 'POST':{
                    self::http('POST', $this->gatewayDTO, $this->link );
                

                break;
                }
                case 'DELETE':{
                    echo "es delete";
                break;
                }
                default:{
                    echo "Default ";
                
                }

            }
        }
        public function usuario($request)
        {            
                switch ($request){
                    case 'POST':{
                        self::http('POST', $this->gatewayDTO, $this->link );
                    break;
                    }
                    default:{
                        echo "Default ";
                    
                    }

                }
        }

        public static function http($req, $data, $url)
        {
            $opts = array('http' =>
                array(
                    'method'  => $req,
                    'header'  => "Content-Type: application/json\r\n",
                    'content' => $data->data
                    
                )
            );
                                
            $context  = stream_context_create($opts);
            
           return print_r( file_get_contents($url, false, $context));
        }
        

        public static function checktoken($req, $data, $url) {
            $opts = array(
                'http'=>array(
                    'method' => $req,
                    'header' => "Content-Type: application/json\r\n".
                                "Authorization: ".$data->TOKEN."\r\n"
                )
            );
            
            $context = stream_context_create($opts);
            return file_get_contents($url, false, $context);
        }

    }

?>