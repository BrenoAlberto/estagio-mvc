<?php
  session_start();

  function isLoggedIn(){
    if(isset($_SESSION['id_cliente'])){
      return true;
    } else {
      return false;
    }
  }
