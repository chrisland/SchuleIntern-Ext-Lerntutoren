<?php

class endSlot extends AbstractRest {
	
	protected $statusCode = 200;


	public function execute($input, $request) {

        //print_r($input);

        $itemID = (int)$input['id'];
        if (!$itemID) {
            return [
                'error' => true,
                'msg' => 'Missing ID'
            ];
        }

        $datum = $input['datum'] ? DB::getDB()->escapeString($input['datum']) : '';
        $dauer = $input['dauer'] ? DB::getDB()->escapeString($input['dauer']) : '';
        $info = $input['info'] ? DB::getDB()->escapeString($input['info']) : '';
        if ( DB::getDB()->query("UPDATE tutoren_slots SET 
                         slotDatum='" .$datum. "'
                         , slotDauer='" .$dauer. "'  
                         , slotInfo='" .$info. "'
                         , slotStatus='close'
                        WHERE slotID='" . $itemID . "'") ) {
            return [
                'error' => false
            ];
        }

		return [
			'error' => true,
			'msg' => 'Return Data!'
		];

	}


	/**
	 * Set Allowed Request Method
	 * (GET, POST, ...)
	 * 
	 * @return String
	 */
	public function getAllowedMethod() {
		return 'POST';
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