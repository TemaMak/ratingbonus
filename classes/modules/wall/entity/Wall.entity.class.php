<?php
/*-------------------------------------------------------
*
*   LiveStreet Engine Social Networking
*   Copyright © 2008 Mzhelskiy Maxim
*
*--------------------------------------------------------
*
*   Official site: www.livestreet.ru
*   Contact e-mail: rus.engine@gmail.com
*
*   GNU General Public License, version 2:
*   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
---------------------------------------------------------
*/

/**
 * Сущность записи на стене
 *
 * @package modules.wall
 * @since 1.0
 */
class PluginRatingbonus_ModuleWall_EntityWall extends PluginRatingbonus_Inherit_ModuleWall_EntityWall{

	public function Init() {
		parent::Init();

		$this->aValidateRules[] = array(
			'user_id',
			'create_limit',
			'on'=>array('add')
		);
	}

	public function ValidateCreateLimit($sValue,$aParams) {
		$dMinRating = Config::Get('plugin.ratingbonus.acl.create.wall.limit_rating');
		if($dMinRating){
			if ($oCurrentUser=$this->User_GetUserById($this->getUserId())) {
				$dRating =  $oCurrentUser->GetRating();					
				if($dRating > $dMinRating){
					return true;
				}
			}
			return $this->Lang_Get('plugin.ratingbonus.wall_create_limit');			
		}
		return true;
	}

}
?>