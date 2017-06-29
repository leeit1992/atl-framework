<?php

namespace Atl\Validation;

use Sirius\Validation\Validator as SiriusValidation;
use Sirius\Validation\ErrorMessage;

/**
 * Validate form data.
 */

class Validation extends SiriusValidation{

	/**
	 * Handle get label errors
	 * 
	 * @return array
	 */
	public function getAllErrors(){
		$getMessages = $this->getMessages();
		$argsErrors  = array();

		foreach ($getMessages as $getVariables) {
			foreach ($getVariables as  $messages) {
			
				$renderMes = new ErrorMessage( $messages->getTemplate(), $messages->getVariables() );
				
				ob_start();
				print ($renderMes);
				$renderMes = ob_get_clean();

				$argsErrors[] = $renderMes;
			}
		}

		return $argsErrors;
	}
}