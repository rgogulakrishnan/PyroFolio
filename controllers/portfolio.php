<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * Portfolio Module
 *
 * @author		Gogula Krishnan Rajaprabhu
 * @package		Netpines
 * @subpackage	Portfolio Module
 * @category	Modules
 * @website		http://netpines.com
 */

class Portfolio extends Public_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->lang->load('portfolio');
		$this->load->model('portfolio/portfolio_m');

		$this->template
			->append_css('module::portfolio.css')
            ->append_js('module::jquery.quicksand.js')
            ->append_js('module::portfolio.js');
	}

	public function _remap($method)
    {
        if($method == 'index')
        {
            $projects = $this->portfolio_m->get_projects();

            $this->template
                ->title($this->module_details['name'])
                ->set('projects', $projects)
                ->build('index');
        }
        else
        {
            if ( ! $method or ! $project = $this->portfolio_m->get_by('slug', $method) )
            {
                redirect('portfolio');
            }

            $this->template
                ->title($project->title)
                ->set_metadata('description', $project->overview1)
                ->set_metadata('keywords', lang('portfolio.keywords'))
                ->set('project', $project)
                ->build('view');
        }
    }
}