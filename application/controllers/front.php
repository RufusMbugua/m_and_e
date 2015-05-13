<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

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

   public function __construct(){
     parent::__construct();
     $this->load->model('front_model');
   }

   public function index()
    {
        echo "<pre>";
        // print_r($this->doctrine->em);
            //the line above Prints the EntityManager created by Doctrine Library
            //with this line -> $this->em = EntityManager::create($connectionOptions, $config);
            echo "</pre>";

        // $this->load->view('welcome_message');
    }
}
