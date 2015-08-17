<?php

class PluginRatingbonus_ModuleRatingbonus_MapperRatingbonus extends Mapper
{

	
	function AddBonus($iUserId,$sBonusTag){

        $sql = "INSERT INTO
                    " .Config::Get('plugin.ratingbonus.db.table.bonus_unlocked') . "
                (
                 user_id,
                 bonus_tag
                )
                VALUES
                    (?d, ?)
		";
        if ($iId = $this->oDb->query($sql,$iUserId,$sBonusTag)) {
            return $iId;
        }
        return false;
    		
	}
	
	function CheckBonus($iUserId,$sBonusTag){
			$sql = "SELECT 
						COUNT(*) as count				 
					FROM 
						".Config::Get('plugin.ratingbonus.db.table.bonus_unlocked')."	
					WHERE 
						user_id = ?d AND bonus_tag =?			
				";
				
				$iCount = 0;
				if ($aRows=$this->oDb->select($sql,$iUserId,$sBonusTag)) {
					foreach ($aRows as $aRow) {
						$iCount=$aRow['count'];
					}
				}
	
				return $iCount;		
	}	
}

?>
