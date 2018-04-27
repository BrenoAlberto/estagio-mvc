<?php
  // Carrega Config
  require_once 'config/config.php';
  // Carrega Helpers
  require_once 'helpers/url_helper.php';
  require_once 'helpers/session_helper.php';

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
