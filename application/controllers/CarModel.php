<?php
class CarModel extends CI_controller{

  function index(){
  $this->load->model('Car_model');
    $rows=$this->Car_model->all();
    $data['rows']=$rows;
    $this->load->view('car_models/list.php', $data);
  }
  function showCreateFrom()
  {
    $html = $this->load->view('car_models/create.php', '', true);
    $response['html'] = $html;
    echo json_encode($response);
  }
  function saveModel()
  {
    $this->load->model('Car_model');
    $this->load->library("form_validation");
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('color', 'Color', 'required');
    $this->form_validation->set_rules('price', 'Price', 'required');

    if ($this->form_validation->run() == true) {
      //save enteries to DB
      $formArray = array();
      $formArray['name'] = $this->input->post('name');
      $formArray['color'] = $this->input->post('color');
      $formArray['transmission'] = $this->input->post('transmission');
      $formArray['price'] = $this->input->post('price');
      $formArray['created_at'] = date('Y-m-d H:i:s');
      $id = $this->Car_model->create($formArray);

      $row = $this->Car_model->getRow($id);
      $vData['row'] = $row;
     $rowhtml = $this->load->view('car_models/car_row',$vData,true);

     $response['row'] = $rowhtml;
      $response['status'] = 1;
      $response['message'] = "<div class=\"alert alert-sucess\">Record has been added successfully.</div>";
    } else {
      $response['status'] = 0;
      $response['name'] = strip_tags(form_error('name'));
      $response['color'] = strip_tags(form_error('color'));
      $response['price'] = strip_tags(form_error('price'));
      // return error masseage 
    }
    echo json_encode($response);
  }
   //*This method will return the edit for like create 
  function getCarModel($id){

  }
}
