<?php

class extLerntutorenAdminCustom extends AbstractPage {
	
	public static function getSiteDisplayName() {
		return '<i class="fa fa-graduation-cap"></i> Verfügbare Lerntutoren - Admin';
	}

	public function __construct($request = [], $extension = []) {
		parent::__construct(array( self::getSiteDisplayName() ), false, false, false, $request, $extension);
		$this->checkLogin();
	}


	public function execute() {

		//$this->getRequest();
		//$this->getAcl();
		


        $this->render([
            "tmpl" => "custom",
            "scripts" => [
                PATH_EXTENSION.'tmpl/scripts/list/dist/main.js'
            ],
            "data" => [
                "apiURL" => "rest.php/lerntutoren"
            ]
        ]);

	}


}
