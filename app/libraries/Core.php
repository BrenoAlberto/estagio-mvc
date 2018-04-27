<?php
  /*
   * App Core Class
   * Cria URL & carrega o core controller
   * URL FORMAT - /controller/method/params
   */
  class Core {
    protected $controllerAtual = 'Clientes';
    protected $methodAtual = 'index';
    protected $params = [];

    public function __construct(){

      $url = $this->getUrl();

      // Procura nos controllers pelo primeiro value
      if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
        // Se existe, seta como controller atual
        $this->controllerAtual = ucwords($url[0]);
        // Unset 0 index
        unset($url[0]);
      }

      // Require o controller
      require_once '../app/controllers/'. $this->controllerAtual . '.php';

      // Instancia controller class
      $this->controllerAtual = new $this->controllerAtual;

      // Checa pelo segundo value da url
      if(isset($url[1])){
        // Checa se o method existe no controller
        if(method_exists($this->controllerAtual, $url[1])){
          $this->methodAtual = $url[1];
          // Unset 1 index
          unset($url[1]);
        }
      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Callback com array de params
      call_user_func_array([$this->controllerAtual, $this->methodAtual], $this->params);
    }

    public function getUrl(){
      if(isset($_GET['url'])){
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
        return $url;
      }
    }
  } 
  
  