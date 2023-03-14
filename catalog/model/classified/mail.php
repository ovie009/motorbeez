<?php
class ModelclassifiedMail extends Model {
	
	public  function getMailInfo($type){
		$query=$this->db->query("select * from " . DB_PREFIX . "mail vm LEFT JOIN " . DB_PREFIX . "mail_language vml on(vm.mail_id=vml.mail_id) where vm.type='" .$type."'and vml.language_id = '" . (int)$this->config->get('config_language_id') . "' and vm.status=1");
		
		return $query->row;
		
	}
	
}
