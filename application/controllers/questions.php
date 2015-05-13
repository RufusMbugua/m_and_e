<?php
/**
* Questions Class
*/
class Questions extends MY_Controller{
  public function __construct()
  {
    parent::__construct();
  }

  public function index_get(){
    $data = $this->doctrine->em->createQuery("SELECT q,sb,c FROM models\Entities\Questions q JOIN q.subCategory sb JOIN sb.category c")->getArrayResult();
    $this->response($data);
  }
}
