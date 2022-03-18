<?php 

    class User {
        private $email;
        private $password;
        private $email2;
        private $username;
        private $avatar;

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of email2
         */ 
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

        /**
         * Get the value of username
         */ 
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
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
        public function setAvatar($avatar)
        {
                $this->avatar = $avatar;

                return $this;
        }

        public static function getAll(){
            $conn = Db::getConnection();
            $stmt = $conn->query("select * from users");
            $users = $stmt->fetchAll();
            return $users;
        }
    }