<?php

  class Session
  {
      private  $signed_in;
      public   $user_id;

      function  __construct(){
          session_start();
      }

      private  function check_the_login()
      {
          if (isset($_session['user_id'])){
              $this->user_id = $_session['user_id'];
              $this->signed_in = true;
              //we dont find
          }else{
              unset($this->user_id);
              $this->signed_in = false;
          }
      }
  }


  $session = new Session();