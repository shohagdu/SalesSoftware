<?php
class Settings_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }



    function expensehead()
    {
        $this->db->select('*');
        $this->db->from('tbl_pos_expense_head');
        $this->db->where('softDelete',0);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    function account()
    {
        $this->db->select('*');
        $this->db->from('tbl_pos_accounts');
        $this->db->where('softDelete',0);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }


    function destroyProductCatagory($product_catagoriesID)
    {
        $this->db->where('product_catagoriesID', $product_catagoriesID);
        $this->db->update('tbl_pos_product_catagories', array(
            'softDelete'=>1,
        ));
        return TRUE;
    }

    function updateProductCatagory($data)
    {
        $this->db->where('product_catagoriesID', $data['product_catagoriesID']);
        $this->db->update('tbl_pos_product_catagories', array(
            'catagoryName'=>$data['catagoryName'],
        ));
        return TRUE;
    }


    function config()
    {
        $this->db->select('*');
        $this->db->from('tbl_pos_config');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    function posConfig()
    {
        $this->db->select('*');
        $this->db->from('app_config');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    function smsConfig()
    {
        $this->db->select('is_sms_costing,sms_costing');
        $this->db->from('app_config');
        $this->db->order_by("id","desc");
        $this->db->limit(1);
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
            $result = $query_result->row();
            if($result->is_sms_costing==1){
                return $result->sms_costing;
            }else{
                return '0.00';
            }
        }else{
            return '0.00';
        }
    }
    function smsConfigInfo()
    {
        $this->db->select('is_sms_costing,sms_costing');
        $this->db->from('app_config');
        $this->db->order_by("id","desc");
        $this->db->limit(1);
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
            return $result = $query_result->row();
            
        }else{
            return false;
        }
    }
    
    
    function smsConfigData()
    {
        $this->db->select('id,is_sms_costing,sms_costing');
        $this->db->from('app_config');
        $this->db->order_by("id","desc");
        $this->db->limit(1);
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
            return  $query_result->row();
        }else{
            return false;
        }
    }

    function updatePosConfig($data)
    {
        $this->db->where('configPosID', $data['configPosID']);
        $this->db->update('tbl_pos_config_pos', array(
            'warehouseID'=>$data['warehouseID'],
            'accountID'=>$data['accountID'],
        ));
        return TRUE;
    }
    public function get_all_pending_sms(){
        $this->db->select('*');
        $this->db->from('sms_history');
        $this->db->where('send_status',1);
        $this->db->where('mobile_number !=','');
         $this->db->limit(10);
        $query_result = $this->db->get();
        if($this->db->affected_rows()>0){
            return $query_result->result();
        }else{
            return false;
        }
    }

    public function SendSms($mobile,$sms) {


        $url = 'http://worldit.powersms.net.bd/httpapi/sendsms';
        $fields = array(
            'userId' => urlencode('duclub'),
            'password' => urlencode('duclub@2017'),
            'smsText' => urlencode($sms),
            'commaSeperatedReceiverNumbers' => $mobile,
        );


        foreach($fields as $key=>$value){
            @$fields_string .= $key.'='.$value.'&';
        }

        rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);

