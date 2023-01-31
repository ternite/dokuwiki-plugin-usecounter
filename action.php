<?php
/**
 * Plugin usecounter
 */

if (!defined('DOKU_INC')) {
    die();
}
if (!defined('DOKU_PLUGIN')) {
    define('DOKU_PLUGIN', DOKU_INC.'lib/plugins/');
}
require_once(DOKU_PLUGIN.'action.php');

class action_plugin_usecounter extends DokuWiki_Action_Plugin {

    /* @var helper_plugin_fields $helper */
    var $helper = null;

    function __construct() {
        $this->helper = plugin_load('helper','usecounter');
    }
    public function register(Doku_Event_Handler $controller) {
        $controller->register_hook('RENDERER_CONTENT_POSTPROCESS', 'AFTER', $this, '_resetUseCounter');
    }
  
    public function _resetUseCounter(&$event, $param) {
        $this->helper->resetUseCounter();
	}
}
