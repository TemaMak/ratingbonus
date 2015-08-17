<?php

class PluginRatingbonus_HookRatingbonus extends Hook {

    public function RegisterHook() {

    	$this->AddHook('action_shutdown_settings','ShutdownAddRating');
    	$this->AddHook('settings_profile_save_before','ProfileSaveSetting');    	
    	$this->AddHook('module_comment_addcomment_after','AddComment');
    	$this->AddHook('module_topic_addtopic_after','AddTopic');
    }
    
    public function ShutdownAddRating($aParams){    	
		$aBonuses = Config::Get('plugin.ratingbonus.action_bonus');
		
		$oCurrentUser = $this->User_GetUserCurrent();
		if (isset($oCurrentUser)){
			if (isset($aBonuses[Router::GetActionEvent()]) && isset($aBonuses[Router::GetActionEvent()][Router::GetActionEventName()])){
				$sTag = Router::GetActionEvent().'_'.Router::GetActionEventName();
				$oCurrentUser = $this->PluginRatingbonus_Ratingbonus_AddBonus($oCurrentUser,$sTag,$aBonuses[Router::GetActionEvent()][Router::GetActionEventName()]);
			}			
			$this->User_Update($oCurrentUser);
		}

    }
        
    public function ProfileSaveSetting($aParams){
    	$oUser = $aParams['oUser'];

    	$aBonuses = array();
    	$aBonusValues = Config::Get('plugin.ratingbonus.profile_bonus');
    	if ($oUser->getProfileName() && isset($aBonusValues['profile_name'])){    		    	    		
    		$aBonuses[] = array(
    			'tag' => 'profile_name',
    			'bonus_value' => $aBonusValues['profile_name'],
    		);
    	}

        if ($oUser->getProfileSex() != 'other' && isset($aBonusValues['profile_sex']) ){
        	$aBonuses[] = array(
    			'tag' => 'profile_sex',
    			'bonus_value' => $aBonusValues['profile_sex'],
    		);
    	}
    	
		if ($oUser->getProfileBirthday() && isset($aBonusValues['profile_birthday'])){
        	$aBonuses[] = array(
    			'tag' => 'profile_birthday',
    			'bonus_value' => $aBonusValues['profile_birthday'],
    		);			
    	}    	
    	
    	foreach ($aBonuses as $aBonus){
    	    if (isset($aBonus['tag']) && isset($aBonus['bonus_value'])){
    			$oUser = $this->PluginRatingbonus_Ratingbonus_AddBonus($oUser,$aBonus['tag'],$aBonus['bonus_value']);
    		}   		
    	}  
    	
    	$aParams['oUser'] = $oUser;
    }

    public function AddComment($aParams){
    	$bResult = $aParams['result'];
    	
    	if($bResult){
    		$dBonus = Config::Get('plugin.ratingbonus.additional_action.add_comment');
    		
    		$oCurrentUser = $this->User_GetUserCurrent();
    		if (isset($oCurrentUser) && isset($dBonus)){
				$oCurrentUser = $this->PluginRatingbonus_Ratingbonus_AddBonus(
					$oCurrentUser,
					PluginRatingbonus_ModuleRatingbonus::UN_UNIQ_TAG,
					$dBonus
				);
    			$this->User_Update($oCurrentUser);
    		}   		
    	}
    }
        
    public function AddTopic($aParams){
    	$bResult = $aParams['result'];
    	 
    	if($bResult){
    		$dBonus = Config::Get('plugin.ratingbonus.additional_action.add_topic');
    
    		$oCurrentUser = $this->User_GetUserCurrent();
    		if (isset($oCurrentUser) && isset($dBonus)){
    			$oCurrentUser = $this->PluginRatingbonus_Ratingbonus_AddBonus(
    					$oCurrentUser,
    					PluginRatingbonus_ModuleRatingbonus::UN_UNIQ_TAG,
    					$dBonus
    			);
    			$this->User_Update($oCurrentUser);
    		}
    	}
    }    
    
}
?>
