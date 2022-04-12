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

        public static function getAll() {
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from projects");
                $statement->execute();
                $projects = $statement->fetchAll();
                return $projects;
        }

        public static function getAllImagesOfProject($project_id){
                $conn = Db::getConnection();
                $statement = $conn->prepare("select * from images where project_id = :project_id");
                $statement->bindValue(":project_id", $project_id);
                $statement->execute();
                $images = $statement->fetchAll();
                return $images;
        }
    }
?>