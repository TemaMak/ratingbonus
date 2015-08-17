<?php

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attemp!');
}

class PluginRatingbonus extends Plugin {

	public $aInherits = array(
			'entity' => array(
				'ModuleWall_EntityWall'
			),
	);	
	
    public function Activate() {
      	if (!$this->isTableExists('prefix_bonus_unlocked')) {
    		$resutls = $this->ExportSQL(dirname(__FILE__) . '/install.sql');
    		return $resutls['result'];
    	}    	      
        return true;
    }

    public function Deactivate(){
    	return true;
    }

    public function Init() {
    }
}
?>
