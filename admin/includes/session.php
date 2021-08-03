<?php

  class Session
  {
      private  $signed_in = false;
      public   $user_id;

      function  __construct(){
          session_start();
          $this->check_the_login();
      }

      private  function check_the_login()
      {
          if (isset($_session['user_id'])){
              $this->user_id = $_SESSION['user_id'];
              $this->signed_in = true;
              //we dont find
          }else{
              unset($this->user_id);
              $this->signed_in = false;
          }
      }

      public  function  is_signed_in() //getter
      {
          return $this->signed_in;
      }

      public  function  login($user) //$user come from database
      {
         if ($user){
             $this->user_id = $_SESSION['user_id'] = $user->id;
             $this->signed_in =true;
         }
      }

      public  function  logout()
      {
          unset($_SESSION['user_id']);
          unset($this->user_id);
          $this->signed_in = false;
      }
  }


  $session = new Session();