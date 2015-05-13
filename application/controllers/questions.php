<?php
/**
* Questions Class
*/
class Questions extends CI_Controller{
  public function __construct()
  {
    parent::__construct();
  }

  public function get(){
    $data = $this->doctrine->em->createQuery("SELECT q,sb,c FROM models\Entities\Questions q JOIN subCategory sb")->getArrayResult();

    echo '<pre>';var_dump($data);
  }
}