// If you have proxy
// $proxy = '<proxy-ip>:<proxy-port>';
// curl_setopt($ch, CURLOPT_PROXY, $proxy);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);

        if($result === false)
        {
            echo sprintf('<span>%s</span>CURL error:', curl_error($ch));
            return;
        }

        $json_result = json_decode($result);
       // var_dump($json_result);

        if($json_result==NULL){
            //echo sprintf("<p style='color:red'>ERROR: <span style='font-weight:bold;'>%s</span></p>", $json_result->message);
            return "ERROR";
        }
        else if(empty($json_result)){
            //echo sprintf("<p style='color:red'>ERROR: <span style='font-weight:bold;'>%s</span></p>", $json_result->message);
            return "ERROR";
        }
       else if($json_result->isError){
            //echo sprintf("<p style='color:red'>ERROR: <span style='font-weight:bold;'>%s</span></p>", $json_result->message);
            return "ERROR";
        }else{
            //echo sprintf("<p style='color:green;'>SUCCESS!</p>");
            return "SUCCESS";

        }

        curl_close($ch);

    }

    public function success_staus($update_id,$sending_status){
        if($sending_status=='SUCCESS'){
            $this->db->where("id",$update_id);
            $this->db->update("sms_history",['success_status'=>1,'send_status'=>2]);
            if($this->db->affected_rows()>0){
                return 'successfully send sms';
            }else{
                 return 'failed send sms';
            }
            
        }else{
            $this->db->where("id",$update_id);
            $this->db->update("sms_history",['success_status'=>2,'send_status'=>2]);
            if($this->db->affected_rows()>0){
                return 'failed send sms system error';
            }else{
                return 'failed send sms';
            }
        }
    }


    
     public function get_sms_info(){
       $this->db->select('date(ins_date) as sms_date, COUNT(id) as total_sms,  COUNT(CASE WHEN success_status = 1 THEN success_status ELSE NULL END) success_sms,
COUNT(CASE WHEN success_status = 2 THEN success_status ELSE NULL END) failed_sms,COUNT(CASE WHEN send_status = 1 THEN send_status ELSE NULL END) pending_sms');
        $this->db->from('sms_history');
        $this->db->group_by("date(ins_date)");
        $this->db->order_by("date(ins_date)", "DESC");
        $this->db->limit('30');
        $query_result = $this->db->get();
        
        if($query_result->num_rows()>0) {
            $result = $query_result->result();
            return $result;
        }else{
            return false;
        }
    }
    public function get_sms_details_info($type,$date){
       $this->db->select('sms_history.*,tbl_pos_member_info.name,tbl_pos_member_info.member_code,');
        $this->db->from('sms_history');
         $this->db->join('tbl_pos_member_info', ' tbl_pos_member_info.id = sms_history.member_id','left');
         $this->db->where("sms_history.success_status",$type);
         $this->db->where("date(sms_history.ins_date)",$date);
        $this->db->order_by("date(sms_history.ins_date)", "DESC");
        $query_result = $this->db->get();
        
        if($query_result->num_rows()>0) {
            $result = $query_result->result();
            return $result;
        }else{
            return false;
        }
    }

    function settingInfo($type)
    {
        $this->db->select('*');
        $this->db->from('all_settings_info');
        $this->db->where('is_active',1);
        if(!empty($type)){
            $this->db->where('type',$type);
        }
        $this->db->order_by("id","DESC");
        $query_result = $this->db->get();
        $result = $query_result->result();
        if($this->db->affected_rows()>0) {
            return $result;
        }else{
            return false;
        }
    }
    function get_single_settings_info($where)
    {
        $this->db->select('*');
        $this->db->from('all_settings_info');
        $this->db->where($where);
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
            return $query_result->row();
        }else{
            return false;
        }
    }



    // Get DataTable data
    function showAllSettingsInfo($postData=null,$type){
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];
        $search_arr[] = " all_settings_info.type = $type ";
        if(count($search_arr) > 0){
            $searchQuery = implode(" and ",$search_arr);
        }
        ## Total number of records without filtering
        $totalRecords=$this->__get_count_row('all_settings_info',$searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter=$this->__get_count_row('all_settings_info',$searchQuery);
        ## Fetch records
        $this->db->select('all_settings_info.*');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->order_by("title", "ASC");
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('all_settings_info')->result();
        $data = array();
        $i=1;
        if(!empty($records)) {
            foreach ($records as $key => $record) {
                $data[] = $record;
                $data[$key]->serial_no = (int) $i++;
                $data[$key]->is_active =  ($record->is_active==1)?"<span class='badge bg-green'>Active</span>":"<span class='badge bg-red'>Inactive</span>";
                $data[$key]->action = '<button  class="btn btn-primary  btn-sm" data-toggle="modal" onclick="updateSettingInfo('.$record->id.' )" data-target="#myModal"><i  class="glyphicon glyphicon-pencil"></i> Edit</button>';


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
    function showAllCustomerInfo($postData=null){

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $searchValue = $postData['search']['value']; // Search value

        ## Search datatable global searching...
        $search_arr = array();
        $searchQuery = "";
        if($searchValue != ''){
            $search_arr[] = " (customer_shipment_member_info.name like '%".$searchValue."%' or 
             customer_shipment_member_info.mobile like '%".$searchValue."%' or 
             customer_shipment_member_info.email like'%".$searchValue."%'   
              ) ";
        }


        // Custom search filter
        $outletID = !empty($postData['outletID'])?$postData['outletID']:'';
        $typeID = !empty($postData['typeID'])?$postData['typeID']:'';
        $customerName = !empty($postData['customerName'])?$postData['customerName']:'';

        if (!empty($outletID)) {
            $search_arr[] = " customer_shipment_member_info.outlet_id='" . $outletID . "' ";
        }
        if (!empty($typeID)) {
            $search_arr[] = " customer_shipment_member_info.type='" . $typeID . "' ";
        }
        if (!empty($customerName)) {
            $search_arr[] = " customer_shipment_member_info.name like '%" . $customerName . "%' ";
        }

        $search_arr[] = " customer_shipment_member_info.is_active != 0 ";
        if(count($search_arr) > 0){
            $searchQuery = implode(" and ",$search_arr);
        }

        ## Total number of records without filtering
        $totalRecords=$this->__get_count_row('customer_shipment_member_info',$searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter=$this->__get_count_row('customer_shipment_member_info',$searchQuery);
        ## Fetch records
        $this->db->select("customer_shipment_member_info.*,outlet_setup.name as outlet_name,outlet_setup.address as outlet_address ,sum(t.debit_amount) as total_debit,sum(t.credit_amount)  as total_credit,(sum(t.debit_amount) - sum(t.credit_amount)) as current_due",false);
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->join('outlet_setup', 'outlet_setup.id = customer_shipment_member_info.outlet_id', 'left');
        $this->db->join('transaction_info as t', 't.customer_member_id = customer_shipment_member_info.id AND t.is_active=1', 'left');
        $this->db->order_by("customer_shipment_member_info.name", "ASC");
        $this->db->limit($rowperpage, $start);
        $this->db->group_by("customer_shipment_member_info.id");
        $records = $this->db->get('customer_shipment_member_info')->result();
        $data = array();
        $i=1;
        if(!empty($records)) {
            foreach ($records as $key => $record) {
                $action='';
                $data[] = $record;
                $data[$key]->serial_no = (int) $i++;
                $data[$key]->is_active =  ($record->is_active==1)?"<span class='badge bg-green'>Active</span>":"<span class='badge bg-red'>Inactive</span>";
                if($record->type==1) {
                    $cuDue= $record->total_debit- $record->total_credit;
                    $data[$key]->current_due = (!empty($cuDue)) ? "<span class='badge' style='background-color:red;'>"
                        . number_format($cuDue,2) . "</span>" : "<span class='badge'>0.00</span>";

                    $action .= '<button  class="btn btn-primary  btn-xs" data-toggle="modal" onclick="updateCustomerMemberInfo(' . $record->id . ' )" data-target="#myModal"><i  class="glyphicon glyphicon-pencil"></i> Edit</button>   <a  class="btn btn-info  btn-xs"  href="' . base_url('reports/details_customer_member_info/' . $record->id) . ' " ><i  class="glyphicon glyphicon-share-alt"></i> Ledger</a> ';
                    if ($this->session->userdata('abhinvoiser_1_1_role') == 'superadmin') {
                        $action .= ' <button  class="btn btn-danger  btn-xs" onclick="deleteCustomerMemberInfo(' .
                            $record->id . ',1 )" ><i  class="glyphicon glyphicon-remove"></i> Delete</button>';
                    }

                    $data[$key]->action = $action;
                }else{
                    // This is for member
                    $data[$key]->current_due = '0.00';
                    $data[$key]->action = '<button  class="btn btn-primary  btn-sm" data-toggle="modal" onclick="updateCustomerMemberInfo(' . $record->id . ' )" data-target="#myModal"><i  class="glyphicon glyphicon-pencil"></i> Edit</button> <a  class="btn btn-info  btn-sm"  href="' . base_url('shipment_info/details_member_info/' . $record->id) . ' " ><i  class="glyphicon glyphicon-share-alt"></i>  Ledger</a> ';
                }

            }
        }
        //
        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }
    function checkingDueExitMember($param){
        $this->db->select("sum(t.debit_amount) as total_debit,sum(t.credit_amount)  as total_credit,(sum(t.debit_amount) - sum(t.credit_amount)) as current_due",false);
        if($param != ''){
            $this->db->where($param);
        }
        $this->db->where('t.is_active',1);
        $records = $this->db->get('transaction_info as t');
        if($records->num_rows()>0){
             $row=$records->row();
             if(!empty($row)){
                 return $row->total_debit-$row->total_credit;
             }else{
                 return false;
             }
        }else{
            return false;
        }
    }


    function outlet_info($where=NULL)
    {
        $this->db->select('*');
        $this->db->from('outlet_setup');
        if(!empty($where)) {
            $this->db->where($where);
        }
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
            return $query_result->result();
        }else{
            return false;
        }
    }
    function get_single_customer_member_info($where=NULL)
    {
        $this->db->select('*');
        $this->db->from('customer_shipment_member_info');
        if(!empty($where)) {
            $this->db->where($where);
        }
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
            return $query_result->row();
        }else{
            return false;
        }
    }



    function showAllOutletInfo($postData=null){

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];

        // Custom search filter
        $outletName = $postData['outletName'];

        if (!empty($outletName)) {
            $search_arr[] = " outlet_setup.name like '%" . $outletName . "%' ";
        }

        $search_arr[] = " outlet_setup.is_active != 0 ";
        if(count($search_arr) > 0){
            $searchQuery = implode(" and ",$search_arr);
        }

        ## Total number of records without filtering
        $totalRecords=$this->__get_count_row('outlet_setup',$searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter=$this->__get_count_row('outlet_setup',$searchQuery);
        ## Fetch records
        $this->db->select('outlet_setup.*,parent_outlet.name as parent_outlet_name');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->join(' outlet_setup as parent_outlet', 'parent_outlet.id = outlet_setup.parent_id', 'left');
        $this->db->order_by("outlet_setup.name", "ASC");
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('outlet_setup')->result();
        // return $this->db->last_query();
        $data = array();
        $i=1;
        if(!empty($records)) {
            foreach ($records as $key => $record) {
                $data[] = $record;
                $data[$key]->serial_no = (int) $i++;
                $data[$key]->is_active =  ($record->is_active==1)?"<span class='badge bg-green'>Active</span>":"<span class='badge bg-red'>Inactive</span>";
                $data[$key]->action = '<button  class="btn btn-primary  btn-sm" data-toggle="modal" onclick="updateOutletInfo('.$record->id.' )" data-target="#myModal"><i  class="glyphicon glyphicon-pencil"></i> Edit</button> <a href="'. base_url('settings/outlet_opening_stock_info/').$record->id.'" class="btn btn-info  btn-sm"   ><i  class="glyphicon glyphicon-plus"></i> Opening Stock</a>';


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

    function get_single_outlet_info($where=NULL)
    {
        $this->db->select('*');
        $this->db->from('outlet_setup');
        if(!empty($where)) {
            $this->db->where($where);
        }
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
            return $query_result->row();
        }else{
            return false;
        }
    }

    #get_customer_info autocomplete
    public function getcustomername($q,$type=1)
    {

        $this->db->select("c.id as customer_id,c.name,c.mobile,c.address,c.email",false);
        $this->db->from('customer_shipment_member_info as c');
//        $this->db->join("transaction_info as t","t.customer_member_id=c.id AND t.is_active=1","left");
        if(!empty($q)) {
            $where = "(c.name LIKE '%$q%' OR c.mobile LIKE '%$q%' OR c.email LIKE '%$q%' OR c.address LIKE '%$q%'   )";
            $this->db->where($where);
        }
        if(!empty($type)){
            $this->db->where('c.type', $type);
        }else {
            $this->db->where(['c.type' => 1]);
        }
        $this->db->order_by("c.name","ASC");
        $this->db->limit(10);
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
            foreach ($query_result->result_array() as $row) {
                $row['id'] = htmlentities(stripslashes($row['customer_id']));
                $row['value'] = htmlentities(stripslashes($row['name']." (".$row['mobile'].") - ".$row['address']));
                $row['mobile'] = htmlentities(stripslashes($row['mobile']));
                $row['email'] = htmlentities(stripslashes($row['email']));
                $row['address'] = htmlentities(stripslashes($row['address']));
//                $row['current_due'] = htmlentities(stripslashes($row['balance']));
                $row['current_due_data'] = $this->customer_member_current_due(['t.customer_member_id'=>$row['customer_id']]);
                $row_set[] = $row;
            }
            return json_encode($row_set);
        }else{
            return false;
        }

    }

    public function customer_member_current_due($where){
            $this->db->select("sum(t.debit_amount) as total_debit,sum(t.credit_amount)  as total_credit,(sum(t.debit_amount) - sum(t.credit_amount)) as balance");
            $this->db->from('transaction_info as t');
            if(!empty($where)) {
                $this->db->where($where);
            }
            $this->db->where("t.is_active",1);
            $query_result = $this->db->get();
            if($query_result->num_rows()>0) {
                $data= $query_result->row();
                if(!empty($data->total_debit-$data->total_credit)) {
                    return number_format($data->total_debit-$data->total_credit,2,'.','');
                }else{
                    return '0.00';
                }
            }else{
                return '0.00';
            }
    }
    public function checking__stock_product_exist($where){
        $this->db->select('stock_info.id,stock_info.product_id,stock_info.total_item',true);
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->where('stock_info.is_active', 1);
        $row_info = $this->db->get('stock_info');
        if($row_info->num_rows()>0){
            $item=$row_info->row();
            return ['status'=>'found','message'=>'successfully item found','stock_id'=>$item->id];
        }else{
            return ['status'=>'empty_product','message'=>'No  item found','data'=>[]];
        }
    }
    public function showAllCustomerDueCollectionInfo($postData){
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];

        //all default searching
        $search_arr[] = "  transaction_info.type IN (3,7) ";
        $search_arr[] = "  transaction_info.is_active = 1 ";
//        $search_arr[] = "  transaction_info.outletID =  ".$this->outletID;

        // Custom search filter
        $customerID = !empty($postData['customerID'])?$postData['customerID']:'';

        if (!empty($customerID)) {
            $search_arr[] = " transaction_info.customer_member_id = " . $customerID ;
        }


        if(count($search_arr) > 0){
            $searchQuery = implode(" and ",$search_arr);
        }

        ## Total number of records without filtering
        $totalRecords=$this->__get_count_row('transaction_info',$searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter=$this->__get_count_row('transaction_info',$searchQuery);
        ## Fetch records
        $this->db->select("transaction_info.*,outlet_setup.name as outlet_name,concat(customer_shipment_member_info.name ,' [',customer_shipment_member_info.mobile,']') as customer_info ", FALSE);
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->join('outlet_setup', 'outlet_setup.id = transaction_info.outletID', 'left');
        $this->db->join('customer_shipment_member_info', 'customer_shipment_member_info.id = transaction_info.customer_member_id', 'left');
        $this->db->order_by("transaction_info.id", "DESC");
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('transaction_info')->result();
        // return $this->db->last_query();
        $data = array();
        $i=1;
        if(!empty($records)) {
            foreach ($records as $key => $record) {
                $action='';
                $data[] = $record;
                $data[$key]->serial_no = (int) $i++;
                $data[$key]->typeTitle =  ($record->type==3)?"Due Collection":($record->type==7?"Manual Due Add":"");
                $data[$key]->credit_amount =  ($record->type==3)?$record->credit_amount:
                    ($record->type==7?$record->debit_amount:"0.00");
                $data[$key]->is_active =  ($record->is_active==1)?"<span class='badge bg-green'>Active</span>":"<span class='badge bg-red'>Inactive</span>";

                $action .= '<button  class="btn btn-primary  btn-sm" data-toggle="modal" onclick="updateDueCollectInfo('.$record->id.' )" data-target="#myModal"><i  class="glyphicon glyphicon-pencil"></i> Edit</button>';
                if ($this->session->userdata('abhinvoiser_1_1_role') == 'superadmin') {
                    $action .= ' <button  class="btn btn-danger  btn-sm" onclick="deleteMemberDueCollectionInfo('
                        . $record->id . ' )" ><i  class="glyphicon glyphicon-remove"></i> Delete</button>';
                }

                $data[$key]->action =$action;

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
    public function getSingleTransactionInfo($where){
        $this->db->select("t.*,concat(customer_shipment_member_info.name ,' [',customer_shipment_member_info.mobile,']') as customer_info,,DATE_FORMAT(payment_date, '%d-%m-%Y') as payment_date_title");
        $this->db->from("transaction_info as t");
        $this->db->join('customer_shipment_member_info', 'customer_shipment_member_info.id = t.customer_member_id', 'left');
        if(!empty($where)) {
            $this->db->where($where);
        }
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
            return $query_result->row();
        }else{
            return false;
        }
    }

    public function get_single_transaction_info($where){
        $this->db->select("transaction_info.*,sales_info.sales_date,customer_shipment_member_info.name as customerName,customer_shipment_member_info.mobile as customerMobile,customer_shipment_member_info.address,expense.title as expenseTitle,expenseBankInfo.bank_id as expenseBankID,,tbl_pos_accounts.accountName as bankName, DATE_FORMAT(transaction_info.payment_date, '%d-%m-%Y') AS payment_date_title",true);
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->where('transaction_info.is_active', 1);
        $this->db->join('sales_info', 'sales_info.id = transaction_info.sales_id', 'left');
        $this->db->join('customer_shipment_member_info', 'customer_shipment_member_info.id = transaction_info.customer_member_id', 'left');
        $this->db->join('all_settings_info as expense', 'expense.id = transaction_info.expense_ctg AND transaction_info.type=8 AND  expense.type=7 ', 'left');
        $this->db->join('transaction_info as expenseBankInfo', 'expenseBankInfo.parent_id = transaction_info.id AND expenseBankInfo.type=5', 'left');
        $this->db->join('tbl_pos_accounts', 'tbl_pos_accounts.accountID = transaction_info.bank_id', 'left');

        $this->db->order_by("transaction_info.id","ASC");
        $row_info = $this->db->get('transaction_info');
        if($row_info->num_rows()>0){
            return $row_info->row();
        }else{
            return  false;
        }
    }
    public function transactionType(){
        // 1 = Sales Total Amt (dr), 2 = when sales then payment (Cr), 3 = Due Collection (Cr), 4 = bank Add (Dr), 5 = Bank Cr (Deduct) 6 = Supplier bill Create (Cr), 7 = Supplier Payment (Dr) (Bank Cr), 8 = Expense (Dr) [bank CR]
        return [
            1 => 'Sales Total Amt', // Dr
            2 => 'Payment (When Sales)', // Cr
            3 => 'Due Collection', // Cr
            4 => 'Bank Balance Add', //Dr
            5 => 'Bank Balance Deduct', //Cr
            6 => 'Supplier Bill Generate', // Cr
            7 => 'Supplier Payment', // Dr
            8 => 'Expense', // Dr // Bank Cr
            9 => 'Customer Opening Deposit', // Cr
            10=> 'Opening Due', // Dr
            11=> 'Cash Deposit to Customer', // Dr
            12=> 'Closing Discount', // Cr
        ];
    }


}