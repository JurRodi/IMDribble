<?php
    include_once(__DIR__."/./Db.php");
    class Follow{
        private $id;
        private $user1;
        private $user2;

        public function getUser1(){
            return $this->user1;
        }

        public function setUser1($user1){
            $this->user1 = $user1;
            return $this;
        }

        public function getUser2(){
            return $this->user2;
        }

        public function setUser2($user2){
            $this->user2 = $user2;
            return $this;
        }

        public function save(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into follow (user1, user2) values (:user1, :user2)");

            $user1 = $this->getUser1();
            $user2 = $this->getUser2();

            $statement->bindValue(':user1', $user1);
            $statement->bindValue(':user2', $user2);

            $statement->execute();
            return $conn->lastInsertId();
        }

        public static function getFollow($user1, $user2){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from follow where user1 = :user1 and user2 = :user2");
            $statement->bindValue("user1", $user1);
            $statement->bindValue("user2", $user2);
            $statement->execute();
            return $statement->fetch();
        }

        public function delete(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("delete from follow where user1 = :user1 and user2 = :user2");
            $user1 = $this->getUser1();
            $user2 = $this->getUser2();
            $statement->bindValue("user1", $user1);
            $statement->bindValue("user2", $user2);

            $statement->execute();
        }
        
    }