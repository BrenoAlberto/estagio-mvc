<?php
  /*
   * Base Controller
   * Carrega os views e models
   */
  class Controller {
    // Carrega model
    public function model($model){
      // Require model file
      require_once '../app/models/' . $model . '.php';

      // Instancia model
      return new $model();
    }

    // Carrega view
    public function view($view, $data = []){
      // Checa pela view file
      if(file_exists('../app/views/' . $view . '.php')){
        require_once '../app/views/' . $view . '.php';
      } else {
        die('View não existe');
      }
    }
  }