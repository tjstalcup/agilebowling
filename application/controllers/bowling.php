<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bowling extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function create()
	{
		$this->load->model('Bowling_model');

		$data['score'] = $this->Bowling_model->final_score($this->input->post(NULL, TRUE));
		$this->load->view('finished_game', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */