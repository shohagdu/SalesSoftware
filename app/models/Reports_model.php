<?php
class Reports_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function inventory_report($where=NULL,$outletID=NULL){
        //return 'hello';
        $this->db->select('product_info.id,product_info.name,product_info.productCode,product_info.is_active,band.title as bandTitle,source.title as sourceTitle,productType.title as ProductTypeTitle,unitInfo.title as unitTitle,product_info.purchase_price,product_info.unit_sale_price',true);
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->where('product_info.is_active', 1);
        $this->db->join(' all_settings_info as band', 'band.id = product_info.band_id', 'left');
        $this->db->join('all_settings_info as source', 'source.id = product_info.source_id', 'left');
        $this->db->join(' all_settings_info as productType', 'productType.id = product_info.product_type', 'left');
        $this->db->join(' all_settings_info as unitInfo', 'unitInfo.id = product_info.unit_id', 'left');
        $this->db->order_by("productCode", "ASC");
        $this->db->order_by("id", "ASC");
        $records = $this->db->get('product_info');
        if($records->num_rows()>0) {
           $result = $records->result();
           foreach ($result as $key => $product){
               $result[$key]->debit_item_info=$this->stock_item_count(['stock_info.product_id'=>$product->id,'stock_info.debit_outlet'=>$outletID]);
               $result[$key]->credit_item_info=$this->stock_item_count(['stock_info.product_id'=>$product->id,'stock_info.credit_outlet'=>$outletID]);
               $result[$key]->current_stock_item=$result[$key]->debit_item_info-$result[$key]->credit_item_info;
           }
           return $result;
        }else{
            return false;
        }
    }

    public function stock_item_count($where){
        $this->db->select('SUM(total_item) as sum_item_info',true);
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->where('stock_info.is_active', 1);
        $row_info = $this->db->get('stock_info');
        $count_item=$row_info->row()->sum_item_info;
        if($count_item>0){
            return $count_item;
        }else{
            return  '0';
        }
    }
    public function get_transaction_info($where){
        $this->db->select('transaction_info.*,sales_info.sales_date',true);
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->where('transaction_info.is_active', 1);
        $this->db->join('sales_info', 'sales_info.id = transaction_info.sales_id', 'left');
        $this->db->order_by("transaction_info.id","ASC");
        $row_info = $this->db->get('transaction_info');
        if($row_info->num_rows()>0){
            return $row_info->result();
        }else{
            return  false;
        }
    }
    public function details_inventory_report($product_id,$outlet_id){
        $this->db->select('stock_info.*',true);
        if(!empty($product_id) && !empty($outlet_id)) {
            $this->db->where("stock_info.product_id",$product_id);
            $this->db->where("(stock_info.credit_outlet='$outlet_id' OR stock_info.debit_outlet='$outlet_id' )");
        }
        $this->db->where('stock_info.is_active', 1);
        $row_info = $this->db->get('stock_info');
        if($row_info->num_rows()>0){
            return $row_info->result();
        }else{
            return  false;
        }
    }

    function sales_report($where=NULL){
        $this->db->select('product_info.id as productID,product_info.name,product_info.productCode,product_info.is_active,band.title as bandTitle,source.title as sourceTitle,productType.title as ProductTypeTitle,unitInfo.title as unitTitle,stock_info.id as stockID,stock_info.unit_price,total_item,total_price,purchaseAmtForSales,sales_info.id as salesID,(total_price-(total_item*purchaseAmtForSales)) as profileAmount,customer_shipment_member_info.name as customerName,mobile,sales_info.sales_date,sales_info.invoice_no',true);
        if(!empty($where['firstDate'])){
            $this->db->where("sales_date >=", $where['firstDate']);
            $this->db->where("sales_date <=", $where['toDate']);
            unset($where['firstDate']);
            unset($where['toDate']);
        }else{
            $this->db->where("sales_date >=", date('Y-m-d'));
            $this->db->where("sales_date <=", date('Y-m-d'));
        }
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->where('product_info.is_active', 1);
        $this->db->join('stock_info', 'stock_info.sales_id = sales_info.id AND stock_info.stock_type=2 ', 'left');
        $this->db->join('product_info', 'product_info.id = stock_info.product_id', 'left');
        $this->db->join('all_settings_info as band', 'band.id = product_info.band_id', 'left');
        $this->db->join('all_settings_info as source', 'source.id = product_info.source_id', 'left');
        $this->db->join('all_settings_info as productType', 'productType.id = product_info.product_type', 'left');
        $this->db->join('all_settings_info as unitInfo', 'unitInfo.id = product_info.unit_id', 'left');
        $this->db->join('customer_shipment_member_info', 'sales_info.customer_id = customer_shipment_member_info.id', 'left');
        $this->db->order_by("sales_date", "ASC");
        $records = $this->db->get('sales_info');
        if($records->num_rows()>0) {
            $result = $records->result();
            return $result;
        }else{
            return false;
        }
    }
    function dailySalesReport($where=NULL){
        $this->db->select('sales_info.id as salesID,customer_shipment_member_info.name as customerName,mobile,sales_info.sales_date,sales_info.invoice_no,sub_total,discount,net_total,payment_amount,',true);
        if(!empty($where['firstDate'])){
            $this->db->where("sales_date >=", $where['firstDate']);
            $this->db->where("sales_date <=", $where['toDate']);
            unset($where['firstDate']);
            unset($where['toDate']);
        }else{
            $this->db->where("sales_date >=", date('Y-m-d'));
            $this->db->where("sales_date <=", date('Y-m-d'));
        }
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->where('sales_info.is_active', 1);
        $this->db->join('customer_shipment_member_info', 'sales_info.customer_id = customer_shipment_member_info.id', 'left');
        $this->db->order_by("sales_date", "ASC");
        $records = $this->db->get('sales_info');
        if($records->num_rows()>0) {
            $result = $records->result();
            if(!empty($result)) {
                foreach ($result as $key => $row) {
                    $result[$key]->getPurchaseAmount=self::getPurchaseAmtBySalesID(['stock_info.sales_id'=>$row->salesID]);

                }
                return $result;
            }
        }else{
            return false;
        }
    }

    function getPurchaseAmtBySalesID($where){
        $this->db->select('sum((total_item*purchaseAmtForSales)) as profileAmount',true);
        if(!empty($where)) {
            $this->db->where($where);
        }
        $this->db->where('stock_info.is_active', 1);
        $records = $this->db->get('stock_info');
        if($records->num_rows()>0) {
            $result = $records->row();
            return (!empty($result->profileAmount)?$result->profileAmount:'0.00');
        }else{
            return '0.00';
        }
    }
    function todaySalesInfo($where=NULL){
        $this->db->select('sum(net_total) as totalBill, sum(payment_amount) as totalCollectionAmt',true);
        if(!empty($where['firstDate'])){
            $this->db->where("sales_date >=", $where['firstDate']);
            $this->db->where("sales_date <=", $where['toDate']);
        }
        $this->db->where('sales_info.is_active', 1);

        $records = $this->db->get('sales_info');
        if($records->num_rows()>0) {
            $result = $records->row();
            if(!empty($result)) {
                return (!empty($result->totalCollectionAmt)?$result->totalCollectionAmt:'0.00');
            }
        }else{
            return '0.00';
        }
    }


}