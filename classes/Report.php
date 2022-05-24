<?php

class report{
    protected $user_id;
    protected $reportuser_id;
    protected $project_id;
    protected $complaint;
  
    public function getUserId()
    {
        return $this->user_id;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

                return $this;
    }
    public function getReportuserId()
    {
        return $this->reportuser_id;
    }
    public function setReportuserId($reportuser_id)
    {
        $this->reportuser_id = $reportuser_id;

                return $this;
    }

    public function getProjectId()
    {
        return $this->project_id;
    }
    public function setProjectId($project_id)
    {
        $this->project_id = $project_id;

                return $this;
    }
    public function getComplaint()
    {
        return $this->complaint;
    }
    public function setComplaint($complaint)
    {
        $this->complaint= $complaint;

        return $this;
    }

    public function sendComplaint($user_id){
        $conn = Db::getConnection();

        $statement = $conn->prepare("insert into report (user_id, reportuser_id, project_id, complaint, timestamp) 
            values (:user_id, :reportuser_id, :project_id, :complaint, CURRENT_TIMESTAMP);");
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':reportuser_id', $this->reportuser_id);
        $statement->bindValue(':project_id', $this->project_id);
        $statement->bindValue(':complaint', $this->complaint);
         
        return $statement->execute();
    }
   
}