<?php 
    include_once(__DIR__."/./Db.php");

    class Tag{
        protected $name;

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        public static function getAll(){
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from tags");
            $statement->execute();
            return $statement->fetchAll();
        }
    }