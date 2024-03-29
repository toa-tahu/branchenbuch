<?php
//=========================================
// File		: ADMIN.class.php
// Version	: 0.5
// Author	: neoterix, Matthias Franke
//=========================================

class ADMIN extends Smarty {
	
	function ADMIN(){
		$this->Smarty();
	}
	
	function admin_pager($res){
		$ad['res']=$res;
		$ad['max']=MAX_ADMIN_LIST;
		$ad['all']=count($res);
		$ad['steps']=ceil($ad['all']/$ad['max']);
		$ad['start']=$ad['max']*$_GET['pages'];
		$ad['pages']=$_GET['pages'];
		return $ad;
	}
	
	function set_new_sort($data){
		$res=$GLOBALS['dbapi']->GetFields($data['table']);
		if($res==false) return false;
		if(!$res[$data['field']]) return false;
		if(!$res['sort_field']) return false;
		
		$res=$GLOBALS['dbapi']->UpdateSortFields($data);
		if($res==false) return false;
		
		$res=$GLOBALS['dbapi']->GetSortFields($data);
		if($res==false) return false;
				
		$data=array_merge((array)$data,array('sort_field'=>$res['sort_field']));
		
		if($data['new_sort']=="top"){
			$res=$GLOBALS['dbapi']->GetSortFieldsToTop($data);
		} else {
			$res=$GLOBALS['dbapi']->GetSortFieldsToBottom($data);
		}
		if(empty($res['sort_id'])) return false;
		
		$res_new=$GLOBALS['dbapi']->GetSortFields(array('table'=>$data['table'],'field'=>$data['field'],'sort_id'=>$res['sort_id']));
		if($res_new==false) return false;

		$db=&DB::connect(DB_DSN);
		$db->query("update ".$data['table']." set sort_field=".$res_new['sort_field']." where ".$data['field']."='".$data['sort_id']."'");
		$db->query("update ".$data['table']." set sort_field=".$data['sort_field']." where ".$data['field']."='".$res['sort_id']."'");
		
	}
	
	####################################
	# �bersicht
	####################################
	
	function get_overview($page){
		
		$this->assign("count_private_all",$GLOBALS['dbapi']->get_admin_overview_private());
		
		$this->assign("count_branchen_all",$GLOBALS['dbapi']->get_admin_overview_branchen());
		$this->assign("count_branchen_day",$GLOBALS['dbapi']->get_admin_overview_branchen("where indate like '".date('Y-m-d')."%'")); // Filter 1
		$this->assign("count_branchen_activ",$GLOBALS['dbapi']->get_admin_overview_branchen("where aktiv=1")); // Filter 2
		$this->assign("count_branchen_deactiv",$GLOBALS['dbapi']->get_admin_overview_branchen("where aktiv!=1")); // Filter 3
		$this->assign("count_branchen_type_1",$GLOBALS['dbapi']->get_admin_overview_branchen("where eintr_art='s'")); // Filter 4
		$this->assign("count_branchen_type_2",$GLOBALS['dbapi']->get_admin_overview_branchen("where eintr_art='p'")); // Filter 5
		
		$this->assign("count_affili_all",$GLOBALS['dbapi']->get_admin_overview_affili());
		
		$this->assign("url",rebuildUrl());
		return $this->fetch(TPL_ADMIN_OVERVIEW);
	}
	
	####################################
	# Branche
	####################################
	
