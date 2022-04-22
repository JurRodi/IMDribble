<?php 
    include_once(__DIR__."/./Db.php");
    class Project{
        protected $titel;
        protected $teaser;
        protected $description;
        protected $image;
        protected $user_id;

        

        /**
         * Get the value of titel
         */ 
        public function getTitel()
        {
                return $this->titel;
        }

        /**
         * Set the value of titel
         *
         * @return  self
         */ 
        public function setTitel($titel)
        {
                $this->titel = $titel;

                return $this;
        }

        /**
         * Get the value of teaser
         */ 
        public function getTeaser()
        {
                return $this->teaser;
        }

        /**
         * Set the value of teaser
         *
         * @return  self
         */ 
        public function setTeaser($teaser)
        {
                $this->teaser = $teaser;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        public static function getAmountPerPage($limit, $offset) {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from projects order by timestamp desc limit $limit offset $offset");
                $statement->execute();
                $projects = $statement->fetchAll();
                return $projects;
        }

        public static function countAll() {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select count(id) as total from projects");
                $statement->execute();
                $count = $statement->fetchAll();
                return $count;
        }

        public static function getAllImagesOfProject($project_id){
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from images where project_id = :project_id");
                $statement->bindValue(":project_id", $project_id);
                $statement->execute();
                $images = $statement->fetchAll();
                return $images;
        }

        public static function addProject($user_id){
                $conn = Db::getConnection();
                $project = $conn->prepare("INSERT INTO projects (title, teaser, description, user_id) VALUES (:title, :teaser, :description, :user_id)");
                $project->bindValue(':title', $_POST['title']);
                $project->bindValue(':teaser', $_POST['teaser']);
                $project->bindValue(':description', $_POST['description']);
                $project->bindValue(':user_id', $user_id);
                $project->execute();
                $project_id = $conn->lastInsertId();
                foreach ($_POST['tags'] as $tag){
                        $stmt = $conn->prepare("INSERT INTO project_tag (project_id, tag_id) VALUES (:project_id, :tag_id)");
                        $stmt->bindValue(':project_id', $project_id);
                        $stmt->bindValue(':tag_id', $tag);
                        $stmt->execute();
                }
                return $project_id;
        }

        public static function getUser($user_id){
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from users where id = :user_id");
                $statement->bindValue("user_id", $user_id);
                $statement->execute();
                return $statement->fetch();
        }

        public static function getProjectbyTitle($title){
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from projects where title = :title");
                $statement->bindValue("title", $title);
                $statement->execute();
                return $statement->fetch();
        }

        public static function getTagsOfProject($project_id){
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from project_tag join tags on project_tag.tag_id = tags.id where project_id = :project_id");
                $statement->bindValue("project_id", $project_id);
                $statement->execute();
                return $statement->fetchAll();
        }
    }
?>