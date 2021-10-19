<?php

class Pos_model extends CI_Model {

    public function get_single_sales_info($id) {
        $this->db->select("sales_info.*,customer_shipment_member_info.name as customer_name,customer_shipment_member_info.mobile  as customer_mobile,tbl_pos_users.username as user_name");
        $this->db->where('sales_info.id', $id);
        $this->db->join('customer_shipment_member_info', 'customer_shipment_member_info.id = sales_info.customer_id', 'left');
        $this->db->join('tbl_pos_users', 'tbl_pos_users.userID = sales_info.created_by', 'left');
        $this->db->from('sales_info');
        $query_result = $this->db->get();
        if($query_result->num_rows()>0) {
            $result = $query_result->row();
            $result->product_info=$this->PURCHASE->details_stock_info_by_id(['stock_info.sales_id'=>$result->id]);
            return $result;
        }else{
            return  false;
        }
    }



    public function viewInvoiceNo($q)
    {

        $this->db->select('tbl_pos_sales.saleID,tbl_pos_sales.invoiceNo');
        $this->db->like('invoiceNo', $q);
        $this->db->order_by("saleID","DESC");
        $this->db->limit("10");

        $query = $this->db->get("tbl_pos_sales");
        foreach ($query->result_array() as $row) {
            $row['id'] = htmlentities(stripslashes($row['saleID']));
            $row['value'] = htmlentities(stripslashes($row['invoiceNo']));
            $row_set[] = $row;
        }
        echo json_encode($row_set);

    }

    public function showAllPurchaseInfo($postData){
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length'];

        //all default searching
        $search_arr[] = " sales_info.is_active = 1 ";
        $search_arr[] = " sales_info.outletID =  ".$this->outletID;

        // Custom search filter
        $customerID = $postData['customerID'];

        if (!empty($customerID)) {
            $search_arr[] = " sales_info.customer_id = " . $customerID ;
        }


        if(count($search_arr) > 0){
            $searchQuery = implode(" and ",$search_arr);
        }

        ## Total number of records without filtering
        $totalRecords=$this->__get_count_row('sales_info',$searchQuery);
        ## Total number of record with filtering
        $totalRecordwithFilter=$this->__get_count_row('sales_info',$searchQuery);
        ## Fetch records
        $this->db->select("sales_info.*,outlet_setup.name as outlet_name,concat(customer_shipment_member_info.name ,' [',customer_shipment_member_info.mobile,']') as customer_info ", FALSE);
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->join('outlet_setup', 'outlet_setup.id = sales_info.outletID', 'left');
        $this->db->join('customer_shipment_member_info', 'customer_shipment_member_info.id = sales_info.customer_id', 'left');
        $this->db->order_by("sales_info.id", "DESC");
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('sales_info')->result();
        // return $this->db->last_query();
        $data = array();
        $i=1;
        if(!empty($records)) {
            foreach ($records as $key => $record) {
                $data[] = $record;
                $data[$key]->serial_no = (int) $i++;
                $data[$key]->is_active =  ($record->is_active==1)?"<span class='badge bg-green'>Active</span>":"<span class='badge bg-red'>Inactive</span>";
                //$data[$key]->action = '<a href="'. base_url('pos/update/'.$record->id).'"  class="btn btn-primary  btn-sm"  ><i  class="glyphicon glyphicon-pencil"></i> Edit</a> <a href="'. base_url('pos/show/'.$record->id).'" class="btn btn-info  btn-sm"   ><i  class="glyphicon glyphicon-share-alt"></i> view</a> <a href="'. base_url('pos/show/'.$record->id).'" class="btn btn-danger  btn-xs"   ><i  class="glyphicon glyphicon-remove"></i> Delete</a>';
                $data[$key]->action = ' <a href="'. base_url('pos/show/'.$record->id).'" class="btn btn-info  btn-xs"   ><i  class="glyphicon glyphicon-share-alt"></i> View</a> <button onclick="deleteSalesInformation('.$record->id.')"  type="button" class="btn btn-danger  btn-xs"   ><i  class="glyphicon glyphicon-remove"></i> Delete</button> ';



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


#--------------------------------------------------------------------- ------------------------------------------------
#------------------------------------------------update for SK Fashion ------------------------------------------------
#--------------------------------------------------------------------- ------------------------------------------------
    

}