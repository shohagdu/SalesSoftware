<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    function __construct() {
        parent::__construct();

         $user=$this->session->userdata('user');
        if (empty($user)) {
            $this->session->set_flashdata('msg', '<div style="text-align: center;font-weight:bold;padding-bottom: 5px;">Please Login!!!</div>');
            redirect(base_url('login'));
        }

        $this->load->model('Products_model', 'PRODUCTS', TRUE);
        $this->load->model('Settings_model', 'SETTINGS', TRUE);
        $this->load->model('Common_model', 'COMMON_MODEL', TRUE);
        $this->load->model('Reports_model', 'REPORT', TRUE);

        $user_outlet= $this->session->userdata('outlet_data');
        $this->outletID=$user_outlet['outlet_id'];
        $this->outletType= $this->session->userdata('outlet_type');
        $this->parentId= $this->session->userdata('parent_id');

        $this->userId = $this->session->userdata('user');
        $this->dateTime = date('Y-m-d H:i:s');
        $this->ipAddress = $_SERVER['REMOTE_ADDR'];
    }

    function index() {

        $data = array();
        $data['bandInfo'] = $this->SETTINGS->settingInfo(2);
        $data['sourceInfo'] = $this->SETTINGS->settingInfo(3);
        $data['typeInfo'] = $this->SETTINGS->settingInfo(4);
        $data['unitInfo'] = $this->SETTINGS->settingInfo(6);
        $data['title'] = "Product List";
        $view['content'] = $this->load->view('dashboard/products/index', $data, TRUE);
        $this->load->view('dashboard/index', $view);
    }
    public function showAllProductInfo(){
        $postData = $this->input->post();
        $data = $this->PRODUCTS->showAllProductInfo($postData);
        echo json_encode($data);
    }
    public function get_single_product_info(){
        $postData = $this->input->post();
        if(!empty($postData)) {
            $products = $this->COMMON_MODEL->get_single_data_by_single_column('product_info', 'id', $postData['id']);
            if(!empty($products)){
                echo json_encode(['status'=>'success','message'=>'Successfully Data Found','data'=>$products]); exit;
            }else{
                echo json_encode(['status'=>'error','message'=>'No Data Found','data'=>[]]); exit;
            }
        }
    }


    function save_product_info() {
        extract($_POST);
        $this->db->trans_start();
        if(empty($productCode)){
            echo json_encode(['status'=>'error','message'=>'Product Code is required','data'=>'']);exit;
        }
        if(empty($productName)){
            echo json_encode(['status'=>'error','message'=>'Product Name is required','data'=>'']);exit;
        }
        if(empty($productBrand)){
            echo json_encode(['status'=>'error','message'=>'Product Brand is required','data'=>'']);exit;
        }
        if(empty($productSource)){
            echo json_encode(['status'=>'error','message'=>'Product Source is required','data'=>'']);exit;
        }

        if(empty($productType)){
            echo json_encode(['status'=>'error','message'=>'Product Type is required','data'=>'']);exit;
        }
        if(empty($productUnit)){
            echo json_encode(['status'=>'error','message'=>'Product Unit is required','data'=>'']);exit;
        }
        if(empty($productPrice)){
            echo json_encode(['status'=>'error','message'=>'Product Price is required','data'=>'']);exit;
        }
        if(empty($productPurchasePrice)){
            echo json_encode(['status'=>'error','message'=>'Product Purchase Price is required','data'=>'']);exit;
        }

        if(empty($status)){
            echo json_encode(['status'=>'error','message'=>'Status is required','data'=>'']);exit;
        }

        if(empty($upId)) {
            $productInfo = array(
                'productCode' => $productCode,
                'name' => $productName,
                'band_id' => $productBrand,
                'source_id' => $productSource,
                'product_type' => $productType,
                'unit_id' => $productUnit,
                'unit_sale_price' => $productPrice,
                'purchase_price' => $productPurchasePrice,
                'is_active' => $status,
                'created_by' => $this->userId,
                'created_time' => $this->dateTime,
                'created_ip' => $this->ipAddress,
            );
            $this->db->insert("product_info", $productInfo);
            $message='Successfully Save Information';
        }else{
            $productInfo = array(
                'productCode' => $productCode,
                'name' => $productName,
                'band_id' => $productBrand,
                'source_id' => $productSource,
                'product_type' => $productType,
                'unit_id' => $productUnit,
                'unit_sale_price' => $productPrice,
                'purchase_price' => $productPurchasePrice,
                'is_active' => $status,
                'updated_by' => $this->userId,
                'updated_time' => $this->dateTime,
                'updated_ip' => $this->ipAddress,
            );
            $this->db->where('id',$upId);
            $this->db->update("product_info", $productInfo);
            $message='Successfully Update Information';
        }
        $redierct_page='products/index';
        $this->db->trans_complete();
        if($this->db->trans_status()===true){
            echo json_encode(['status'=>'success','message'=>$message,'redirect_page'=>$redierct_page]);
            exit;
        }else{
            echo json_encode(['status'=>'success','message'=>'Fetch a problem, data not update',
                'redirect_page'=>$redierct_page]);exit;
        }

    }



//    public  function uploadimage($image){
//        $ext =  pathinfo($image['name'],PATHINFO_EXTENSION);
//        $imageName=time().".".$ext;
//        $this->load->library('image_lib');
//        $config['image_library'] = 'gd2';
//        $config['source_image']	= $image['tmp_name'];
//        $config['create_thumb'] = false;
//        $config['maintain_ratio'] = TRUE;
//        $config['height']	= "100";
//        $config['width'] = "100";
//        $config['new_image'] = "assets/image/product/".$imageName;//you should have write permission here..
//        $this->image_lib->initialize($config);
//        $this->image_lib->resize();
//        return $config['new_image'];
//    }


    private function productSerialize($productName, $productCode, $productPrice, $productQuantity) {
        foreach ($productName as $k => $name) {
            $group[] = array(
                'productName' => $name,
                'productCode' => $productCode[$k],
                'productPrice' => $productPrice[$k],
                'productQuantity' => $productQuantity[$k]
            );
        }
        return $group;
    }

    function get_suggestions() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo json_encode($this->PRODUCTS->productSuggestion($q));
        }
    }

    function printBarcodes() {
        $data = array();
        if ($this->input->post()) {
            $data['barcodes'] = $this->productSerialize($this->input->post('productName'), $this->input->post('productCode'), $this->input->post('productPrice'), $this->input->post('productQuantity'));
        }

        $view = array();
        $data['title'] = "Print Barcode";
        $view['content'] = $this->load->view('dashboard/products/printBarcodes', $data, TRUE);
        $this->load->view('dashboard/index', $view);
    }

    function genBarcode($productID) {
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        $imageResource = Zend_Barcode::render('code128', 'image', array('text' => $productID), array());
        header("Content-Type: image/png");

        return $imageResource;
    }



}
