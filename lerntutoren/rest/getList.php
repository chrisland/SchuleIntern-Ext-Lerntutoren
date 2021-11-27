<?php

class getList extends AbstractRest {
	
	protected $statusCode = 200;


	public function execute($input, $request) {

        include_once PATH_EXTENSION . 'models' . DS . 'Slot.class.php';
        include_once PATH_EXTENSION . 'models' . DS . 'Tutoren.class.php';

        $ret = [];
        $items = extLerntutorenModelTutoren::getAllByStatus('open');

        foreach ($items as $item) {

            $data = [
                "id" => $item->getID(),
                "fach" => $item->getFach(),
                "jahrgang" => $item->getJahrgang(),
                "einheiten" => $item->getEinheiten(),
                "status" => $item->getStatus(),
                "user" => $item->getTutor()->getCollection(),
                "slots" => $item->getSlotsCollection(),
                "diff" => $item->getSlotsDiff()
            ];
            if ($data['diff'] > 0) {
                $ret[] = $data;
            }

        }


        /*
        echo '<pre>';
        print_r($items);
        echo '</pre>';
        exit;*/

        if (count($ret) > 0) {
            return $ret;
        }

        return [
            'error' => true,
            'msg' => 'Error'
        ];

	}


	/**
	 * Set Allowed Request Method
	 * (GET, POST, ...)
	 * 
	 * @return String
	 */
	public function getAllowedMethod() {
		return 'GET';
	}

    /**
     * Muss der Benutzer eingeloggt sein?
     * Ist Eine Session vorhanden
     * @return Boolean
     */
    public function needsUserAuth() {
        return true;
    }

	/**
	 * Ist eine System Authentifizierung nötig? (mit API key)
     * only if : needsUserAuth = false
	 * @return Boolean
	 */
	public function needsSystemAuth() {
		return true;
	}



}	

?>