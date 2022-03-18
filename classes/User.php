<?php
    class User{
        protected $username;
        protected $email;
        protected $password;
        protected $password_conf;

        public function getUsername(){
            return $this->username;
        }
        public function setUsername($username){
            if(empty($username)){
                throw new Exception("Username cannot be empty.");
            }
            $this->username = $username;
            return $this;
        }
        
        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email) {
            if(empty($email)){
                throw new Exception("Email cannot be empty.");
            }
            if(strpos($email, '@student.thomasmore.be') === false && strpos($email, '@thomasmore.be') === false ) {
                throw new Exception("Use your Thomas More email adress");
            }

            include_once(__DIR__."/./Db.php");
            $conn = Db::getConnection();
            $statement=$conn->prepare("select * from users where email=:email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $existingUser = $statement->fetch();
            if($existingUser){
                throw new Exception("This email adress has already been used");
            }
            
            $this->email = $email;
            return $this;
        }

        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            if(empty($password) || strlen($password)<=6){
                throw new Exception("Your password has to be at least 6 characters long");
            }
            $this->password = $password;
            return $this;
        }

        public function getPassword_conf(){
            return $this->password_conf;
        }
        public function setPassword_conf($password_conf){
            if(!empty($password_conf) && ($this->password === $password_conf)){
                $this->password_conf = $password_conf;
                return $this;
            }else{
                throw new Exception("Passwords do not match");
            }
        }

        public function save(){
            $options = [ 'cost' => 12];
			$password = password_hash($this->password, PASSWORD_DEFAULT, $options);
            include_once(__DIR__."/./Db.php");
            $conn = Db::getConnection();

            $statement=$conn->prepare("insert into users(username, email, password) values (:username, :email, :password)");
            $statement->bindValue(":username", $this->username);
            $statement->bindValue(":email", $this->email);
            $statement->bindValue(":password", $password);
            
            return $statement->execute();
        }
        
    }