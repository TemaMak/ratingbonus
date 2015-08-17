<?php

class PluginRatingbonus_ModuleRatingbonus extends Module {

	const UN_UNIQ_TAG = '__un_uniq_tag__';
	
	public function Init() {
		$this->oMapperTopic=Engine::GetMapper(__CLASS__);
	}
	
	protected function CheckBonus($iUserId,$sTag){
		if($sTag == self::UN_UNIQ_TAG){
			return 0;
		}
		
		return $this->oMapperTopic->CheckBonus($iUserId,$sTag);
	}
	
	public function AddBonus($oUser,$sBonusTag,$iBonusValue){
		if ( $this->CheckBonus($oUser->getId(),$sBonusTag) == 0){
			if($sBonusTag != self::UN_UNIQ_TAG){
				$this->oMapperTopic->AddBonus($oUser->getId(),$sBonusTag);
			}
			
				        
		 	$fOldRating = $oUser->getRating();
		 	$fNewRating = $fOldRating + 1*$iBonusValue;
	        $oUser->setRating($fNewRating);	
			
	        //$this->User_Update($oUser);			
		}	

		return $oUser;
	}
}
?>
