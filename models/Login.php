<?php
session_start();
    class Login{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }
        public function login($data){
            $this->db->query('SELECT * FROM logintb WHERE username=:user_name AND password=:password');
            $this->db->bind(':user_name',$data['username']);
            $this->db->bind(':password',$data['password']);
            $result = $this->db->single();
            if($result->username == $data['username'] && $result->password == $data['password']){
                $_SESSION['user'] = $data['username'];
                header("Location:admin-panel.php");
            }else{
                echo "<script>window.open('invalid.php','_self')</script>";
            }
        }
    }
?>