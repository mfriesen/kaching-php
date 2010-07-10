<?php
/**
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright KACHINGPHP.ORG 2010
 * @link          http://www.kachingphp.org Kaching Project
 * @package       kaching
 * @subpackage    kaching.controllers.components
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Croogo Hook Component
 *
 * @author   Mike Friesen
 */
class KachingHookComponent extends Object {

	/**
	 * Called after activating the hook in ExtensionsHooksController
	 */
	public function onActivate(&$controller) {
//		$controller->Croogo->addAco('Translate');
//		$controller->Croogo->addAco('Translate/admin_index');
//		$controller->Croogo->addAco('Translate/admin_edit');
//		$controller->Croogo->addAco('Translate/admin_delete');
	}
	
	/**
	 * Called after deactivating the hook in ExtensionsHooksController
	 */
	public function onDeactivate(&$controller) {
//		$controller->Croogo->removeAco('Translate');
	}
	
	/**
	 * Called after the Controller::beforeFilter() and before the controller action
	 */
	public function startup(&$controller) {
		/*
		foreach ($this->translateModels AS $translateModel => $fields) {
			if (isset($controller->{$translateModel})) {
				$controller->{$translateModel}->Behaviors->attach('CroogoTranslate', $fields);
			}
		}
		*/
	}
	
	/**
	 * Called after the Controller::beforeRender(), after the view class is loaded, and before the
	 * Controller::render()	 
	 */
	public function beforeRender(&$controller) {
		/*
		$modelAliases = array_keys($this->translateModels);
		$singularCamelizedControllerName = Inflector::camelize(Inflector::singularize($controller->params['controller']));
        if (in_array($singularCamelizedControllerName, $modelAliases)) {
            Configure::write('Admin.rowActions.Translations', 'plugin:translate/controller:translate/action:index/:id/'.$singularCamelizedControllerName);
        }*/
    }
}
?>