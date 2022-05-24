<?php
    class Like {
        private $postId;
        private $userId;

        public function getPostId()
        {
                return $this->postId;
        }

        public function setPostId($postId)
        {
                $this->postId = $postId;

                return $this;
        }

        public function getUserId()
        {
                return $this->userId;
        }

        public function setUserId($userId){
                $this->userId = $userId;

                return $this;
        }

        public static function saveLike($postId, $userId){
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into likes (post_id, user_id) values (:post_id, :user_id)");
            $statement->bindValue(":post_id", $postId);
            $statement->bindValue(":user_id", $userId);
            return $statement->execute();
        }

        public static function CountLikes($post_id){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select COUNT(id) as total FROM likes WHERE post_id = :post_id");
            $statement->bindValue(":post_id", $post_id);
            $statement->execute();
            $count = $statement->fetch();
            return $count['total'];
        }

        public static function removeLike($postId, $userId){
                $conn = Db::getConnection();
                $statement = $conn->prepare("delete from likes where post_id = :post_id and user_id = :user_id");
                $statement->bindValue(":post_id", $postId);
                $statement->bindValue(":user_id", $userId);
                return $statement->execute();
        }

        public static function isLiked($post_id, $user_id){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from likes where post_id = :post_id and user_id = :user_id");
            $statement->bindValue(":post_id", $post_id);
            $statement->bindValue(":user_id", $user_id);
            $statement->execute();
            $count = $statement->fetch();
            if(!empty($count)){
                return true;
            }
            return false;
        }
    }