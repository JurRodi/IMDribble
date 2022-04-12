<?php
    include_once(__DIR__."/./Db.php");
    class User{
        protected $username;
        protected $email;
        protected $email2;
        protected $password;
        protected $password_conf;
        protected static $avatar;
        protected $bio;

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
            
            $this->email = $email;
            return $this;
        }

        public function getEmail2()
        {
                return $this->email2;
        }

        /**
         * Set the value of email2
         *
         * @return  self
         */ 
        public function setEmail2($email2)
        {
                $this->email2 = $email2;

                return $this;
        }

        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            if(strlen($password)<=6){
                throw new Exception("Your password has to be at least 6 characters long");
            }
            $this->password = $password;
            return $this;
        }

        public function getPassword_conf(){
            return $this->password_conf;
        }
        public function setPassword_conf($password_conf){
            if($this->password === $password_conf){
                $this->password_conf = $password_conf;
                return $this;
            }else{
                throw new Exception("Passwords do not match");
            }
        }

        public function save(){
            if(strpos($this->email, '@student.thomasmore.be') === false && strpos($this->email, '@thomasmore.be') === false ) {
                throw new Exception("Use your Thomas More email adress");
            }
            $conn = Db::getConnection();
            $statement=$conn->prepare("select * from users where email=:email");
            $statement->bindValue(":email", $this->email);
            $statement->execute();
            $existingUser = $statement->fetch();
            if($existingUser){
                throw new Exception("This email adress has already been used");
            }
            else{
                $options = [ 
                        'cost' => 14
                ];
                $password = password_hash($this->password, PASSWORD_DEFAULT, $options);
        
                $statement=$conn->prepare("insert into users(username, email, password) values (:username, :email, :password)");
                $statement->bindValue(":username", $this->username);
                $statement->bindValue(":email", $this->email);
                $statement->bindValue(":password", $password);
            }
            return $statement->execute();
        }

        public function canLogin() {
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindValue(":email", $this->email);
            $statement->execute();

            $user = $statement->fetch();

            if(!$user) {
                throw new Exception("User does not exist");
                //return false;
            }
            if(password_verify($this->password, $user['password'])) {
                return true;
            } else {
                throw new Exception("Passwords incorrect");
                //return false;
            }		
	}

        /**
         * Get the value of avatar
         */ 
        public function getAvatar()
        {
                return $this->avatar;
        }

        /**
         * Set the value of avatar
         *
         * @return  self
         */ 
        public static function setAvatar($avatar)
        {
                self::$avatar = $avatar;

                return self::$avatar;
        }

        public function getBio()
        {
                return $this->bio;
        }

        /**
         * Set the value of bio
         *
         * @return  self
         */ 
        public function setBio($bio)
        {
                $this->bio = $bio;

                return $this;
        }
        
        public static function getUserByEmail($email) {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from users where email = :email;");
                $statement->bindValue(':email', $email);
                $statement->execute();
                return $statement->fetch();
            }
        
    }