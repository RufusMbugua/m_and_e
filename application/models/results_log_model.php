<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use models\Entities\ResultsLog;

class Results_Log_Model extends MY_Model{


  /**
  * Get all Links for About Page
  */
  public function addResults($data){

    $batchSize = 20;
    for ($i = 1; $i <= sizeof($data); ++$i) {
      $ResultsLog = new ResultsLog();

      $ResultsLog->setResponse();
      $ResultsLog->setAssessee();
      $ResultsLog->setQuestion();

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
