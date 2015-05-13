<?php

class Results_Log extends MY_Controller{

  /**
  * [__construct description]
  */
  function __construct(){
    parent::__construct();
    $this->load->model('results_log_model');
  }

  /**
  * [index_get description]
  * @return [type] [description]
  */
  public function index_get(){

  }

  /**
  * [index_post description]
  * @return [type] [description]
  */
  public function index_post(){
    $post_data = file_get_contents("php://input");
    $post_data = json_decode($post_data,true);
    $response = $this->results_log_model->addResults($post_data);

    $this->response($response);
  }
}
