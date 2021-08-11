<?php

// Starting the session
  class Session
  {
      private  $signed_in = false;
      public   $user_id; //i
      public   $count;
      public   $message;

     public function  __construct(){
          session_start();
          $this->check_the_login();
          $this->check_message();
          $this->visitor_count();

      }

      private  function check_the_login()
      {
          if (isset($_SESSION['user_id'])){
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

      //Function to login the user
      public  function  login($user) //$user come from database
      {
         if ($user){
             $this->user_id = $_SESSION['user_id'] = $user->id; //id
             $this->signed_in = true;
         }
      }

      public  function  logout()
      {
          unset($_SESSION['user_id']);
          unset($this->user_id);
          $this->signed_in = false;
      }

      //set/get the message
      public  function  message($msg="")
      {
          if (!empty($msg)){

              $_SESSION['message'] = $msg;

          }else{

              return $this->message;
          }
      }

      private  function check_message()
      {
          if (isset($_SESSION['message'])){
              unset($_SESSION['message']);
          }else{
              $this->message = "";
          }
      }

      public  function  visitor_count()
      {
          if (isset($_SESSION['count'])){
              return $this-> count = $_SESSION['count']++;
          }else{
              return  $_SESSION['count'] = 1;
          }
      }
  }


  $session = new Session();
  $message = $session->message();