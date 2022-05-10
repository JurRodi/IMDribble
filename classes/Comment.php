<?php
    include_once(__DIR__."/./Db.php");
    class Comment{
        private $id;
        private $text;
        private $postId;
        private $userId;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function getText(){
            return $this->text;
        }

        public function setText($text){
            $this->text = $text;
            return $this;
        }

        public function getPostId(){
            return $this->postId;
        }

        public function setPostId($postId){
            $this->postId = $postId;
            return $this;
        }

        public function getUserId(){
            return $this->userId;
        }

        public function setUserId($userId){
            $this->userId = $userId;
            return $this;
        }

        public function save(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into comments (text, postId, userId) values (:text, :postId, :userId)");

            $text = $this->getText();
            $postId = $this->getPostId();
            $userId = $this->getUserId();

            $statement->bindValue(':text', $text);
            $statement->bindValue(':postId', $postId);
            $statement->bindValue(':userId', $userId);

            $statement->execute();
            return $conn->lastInsertId();
        }

        public function delete(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("delete from comments where id = :id");

            $id = $this->getId();
            $statement->bindValue(':id', $id);

            $statement->execute();
        }

        public static function getAll($postId){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from comments where postid = :postId;");
            $statement->bindValue(':postId', $postId);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        
    }