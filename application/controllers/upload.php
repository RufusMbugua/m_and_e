<?php

class Upload extends CI_Controller{
  public $excel;
  /**
  * [__construct description]
  */
  public function __construct()
  {
    parent::__construct();
    // $this->excel = new PHPExcel();
  }

  function index(){

  }
  public function read($activesheet = 0, $insert_table,$field,$value) {
    //convert .slk file to xlsx for upload

    //get activity ID

    $type = "";
    $start = 1;
    $config['upload_path'] = '././uploads/';
    $config['allowed_types'] = 'csv';
    $config['max_size'] = '1000000000';
    $this->load->library('upload', $config);

    //die();
    $file_1 = "upload_button";
    //print_r($_FILES);die;
    if ($type == 'slk') {

      //$edata = new Spreadsheet_Excel_Reader();

      // Set output Encoding.
      //$edata -> setOutputEncoding("CP1251");

      if ($_FILES['file_1']['tmp_name']) {
        $excelReader = PHPExcel_IOFactory::createReader('Excel2007');
        $excelReader->setReadDataOnly(true);
        $objPHPExcel = PHPExcel_IOFactory::load($_FILES['file_1']['tmp_name']);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
      }

      $objPHPExcel = PHPExcel_IOFactory::load(str_replace('.php', '.xlsx', __FILE__));
    } else {
      $objPHPExcel = PHPExcel_IOFactory::load($_FILES['file_1']['tmp_name']);
    }

    $sheetCount = $objPHPExcel->getSheetCount();

    $objReader = new PHPExcel_Reader_Excel5();
    $sheetName[0] = '';
    if ($sheetCount > 1) {
      $sheetName = $objReader->listWorksheetNames($_FILES['file_1']['tmp_name']);
    }
    // print_r( $sheetName);die;
    for ($x = 0; $x < $sheetCount; $x++) {

      $arr = $objPHPExcel->setActiveSheetIndex($x)->toArray(null, true, true, true);
      $highestColumm = $objPHPExcel->setActiveSheetIndex($x)->getHighestColumn();
      $highestRow = $objPHPExcel->setActiveSheetIndex($x)->getHighestRow();
      $data = array();
      $mytab = "";

      //echo $highestColumm;
      $data = $this->getData($arr, $start, $highestColumm, $highestRow);

      // echo '<pre>';print_r($data);echo '</pre>';die;
      //$data =json_encode($data);
      //echo($data);die;
      $data = $this->formatData($data);

      // echo '<pre>';print_r($data);echo '</pre>';die;

      //$this -> createTables();
      // echo $field. ' '.$value; die
      $this->createAndSetProperties($data, $insert_table,$sheetName[$x],$field,$value);

      //echo $activity_id;die;
      // $data = $this->makeTable($data);
    }
    $dataArr['uploaded'] = $data;

    $dataArr['posted'] = 1;
    $dataArr['contentView'] = 'upload/upload_v';
  }

  /**
  * [createAndSetProperties description]
  * @param [type] $data         [description]
  * @param [type] $insert_table [description]
  * @param string $source       [description]
  * @param [type] $field        [description]
  * @param [type] $value        [description]
  */
  public function createAndSetProperties($data, $insert_table, $source = '',$field,$value) {
    $dataTables = array($insert_table);
    $title = $data['title'];
    // echo '<pre>';print_r()
    //add to title
    $title[] = 'UPLOAD DATE';
    $rowCounter = 0;
    $tableObj = array();
    foreach ($dataTables as $table) {

      foreach ($data['data'] as $data1) {
        R::ext('xdispense', function($type){
          return R::getRedBean()->dispense( $type);
        });
        // echo '<pre>';print_r($data1);echo '</pre>';die;
        // echo $field.' '.$value;die;
        $currentTable = R::findOne($table,$field.'=?',array($data1[$value]));
        if(!$currentTable){
          $currentTable = R::xdispense($table);
        }
        //convert date to timestamp
        $data1 = $this->formatDate($data1, 'DATES');

        //set update time
        $data1['UPLOAD DATE'] = time();

        $data1['MOBILE NUMBER'] = $this->clean('phone_number',$data1['MOBILE NUMBER']);

        // $data1 = $this->addIfNotExists($data1, 'cadre', 'cadre_name', 'CADRE', 'cadre_id');

        //link FacilityName to MFC

        //remove excess columns
        // unset($data1['county']);
        // unset($data1['district']);
        foreach ($title as $val) {
          $valN = strtolower($val);
          $valN = str_replace("/", " ", $valN);
          $valN = str_replace("-", " ", $valN);
          $valN = str_replace(" ", "_", $valN);

          if (array_key_exists($val, $data1)) {
            $currentTable->setAttr($valN, $data1[$val]);
          }
        }

        R::store($currentTable);
      }
    }
  }
  /**
  * [formatData description]
  * @param [type] $data [description]
  */
  public function formatData($data) {
    $rows = array();

    //var_dump($data);
    foreach ($data as $key => $value) {

      //echo sizeof($value);
      $title[] = $key;

      //$rowCounter = 0;
      for ($rowCounter = 1; $rowCounter < sizeof($value); $rowCounter++) {
        if ($value[$rowCounter] != NULL) {
          $rows['data'][$rowCounter][$key] = $value[$rowCounter];
        }
      }
    }

    //echo
    $rows['title'] = $title;

    return $rows;
  }

  /**
  * [getData description]
  * @param [type] $arr           [description]
  * @param [type] $start         [description]
  * @param [type] $highestColumn [description]
  * @param [type] $highestRow    [description]
  */
  public function getData($arr, $start, $highestColumn, $highestRow) {

    //possible columns
    for ($col = $start; $col < PHPExcel_Cell::columnIndexFromString($highestColumn) + 1; $col++) {

      for ($row = $start; $row <= $highestRow; $row++) {
        $colString = PHPExcel_Cell::stringFromColumnIndex($col - 1);
        $title = $arr[$start][$colString];
        if ($title != " ") {

          //fields you want to save in DB
          $data[$title][] = $arr[$row][$colString];
        }
      }
    }

    return $data;
  }

  /**
  * [clean description]
  * @param  [type] $field  [description]
  * @param  [type] $string [description]
  * @return [type]         [description]
  */
  public function clean($field,$string){
    switch($field){
      case 'phone_number':
      $string = str_replace('O',0,$string);
      $string = str_replace(' – ','',$string);
      $string = str_replace(' ','',$string);
      $string = str_replace('-','',$string);
      break;
    }
    return $string;
  }

  /**
  * [upload description]
  * @return [type] [description]
  */
  public function upload(){
    $this->read(0,'hcwlist','id_number','id_number');
  }
}
