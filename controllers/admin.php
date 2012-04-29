<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Portfolio Module
 *
 * @author		Gogula Krishnan Rajaprabhu
 * @package		Netpines
 * @subpackage	Portfolio Module
 * @category	Modules
 * @website		http://netpines.com
 */

class Admin extends Admin_Controller 
{
	/**
	 * Array that contains the validation rules
	 * @access protected
	 * @var array
	 */
	protected $validation_rules = array(
		'title' => array(
			'field' => 'title',
			'label' => 'lang:portfolio.project_label',
			'rules' => 'trim|htmlspecialchars|required|max_length[100]'
		),
		'slug' => array(
			'field' => 'slug',
			'label' => 'lang:portfolio.slug_label',
			'rules' => 'trim|required|alpha_dot_dash|max_length[100]'
		),
		'category' => array(
			'field' => 'category',
			'label' => 'lang:portfolio.category_label',
			'rules' => 'trim|htmlspecialchars|required|max_length[30]'
		),
		'services' => array(
			'field' => 'services',
			'label' => 'lang:portfolio.services_label',
			'rules' => 'trim|htmlspecialchars|required|max_length[150]'
		),
		'thumb' => array(
			'field' => 'thumb',
			'label' => 'lang:portfolio.thumb_label',
			'rules' => 'trim|required|max_length[60]'
		),
		'refurl' => array(
			'field' => 'refurl',
			'label' => 'lang:portfolio.refurl_label',
			'rules' => 'trim'
		),
		'overview1' => array(
			'field' => 'overview1',
			'label' => 'lang:portfolio.overview1_label',
			'rules' => 'trim|required'
		),
		'overview2' => array(
			'field' => 'overview2',
			'label' => 'lang:portfolio.overview2_label',
			'rules' => 'trim|required'
		),
		'screenshots' => array(
			'field' => 'screenshots',
			'label' => 'lang:portfolio.screenshots_label',
			'rules' => 'trim'
		),
		'delivered_month' => array(
			'field' => 'delivered_month',
			'label' => 'lang:portfolio.month_label',
			'rules' => 'trim|required'
		),
		'delivered_year' => array(
			'field' => 'delivered_year',
			'label' => 'lang:portfolio.year_label',
			'rules' => 'trim|required|integer|max_length[4]'
		),
		'status' => array(
			'field'	=> 'status',
			'label'	=> 'lang:portfolio.status_label',
			'rules'	=> 'trim|alpha|required'
		),
	);

	public function __construct() {
		
		parent::__construct();
		
		$this->lang->load('portfolio');
		$this->load->model('portfolio/portfolio_m');	

		$this->load->library('form_validation');
	}

	public function index() 
	{	
		$rows = $this->portfolio_m->count_all();
		$pagination = create_pagination('admin/portfolio/index', $rows);

		$projects = $this->portfolio_m->list_projects();

		$this->template
			->title($this->module_details['name'])
			->set('pagination', $pagination)
			->set('projects', $projects)
			->build('admin/index');
	}

	public function add($id = 0)
	{
		$created_on = now();
		$this->form_validation->set_rules($this->validation_rules);

		if ($this->form_validation->run()) 
		{
			if ($this->input->post('status') == 'live')
			{
				role_or_die('portfolio', 'put_live');
			}

			$id = $this->portfolio_m->insert(array(
				'title'				=> $this->input->post('title'),
				'slug'				=> $this->input->post('slug'),
				'category'			=> $this->input->post('category'),
				'services'			=> $this->input->post('services'),
				'thumb'				=> $this->input->post('thumb'),
				'refurl'			=> $this->input->post('refurl'),
				'overview1'			=> $this->input->post('overview1'),
				'overview2'			=> $this->input->post('overview2'),
				'screenshots'		=> $this->input->post('screenshots'),
				'delivered_month'	=> $this->input->post('delivered_month'),
				'delivered_year'	=> $this->input->post('delivered_year'),
				'status'			=> $this->input->post('status'),
				'when_added'		=> $created_on,
				'last_updated'		=> $created_on,
				'added_by'			=> $this->current_user->id
			));
			

			if ($id)
			{
				$this->session->set_flashdata('success', $this->lang->line('portfolio.add_success'));
			}
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('portfolio.add_error'));
			}

			$this->input->post('btnAction') == 'save_exit' ? redirect('admin/portfolio') : redirect('admin/portfolio/edit/' . $id);
		}
		else
		{
			foreach ($this->validation_rules as $key => $field)
			{
				$project->$field['field'] = set_value($field['field']);
			}
		} 	
		
		$this->template
			->title($this->module_details['name'])
			->append_js('module::portfolio.js')
			->set('project', $project)
			->build('admin/form'); 
	}

	public function edit($id = 0)
	{
		$id OR redirect('admin/portfolio');

		$project = $this->portfolio_m->get($id);
		$this->form_validation->set_rules($this->validation_rules);
		$created_on = $project->when_added;
		$updated_on = now();
		
		if ($this->form_validation->run())
		{
			if ($project->status != 'live' and $this->input->post('status') == 'live')
			{
				role_or_die('portfolio', 'put_live');
			}

			$result = $this->portfolio_m->update($id, array(
				'title'				=> $this->input->post('title'),
				'slug'				=> $this->input->post('slug'),
				'category'			=> $this->input->post('category'),
				'services'			=> $this->input->post('services'),
				'thumb'				=> $this->input->post('thumb'),
				'refurl'			=> $this->input->post('refurl'),
				'overview1'			=> $this->input->post('overview1'),
				'overview2'			=> $this->input->post('overview2'),
				'screenshots'		=> $this->input->post('screenshots'),
				'delivered_month'	=> $this->input->post('delivered_month'),
				'delivered_year'	=> $this->input->post('delivered_year'),
				'status'			=> $this->input->post('status'),
				'when_added'		=> $created_on,
				'last_updated'		=> $updated_on,
				'added_by'			=> $this->current_user->id,
			));
			
			if ($result)
			{
				$this->session->set_flashdata('success', $this->lang->line('portfolio.edit_success'));
			}
			
			else
			{
				$this->session->set_flashdata('error', $this->lang->line('portfolio.edit_error'));
			}

			$this->input->post('btnAction') == 'save_exit' ? redirect('admin/portfolio') : redirect('admin/portfolio/edit/' . $id);
		}

		foreach ($this->validation_rules as $key => $field)
		{
			if (isset($_POST[$field['field']]))
			{
				$project->$field['field'] = set_value($field['field']);
			}
		}
		
		$this->template
			->title($this->module_details['name'])
			->append_js('module::portfolio.js')
			->set('project', $project)
			->build('admin/form');
	}

	public function delete($id = 0)
	{
		$id OR redirect('admin/portfolio');

		if($this->portfolio_m->delete($id))
		{
			$this->session->set_flashdata('success', $this->lang->line('portfolio.delete_success'));
		} 
		else
		{
			$this->session->set_flashdata('error', $this->lang->line('portfolio.delete_error'));
		}

		redirect('admin/portfolio');
	}

} /* end admin class */