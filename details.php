<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Portfolio Module
 *
 * @author		Gogula Krishnan Rajaprabhu
 * @package		Netpines
 * @subpackage	Portfolio Module
 * @category	Modules
 * @website		http://netpines.com
 */

class Module_Portfolio extends Module {

	public $version = '0.3';
	public $db_pre;

	public function __construct()
	{	
		$this->load->dbforge();
		if(CMS_VERSION >= 1.3) $this->db_pre = SITE_REF.'_';
	}

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Portfolio'
			),
			'description' => array(
				'en' => 'Showcase your projects'
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu' => 'content',
			'roles' => array(
				'put_live', 'edit_live', 'delete_live'
			),
			'shortcuts' => array(
				array(
			 	   'name' => 'portfolio.add_project',
				    'uri' => 'admin/portfolio/add',
				),
			),
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('portfolio');

		$sql = "
			CREATE TABLE IF NOT EXISTS `{$this->db_pre}portfolio` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`title` varchar(100) collate utf8_unicode_ci NOT NULL default '',
				`slug` varchar(100) collate utf8_unicode_ci NOT NULL default '',
				`category` varchar(30) collate utf8_unicode_ci NOT NULL default '',
				`services` varchar(150) collate utf8_unicode_ci NOT NULL default '',
				`delivered_month` varchar(15) collate utf8_unicode_ci NOT NULL default '',
				`delivered_year` int(11) NOT NULL default 0,
				`thumb` varchar(60) collate utf8_unicode_ci NOT NULL default '',
				`refurl` varchar(300) collate utf8_unicode_ci NOT NULL default '',
				`status` ENUM( 'Draft', 'Live' ) collate utf8_unicode_ci NOT NULL DEFAULT 'Draft',
				`overview1` text collate utf8_unicode_ci NOT NULL,
				`overview2` text collate utf8_unicode_ci NOT NULL,
				`screenshots` text collate utf8_unicode_ci NOT NULL,
				`when_added` int(11) NOT NULL default 0,
				`last_updated` int(11) NOT NULL default 0,
				`added_by` int(11) NOT NULL default '0',
				PRIMARY KEY (`id`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";	

		return $this->db->query($sql);	
	}

	public function uninstall()
	{
		return $this->dbforge->drop_table('portfolio');
	}


	public function upgrade($old_version)
	{
		// No support as of now.
		return TRUE;
	}

	public function help()
	{
		return "A simple portfolio module to showcase the projects. Explore the sections and it's self explanatory!";
	}
}
/* End of file details.php */
