<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Portfolio Module
 *
 * @author		Gogula Krishnan Rajaprabhu
 * @package		Netpines
 * @subpackage	Portfolio Module
 * @category	Modules
 * @website		http://netpines.com
 */

class Portfolio_m extends MY_Model 
{
	protected $_table = 'portfolio';

	public function __construct()
	{		
		parent::__construct();
	}

	public function list_projects()
	{
		$this->db->select('portfolio.*, profiles.display_name')
			->join('profiles', 'profiles.user_id = portfolio.added_by', 'left');

		$this->db->order_by('id', 'desc');

		return $this->db->get('portfolio')->result();
	}

	public function get_projects()
	{
		$this->db->select('portfolio.*')
			->where(array('status' => 'Live'));

		$this->db->order_by('id', 'desc');

		return $this->db->get('portfolio')->result();
	}
}
