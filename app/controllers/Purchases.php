<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends CI_Controller {

    function __construct() {
        parent::__construct();

         $user=$this->session->userdata('user');
        if (empty($user)) {
            $this->session->set_flashdata('msg', '<div style="text-align: center;font-weight:bold;padding-bottom: 5px;">Please Login!!!</div>');
            redirect(base_url('login'));
        }
        $this->load->model('Purchases_model', 'PURCHASE', TRUE);
        $this->load->model('Products_model', 'PRODUCT', TRUE);
        $this->load->model('Common_model', 'COMMON_MODEL', TRUE);
        $this->load->model('Settings_model', 'SETTINGS', TRUE);

        $this->userId = $this->session->userdata('user');
        $this->dateTime = date('Y-m-d H:i:s');
        $this->ipAddress = $_SERVER['REMOTE_ADDR'];

        $user_outlet= $this->session->userdata('outlet_data');
        $this->outletID=$user_outlet['outlet_id'];
        $this->outletType= $this->session->userdata('outlet_type');
        $this->parentId= $this->session->userdata('parent_id');
    }

    function index() {
        $data = array();
        $view = array();
        $data['title'] = "Purchase List";
        $data['outlet_info']= $this->SETTINGS->outlet_info();
        $view['content'] = $this->load->view('dashboard/purchases/index', $data, TRUE);
        $this->load->view('dashboard/index', $view);
    }

    function create() {
        $data = array();
        $view = array();
        $data['title'] = "Add Stock IN";
        $view['content'] = $this->load->view('dashboard/purchases/create', $data, TRUE);
        $this->load->view('dashboard/index', $view);
    }
    function update($purchaseNo) {
        $data = array();
        $view = array();
        $data['title'] = "Update Stock IN";
        $data['info'] = $this->PURCHASE->single_purchases_info(['purchase_info_stock_in.id'=>$purchaseNo]);
        $data['details'] = $this->PURCHASE->details_stock_info_by_id(['stock_info.purchase_id'=>$purchaseNo]);
        $view['content'] = $this->load->view('dashboard/purchases/update', $data, TRUE);
        $this->load->view('dashboard/index', $view);
    }
    
    function view_purchage_info($purchaseNo) {
        $data = array();
        $data['info'] = $this->PURCHASE->single_purchases_info(['purchase_info_stock_in.id'=>$purchaseNo]);
        $data['details'] = $this->PURCHASE->details_stock_info_by_id(['stock_info.purchase_id'=>$purchaseNo]);
        $data['appConfig'] = $this->COMMON_MODEL->getConfigInfo('*', 'app_config');
        $view = array();
        $view['content'] = $this->load->view('dashboard/purchases/view_purchage_info', $data, TRUE);
        $this->load->view('dashboard/index', $view);
    }

    
   

    function productNameSuggestions() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo json_encode($this->PRODUCT->productSuggestionPurchase($q));
        }
    }

    public function save_purchase_info(){
        extract($_POST);
        if(empty($purchaseNo)){
            echo json_encode(['status'=>'error','message'=>'Purchase No is required','data'=>'']);exit;
        }
        if(empty($purchaseDate)){
            echo json_encode(['status'=>'error','message'=>'Purchase Date is required','data'=>'']);exit;
        }
        if(empty($productID[0])){
            echo json_encode(['status'=>'error','message'=>'Minimum one Product is required','data'=>'']);exit;
        }
        
        if(empty($update_id)){
            $this->db->trans_start();
            $data=[
                'purchase_id'=>$purchaseNo,
                'purchase_date'=>(!empty($purchaseDate)?$purchaseDate:''),
                'note'=>$note,
                'outlet_id'=>$this->outletID,
                'is_active'=>1,
                'created_by'=>$this->userId,
                'created_time'=>$this->dateTime,
                'created_ip'=>$this->ipAddress,
            ];
              
            $this->db->insert("purchase_info_stock_in",$data);
            $insert_id=$this->db->insert_id();
            if(!empty($productID)){   
                foreach($productID as $key=>$product){
                    if(!empty($product) && !empty($unitPrice[$key]) && !empty($quantity[$key])) {
                        $stock_info[] = [
                            'product_id' => $product,
                            'purchase_id' => $insert_id,
                            'stock_type' => 1,
                            'unit_price' => $unitPrice[$key],
                            'total_item' => $quantity[$key],
                            'total_price' => $unitPrice[$key] * $quantity[$key],
                            'debit_outlet' => $this->outletID,
                            'created_by' => $this->userId,
                            'created_time' => $this->dateTime,
                            'created_ip' => $this->ipAddress,
                        ];
                    }
                }
                $this->db->insert_batch("stock_info",$stock_info);
            }
            $redierct_page='purchases/index';
            $this->db->trans_complete();
            if($this->db->trans_status()===true){
                echo json_encode(['status'=>'success','message'=>"Successfully Save Information.",'redirect_page'=>$redierct_page]);
                exit;
            }else{
                echo json_encode(['status'=>'error','message'=>'Fetch a problem, data not update','redirect_page'=>$redierct_page]);exit;
            }

        }else{
            // when update
            $this->db->trans_start();
            $data=[
               // 'purchase_id'=>$purchaseNo,
                'purchase_date'=>(!empty($purchaseDate)?$purchaseDate:''),
                'note'=>$note,
                'outlet_id'=>$this->outletID,
                'is_active'=>1,
                'updated_by'=>$this->userId,
                'updated_time'=>$this->dateTime,
                'updated_ip'=>$this->ipAddress,
            ];
            $this->db->where("id",$update_id);
            $this->db->update("purchase_info_stock_in",$data);
            $update_stock_info=[];
            $create_stock_info=[];
            //echo "<pre>";
           // print_r($productID);
            if(!empty($productID)){
                foreach($productID as $key=>$product){
                    if(!empty($stock_id[$key])) {
                        $update_stock_info[] = [
                            'id' => $stock_id[$key],
                            'unit_price' => $unitPrice[$key],
                            'total_item' => $quantity[$key],
                            'total_price' => $unitPrice[$key] * $quantity[$key],
                            'debit_outlet' => $this->outletID,
                            'updated_by' => $this->userId,
                            'updated_time' => $this->dateTime,
                            'updated_ip' => $this->ipAddress,
                        ];
                    }else{
                        $create_stock_info[] = [
                            'product_id' => $product,
                            'purchase_id' => $update_id,
                            'stock_type' => 1,
                            'unit_price' => $unitPrice[$key],
                            'total_item' => $quantity[$key],
                            'total_price' => $unitPrice[$key] * $quantity[$key],
                            'debit_outlet' => $this->outletID,
                            'created_by'=>$this->userId,
                            'created_time'=>$this->dateTime,
                            'created_ip'=>$this->ipAddress,
                        ];
                    }
                }


                if(!empty($update_stock_info)) {
                    $this->db->update_batch("stock_info",$update_stock_info,'id');
                    $update_id_info=array_column($update_stock_info,'id');

                    if(!empty($update_id_info)) {
                        $delete_info = [
                            'is_active' => 0,
                            'updated_by' => $this->userId,
                            'updated_time' => $this->dateTime,
                            'updated_ip' => $this->ipAddress,
                        ];
                        $this->db->where("purchase_id", $update_id);
                        $this->db->where_not_in("id", $update_id_info);
                        $this->db->update("stock_info", $delete_info);
                    }
                }
                if(!empty($create_stock_info)) {
                    $this->db->insert_batch("stock_info",$create_stock_info);
                }
            }
            $redierct_page='purchases/index';
            $this->db->trans_complete();
            if($this->db->trans_status()===true){
                echo json_encode(['status'=>'success','message'=>"Successfully Update Information.",
                    'redirect_page'=>$redierct_page]);
                exit;
            }else{
                echo json_encode(['status'=>'error','message'=>'Fetch a problem, data not update','redirect_page'=>$redierct_page]);exit;
            }

        }
    }

    public function showAllPurchaseInfo(){
        $postData = $this->input->post();
        $data = $this->PURCHASE->showAllPurchaseInfo($postData);
        echo json_encode($data);
    }

}