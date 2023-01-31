<?php

use dokuwiki\Utf8\PhpString;

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Thomas Schäfer <thomas@hilbershome.de>
 */

class helper_plugin_usecounter extends DokuWiki_Plugin {
    
    protected $counterArray;
    
    public function __construct() {
        $this->counterArray = array();
    }
    
    /**
     * This helper should be kept singular throughout the whole run.
     */
    public function isSingleton() {
        return true;
    }

    public function getMethods()
    {
        $result = [];
        $result[] = [
            'name' => 'incUsageOf',
            'desc' => 'Indicates that the object with the given identifier is used (once more).',
            'params' => array(
                'id' => 'string',
				),
        ];
        $result[] = [
            'name' => 'amountOfUses',
            'desc' => 'Returns the amount of registered uses of this object.',
            'params' => array(
                'id' => 'string',
				),
            'return' => ['amount' => 'string'],
        ];
        $result[] = [
            'name' => 'resetUseCounter',
            'desc' => 'Resets the counter.',
        ];
        return $result;
    }
    
    /**
      * Indicates that the object with the given identifier is used (once more).
      *
      * @param string $id The identifier/key name of the object.
      */
    public function incUsageOf(string $id) {
        
        // Its important to keep using "amountOfUses" here in order to ensure
        // initialization of the array entry for this $id!
        $this->counterArray[$id] = $this->amountOfUses($id) + 1;
    }
    
    /**
      * Returns the amount of registered uses of this object.
      *
      * @param string $id The identifier/key name of the object.
      *
      * @return The amount of uses that were registered via incUsageOf().
      */
    public function amountOfUses(string $id) {
        if (!array_key_exists($id, $this->counterArray)) {
            $this->counterArray[$id] = 0;
        }

        return $this->counterArray[$id];
    }
    
    /**
      * Resets the counter. This method is supposed to be called
      * automatically by this plugin's action module.
      */
    public function resetUseCounter() {
        $this->counterArray = array();
    }
}
