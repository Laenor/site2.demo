<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');
		$data['header']=$this->load->view('header', NULL, TRUE);
		$data['nav']=$this->load->view('nav', NULL, TRUE);
		$data['page']=$this->load->view('liste', NULL, TRUE);
		$data['footer']=$this->load->view('footer', NULL, TRUE);

		$this->load->view('template',$data);
	}

	public function pagination(){
		$postData = $this->input->post();
		function date_sort($a, $b) {
			return strtotime($a['date_demande']) - strtotime($b['date_demande']);
		}
		usort($postData['data'], "date_sort");
		$reponse1=array();
		$reponse2=array();
		foreach ($postData['data'] as $postData['data']=> $demande){
			if ($postData['titre'] === '' || strpos($demande['titre_demande'],$postData['titre']) !== false) {
				$reponse1[] = $demande;
			}
		}
		for($i=($postData['page']-1)*$postData['itemPerPage'];$i<$postData['page']*$postData['itemPerPage'];$i++) {
			if (isset($reponse1[$i])) {
				$reponse1[$i]['budget_demande']=number_format((float)$reponse1[$i]['budget_demande'], 2, '.', '');
				$reponse1[$i]['date_demande']=date('d/m/Y',strtotime($reponse1[$i]['date_demande']));
				$reponse2[$i] = $reponse1[$i];
			}
		}
		echo json_encode(array($reponse2,sizeof($reponse1)));
	}
}
