<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use models\Entities\ResultsLog;
use models\Entities\Questions;

class Results_Log_Model extends MY_Model{


  /**
  * Get all Links for About Page
  */
  public function addResults($data){

    foreach ($data as $key => $value) {
      if($value){
        $question_code =$key;
        $response = $value['response'];

        $newArray[] = array('question_code'=>$question_code,'response'=>$response);
      }
    }


    $batchSize = 5;
    for ($i = 1; $i <= sizeof($newArray)-1; ++$i) {
      $ResultsLog = new ResultsLog();
      //       $Questions = $this->em->getRepository('models\Entities\Questions')->findOneBy(array('id'=>$newArray[$i]['question_code']));
      // echo '<pre>';var_dump($Questions);die;

      $ResultsLog->setResponse($newArray[$i]['response']);
      // $ResultsLog->setAssessee(1);
      // $ResultsLog->setQuestion($newArray[$i]['question_code']);

      $this->em->persist($ResultsLog);
      if (($i % $batchSize) === 0) {
        $this->em->flush();
        $this->em->clear(); // Detaches all objects from Doctrine!
      }
    }
    $this->em->flush(); //Persist objects that did not make up an entire batch
    $this->em->clear();

    return 'Done';
  }

}
