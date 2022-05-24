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
        protected $education;
        protected $instagram;
        protected $linkedin;

        public function getUsername(){
            return $this->username;
        }
        public function setUsername($username){
            if(empty($username)){
                throw new Exception("Username cannot be empty.");
            }
            $conn = Db::getConnection();
            $statement=$conn->prepare("select * from users where username=:username");
            $statement->bindValue(":username", $username);
            $statement->execute();
            $existingUser = $statement->fetch();
            if($existingUser){
                throw new Exception("This username has already been used");
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
            $this->email = $email;
            return $this;
        }

        public function getEmail2()
        {
                return $this->email2;
        }

        public function setEmail2($email2){
            if(strpos($email2, '@') === false && strpos($email2, '.') === false ) {
                throw new Exception("Use a valid second email adress");
            }
            $this->email2 = $email2;
            return $this;
        }

        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            if(strlen($password)<=6){
                throw new Exception("Your password has to be at least 7 characters long");
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
            include_once(__DIR__."/../classes/Db.php");
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
            $statement = $conn->prepare("select * from users where email = :email OR email2 = :email");
            
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
                $statement = $conn->prepare("select * from users where email = :email or email2 = :email;");
                $statement->bindValue(':email', $email);
                $statement->execute();
                return $statement->fetch();
        }

        public static function getUserById($id) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where id = :id;");
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetch();
        }

        public static function getUserByUsername($username) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where username = :username;");
            $statement->bindValue(':username', $username);
            $statement->execute();
           
            $existingUser = $statement->fetch();
            if($existingUser){
                return true;
            }
            else{
                return false;
            }
        }
        public static function getExistingEmail($email) {
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from users where email = :email;");
            $statement->bindValue(':email', $email);
            $statement->execute();
            $existingEmail = $statement->fetch();
            if($existingEmail){
                return true;
            }
            else{
                return false;
            }
    }

        /**
         * Get the value of education
         */ 
        public function getEducation()
        {
                return $this->education;
        }

        /**
         * Set the value of education
         *
         * @return  self
         */ 
        public function setEducation($education)
        {
                $this->education = $education;

                return $this;
        }

        /**
         * Get the value of instagram
         */ 
        public function getInstagram()
        {
                return $this->instagram;
        }

        /**
         * Set the value of instagram
         *
         * @return  self
         */ 
        public function setInstagram($instagram)
        {
            if (filter_var($instagram, FILTER_VALIDATE_URL) === FALSE) {
                throw new Exception("The link to your instagram account is not a valid url.");
            }
            $this->instagram = $instagram;
            return $this;
        }

        /**
         * Get the value of linkedin
         */ 
        public function getLinkedin()
        {
                return $this->linkedin;
        }

        /**
         * Set the value of linkedin
         *
         * @return  self
         */ 
        public function setLinkedin($linkedin)
        {
            if (filter_var($linkedin, FILTER_VALIDATE_URL) === FALSE) {
                throw new Exception("The link to your linkedin account is not a valid url.");
            }
            $this->linkedin = $linkedin;
            return $this;
        }

        public function updateProfile(){
            $conn = Db::getConnection();
            $statement=$conn->prepare("update users set bio = :bio, education = :education, email2 = :email2, instagram = :instagram, linkedin = :linkedin where email = :email");
            $statement->bindValue(":email", $this->email);
            $statement->bindValue(":bio", $this->bio);
            $statement->bindValue(":education", $this->education);
            $statement->bindValue(":email2", $this->email2);
            $statement->bindValue(":instagram", $this->instagram);
            $statement->bindValue(":linkedin", $this->linkedin);
            return $statement->execute();
        }

        public static function deleteUser($id, $email){
            $conn = Db::getConnection();
            $statementProject = $conn->prepare("DELETE * from projects where user_id = :id;");
            $statementLike = $conn->prepare("DELETE * from likes where user_id = :id;");
            $statementComments = $conn->prepare("DELETE * comments from users where user_id = :id;");
            $statement = $conn->prepare("DELETE * from users where email = :email;");
            
            $statementProject->bindValue("id",$id);
            $statementLike->bindValue("id",$id);
            $statementComments->bindValue("id",$id);
            $statement->bindValue("email",$email);
        
            $statementProject->execute();
            $statementLike->execute();
            $statementComments->execute();
            $statement->execute();
        }
    }