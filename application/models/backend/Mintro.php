<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mintro extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('intro');
	}


}
