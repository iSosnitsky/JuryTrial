<?php
namespace DAO;
use JsonSerializable;

include_once __DIR__ . '/../DAO.php';

class CourtCase implements JsonSerializable
{

    private $caseId,$caseDescription, $juryOpinions;

    /**
     * @return mixed
     */
    public function getCaseDescription()
    {
        return $this->caseDescription;
    }

    /**
     * CourtCase constructor.
     * @param $case_id
     */
    public function __construct($case_id)
    {

        $this->caseId = $case_id;
        $this->juryOpinions = DAO::getInstance()->select("SELECT jury_name, jury_mail, opinion,datetime, isOpen, jury_opinions.jury_id FROM jury LEFT JOIN jury_opinions ON jury.jury_id = jury_opinions.jury_id WHERE jury_opinions.case_id=$this->caseId;");
        $this->caseDescription = DAO::getInstance()->select("SELECT description FROM `case` WHERE case_id = $this->caseId")[0]['description'];
    }

    public function setOpinion($jury_id,  $opinion){
        $opinion = DAO::getInstance()->checkString($opinion);
        $jury_id = DAO::getInstance()->checkString($jury_id);
        DAO::getInstance()->query("UPDATE jury_opinions SET opinion=$opinion, isOpen=0, datetime=CURRENT_TIMESTAMP() WHERE isOpen=1 AND jury_id=$jury_id AND case_id = $this->caseId");
        $this->refresh();
        return true;
    }

    /**
     * @return bool|\mysqli_result
     */
    public function getJuryOpinions()
    {
        return $this->juryOpinions;
    }

    public static function getAllJury(){
        return DAO::getInstance()->select("SELECT jury_id, jury_mail FROM jury");
    }

    public static function getAllCases(){
        return DAO::getInstance()->select("SELECT * FROM `case` ORDER BY case_id DESC;");
    }

    public static function newCase($description){
        $description=DAO::getInstance()->checkString($description);
        if (DAO::getInstance()->query("INSERT INTO `case`(description) VALUES ('$description')")){
            return DAO::getInstance()->query("SELECT case_id FROM `case` ORDER BY case_id DESC LIMIT 1")->fetch_assoc();
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getCaseId()
    {
        return $this->caseId;
    }




    private function refresh(){
        $this->juryOpinions = DAO::getInstance()->query("SELECT jury_name, jury_mail, opinion FROM jury LEFT JOIN jury_opinions ON jury.jury_id = jury_opinions.jury_id WHERE jury_opinions.case_id=$this->caseId;");
        $this->caseDescription = DAO::getInstance()->query("SELECT description FROM `case` WHERE case_id = $this->caseId");
    }
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }


}