	function get_branche($page){		
		$this->assign("url",rebuildUrl());
		
		switch ($page['sub_page_id']){
			
			case SUB_PAGE_ID_ADMIN_BRANCHE_ALL:
			#pDebug($page);
			$this->assign('laender_dd', DBApi::get_orte(-1));
			if(!empty($_GET['bl'])){
				$this->assign('orte_dd', DBApi::get_orte($_GET['bl']));
			}
			
			$branchen=DBApi::get_branchen_neu(-1);
			$all_branchen=array();
			foreach ($branchen as $id => $value){
				$value = htmlentities(utf8_encode($value));
				$all_branchen[$id]=$value;
				$sub_branchen=DBApi::get_branchen_neu($id);
				if(!empty($sub_branchen)){
					$csub=0;
					foreach ($sub_branchen as $sid => $svalue){
						$svalue = htmlentities(utf8_encode($svalue));
						$csub++;
						if(count($sub_branchen)>$csub){
							$all_branchen[$sid]="&nbsp; &nbsp; &#x251C; ".$svalue;
						} else {
							$all_branchen[$sid]="&nbsp; &nbsp; &#x2514; ".$svalue;
						}
					}
				}
				
			}
			$this->assign('branchen_dd', $all_branchen);
			if(!empty($_GET['q']) || (!empty($_GET['bl']) && !empty($_GET['branche']))){
				if ($GLOBALS["resetpages"]) {
					$varPages = 0;
				} else {
					$varPages = $_GET["pages"];
				}
				list($count, $res) = DBApi::db_search_neu2($_GET['q'], NULL, $_GET['branche'], $_GET['bl'], $_GET['ort'], $_GET['c'], $varPages);
				
				$this->assign('res', $res);
				$this->assign('count', $count);
				$this->assign('pager_url', rebuildUrl(false, array('pages' => null, 'c' => $count)));
				
			} else {
				if(empty($_GET['id'])) {
					if(empty($_GET['knr'])) {						
						list($count, $res) = DBApi::get_kunden($_GET['pages']);
						$this->assign('res', $res);
						$this->assign('count', $count);
						$this->assign('pager_url', rebuildUrl(false, array('pages' => null, 'c' => $count)));
					} else {
						if(strlen($_GET['knr'])>7)
							$res = DBApi::get_member_by_firma($_GET['knr']);
						else
							$res = DBApi::get_member($_GET['knr']);
						$this->assign('res', array($res));
						$this->assign('count', $count);
						$this->assign('pager_url', rebuildUrl(false, array('pages' => null, 'c' => $count)));
					}
				}
			}
			
			if(!empty($_GET['id'])){
				
				$db=&DB::connect(DB_DSN);
				$orte = $db->getAssoc("SELECT id, name FROM `laender` ORDER BY name ASC");
				$all_orte=array();
				foreach ($orte as $id => $value){
					$value = htmlentities(utf8_encode($value));
					$all_orte[$id]=$value;
					$sub_orte=DBApi::get_orte_neu($id);
					if(!empty($sub_orte)){
						$csub=0;
						foreach ($sub_orte as $sid => $svalue){
							$svalue = htmlentities(utf8_encode($svalue));
							$csub++;
							if(count($sub_orte)>$csub){
								$all_orte[$sid]="&nbsp; &nbsp; &#x251C; ".$svalue;
							} else {
								$all_orte[$sid]="&nbsp; &nbsp; &#x2514; ".$svalue;
							}
						}
					}
					
				}
				
				
				$member = DBApi::get_member_by_firma($_GET['id']);
				if($member) {
					$branchen = DBApi::get_member_branchen_neu($_GET['id']);
					$orte = DBApi::get_member_laender_neu($_GET['id']);
					
					$res=DBApi::get_member_ort_neu($_GET['id']);
					
					if(empty($_GET['branche'])) $_GET['branche']=$branchen[0];
					//if(empty($_GET['bl'])) $_GET['bl']=$orte[0];
					
					
					$this->assign('branchen', $branchen);
					$this->assign('orte', $orte);
					$this->assign('member', $member);
				}
				
				
				
				$this->assign('laender_dd', $all_orte);
				$this->assign('branchen', array_reverse(DBApi::get_member_branchen_neu($member['id'])));
				$this->assign('laender', DBApi::get_member_laender_neu($member['id']));
				$this->assign('res', $member);
			}
			
			$this->assign("produkte", DBApi::get_produkte());
			return $this->fetch(TPL_ADMIN_BRANCHE_ALL);
			break;
		}
	}
	
	####################################
	# Private
	####################################
	
	function get_private($page){
		$this->assign("url",rebuildUrl());
		switch ($page['sub_page_id']){
			
			case SUB_PAGE_ID_ADMIN_PRIVATE_ALL:
			if($_GET['search'] && (!empty($_GET['q']) || !empty($_GET['refid']))){
				//list($count, $res) = DBApi::db_telefonbuch2($_GET['q'], $_GET['bl'], $_GET['str'], $_GET['plz'], $_GET['ort'], $_GET['pages']);
				list($count, $res) = DBApi::db_telefonbuch_admin($_GET['q'], $_GET['bl'], $_GET['str'], $_GET['plz'], $_GET['ort'], $_GET['refid'], $_GET['pages']);
	    			$this->assign('count', $count);
	   			$this->assign('res', $res);
			}
			return $this->fetch(TPL_ADMIN_PRIVATE_ALL);
			break;
		}
	}

