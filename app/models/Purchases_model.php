<?php
class Purchases_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function single_purchases_info($where=null)
    {
        $this->db->select('purchase_info_stock_in.*,outlet_setup.name as outlet_name');
        $this->db->from('purchase_info_stock_in');
        $this->db->join('outlet_setup', 'outlet_setup.id = purchase_info_stock_in.outlet_id', 'left');
        if(!empty($where)){
            $this->db->where($where);
        }
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
          return  $result = $query_result->row();
        }else{
            return false;
        }
    }

    function details_stock_info_by_id($where=null)
    {
        $this->db->select('stock_info.*,band.title as bandTitle,source.title as sourceTitle,productType.title as ProductTypeTitle,unitInfo.title as unitTitle,product_info.name as product_name,product_info.productCode');
        $this->db->from('stock_info');
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->join(' product_info', 'product_info.id = stock_info.product_id', 'left');
        $this->db->join(' all_settings_info as band', 'band.id = product_info.band_id', 'left');
        $this->db->join('all_settings_info as source', 'source.id = product_info.source_id', 'left');
        $this->db->join(' all_settings_info as productType', 'productType.id = product_info.product_type', 'left');
        $this->db->join(' all_settings_info as unitInfo', 'unitInfo.id = product_info.unit_id', 'left');

        $this->db->where('stock_info.is_active',1);
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
          return  $result = $query_result->result();
        }else{
            return false;
        }
    }
    
    public function generateRandomString() {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            $length='11';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
           $pos = 'SIN-'. $randomString;
        $this->COMMON_MODEL->get_single_data_by_single_column('tbl_pos_purchases', 'purchaseNo', $pos);
        if($this->db->affected_rows()>0){
           return $this->generateRandomString();
        }else{
            return $pos;
        }

    }

    public function showAllPurchaseInfo($postData){
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];

        // Custom search filter
        $outletName = $postData['outletID'];

        if (!empty($outletName)) {
            $search_arr[] = " purchase_info_stock_in.outlet_id = " . $outletName ;
        }

        $search_arr[] = " purchase_info_stock_in.is_active = 1 ";
        if(count($search_arr) > 0){
            $searchQuery = implode(" and ",$search_arr);
        }

        ## Total number of records without filtering
        $totalRecords=$this->__get_count_row('purchase_info_stock_in',$searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter=$this->__get_count_row('purchase_info_stock_in',$searchQuery);
        ## Fetch records
        $this->db->select('purchase_info_stock_in.*,outlet_setup.name as outlet_name');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->join('outlet_setup', 'outlet_setup.id = purchase_info_stock_in.outlet_id', 'left');
        $this->db->order_by("purchase_info_stock_in.id", "DESC");
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('purchase_info_stock_in')->result();
        // return $this->db->last_query();
        $data = array();
        $i=1;
        if(!empty($records)) {
            foreach ($records as $key => $record) {
                $data[] = $record;
                $data[$key]->serial_no = (int) $i++;
                $data[$key]->is_active =  ($record->is_active==1)?"<span class='badge bg-green'>Active</span>":"<span class='badge bg-red'>Inactive</span>";
                $data[$key]->action = '<a href="'. base_url('purchases/update/'.$record->id).'"  class="btn btn-primary  btn-sm"  ><i  class="glyphicon glyphicon-pencil"></i> Edit</a> <a href="'. base_url('purchases/view_purchage_info/'.$record->id).'" class="btn btn-info  btn-sm"   ><i  class="glyphicon glyphicon-share-alt"></i> view</a>';


            }
        }
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }

    

    
    

    
   
}