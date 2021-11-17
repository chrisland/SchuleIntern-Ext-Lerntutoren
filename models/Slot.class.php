<?php
/**
 *
 */
class extLerntutorenModelSlot
{

    /**
     * @var data []
     */
    private $data = [];

    private $schueler = false;


    /**
     * Constructor
     * @param $data
     */
    public function __construct($data = false)
    {
        if (!$data) {
            $data = $this->data;
        }
        $this->setData($data);
    }

    /**
     * @return data
     */
    public function setData($data = [])
    {
        $this->data = $data;
        return $this->getData();
    }

    /**
     * @return data
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Getter
     */
    public function getID() {
        return $this->data['slotID'];
    }
    public function getStatus() {
        return $this->data['slotStatus'];
    }
    public function getEinheiten() {
        return $this->data['slotEinheiten'];
    }
    public function getTimeCreated() {
        return $this->data['slotCreated'];
    }
    public function getDatum() {
        return $this->data['slotDatum'];
    }
    public function getDauer() {
        return $this->data['slotDauer'];
    }
    public function getInfo() {
        return $this->data['slotInfo'];
    }

    public function getSchueler () {
        if (!$this->schueler && $this->data['slotSchuelerAsvID']) {
            $this->schueler = user::getByAsvID($this->data['slotSchuelerAsvID']);
        }
        return $this->schueler;
    }

    public function isStatusFinish () {
        if ( $this->getStatus() == 'close' ) {
            return true;
        }
        return false;
    }

    public function setStatusClose () {

        if ( $this->getID() ) {
            if ( DB::getDB()->query("UPDATE tutoren_slots SET slotStatus='close', slotInfo='(Systemnachricht) Lerntutor beendet' WHERE slotID=".$this->getID() ) ) {
                return true;
            }
        }
        return false;
    }

    public function getCollection() {
        $collection = [
            "id" => $this->getID(),
            "status" => $this->getStatus(),
            "einheiten" => $this->getEinheiten(),
            "info" => $this->getInfo(),
            "timeCreated" => $this->getTimeCreated(),
            "user" => $this->getSchueler()->getCollection()
        ];
        return $collection;
    }

}