	####################################
	# Rechnungen
	####################################
	
	function get_pay($page){
		$this->assign("url",rebuildUrl());
		switch ($page['sub_page_id']){
			
			case SUB_PAGE_ID_ADMIN_PAY_ALL:
			$this->assign('new',$_GET['new']);
			if($_GET['search']){
				$this->assign($this->admin_pager($GLOBALS['dbapi']->search_admin_pay($_GET['q'])));
			} else {
				if(!$_GET['new']) $this->assign($this->admin_pager($GLOBALS['dbapi']->get_admin_pay($_GET['id'])));
			}
			return $this->fetch(TPL_ADMIN_PAY_ALL);
			break;
		}
	}
	
	####################################
	# Werbung
	####################################
	
	function get_affili($page){
		$this->assign("url",rebuildUrl());
		switch ($page['sub_page_id']){
			
			case SUB_PAGE_ID_ADMIN_AFFILI_ALL:
			$this->assign('new',$_GET['new']);
			if($_GET['search']){
				$this->assign($this->admin_pager($GLOBALS['dbapi']->search_admin_affili($_GET['q'])));
			} else {
				if(!$_GET['new']) $this->assign($this->admin_pager($GLOBALS['dbapi']->get_admin_affili($_GET['id'])));
			}
			return $this->fetch(TPL_ADMIN_AFFILI_ALL);
			break;
		}
	}
			
	####################################
	# Admin-User
	####################################
	
	function get_user($page){
		$this->assign("url",rebuildUrl());
		switch ($page['sub_page_id']){
			
			case SUB_PAGE_ID_ADMIN_USER_ALL:
			$this->assign('new',$_GET['new']);
			if($_GET['search']){
				$this->assign($this->admin_pager($GLOBALS['dbapi']->search_admin_user($_GET['q'])));
			} else {
				if(!$_GET['new']) $this->assign($this->admin_pager($GLOBALS['dbapi']->get_admin_user($_GET['id'])));
			}
			return $this->fetch(TPL_ADMIN_USER_ALL);
			break;
		}
	}
	
	####################################
	# Mail Vorlagen
	####################################
	
	function get_mailtpl($page){
		$this->assign("url",rebuildUrl());
		switch ($page['sub_page_id']){
			
			case SUB_PAGE_ID_ADMIN_MAIL_TPL_ALL:
			$this->assign('new',$_GET['new']);
			if($_GET['search']){
				$this->assign($this->admin_pager($GLOBALS['dbapi']->search_admin_mailtpl($_GET['q'])));
			} else {
				if(!$_GET['new']) $this->assign($this->admin_pager($GLOBALS['dbapi']->get_admin_mailtpl($_GET['id'])));
			}
			return $this->fetch(TPL_ADMIN_MAILTPL_ALL);
			break;
		}
	}
	
	####################################
	# CMS
	####################################
	
	function get_cms($page){
		$this->assign("url",rebuildUrl());
		switch ($page['sub_page_id']){
			
			case SUB_PAGE_ID_ADMIN_CMS_ALL:
			$this->assign('new',$_GET['new']);
			if($_GET['search']){
				$this->assign($this->admin_pager($GLOBALS['dbapi']->search_admin_cms($_GET['q'])));
			} else {
				if(!$_GET['new']){
					if(!empty($_GET['history_id'])){
						$this->assign($this->admin_pager($GLOBALS['dbapi']->get_cms_history_by_id($_GET['history_id'])));
					} else {
						$this->assign($this->admin_pager($GLOBALS['dbapi']->get_admin_cms($_GET['cms_category'],$_GET['id'])));
					}
					$this->assign('history',$GLOBALS['dbapi']->get_cms_history($_GET['id']));
				}
			}
			return $this->fetch(TPL_ADMIN_CMS_ALL);
			break;
			
			case SUB_PAGE_ID_ADMIN_CMS_LIVE_1:
			return $this->fetch(TPL_ADMIN_CMS_LIVE_1);
			break;
		}
	}	
}

?>