<?php
 $uriValue = $this->uri->segment(1);
$uriValue2 = $this->uri->segment(2);
$urlConcat= $uriValue."/".$uriValue2;
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <?php
        $user = $this->session->userdata('user');
        $user_role = $this->session->userdata('user_role');
//        role==1 # ownere
//        role==2 # manager
//        role==3 # sales
//        role==4 # waiter
//        role==4 # cooker
        ?>
            <ul class="sidebar-menu">

                <li class="">
                    <a href="<?php echo base_url(); ?>">
                        <i class="glyphicon glyphicon-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>


                <li <?php if ($uriValue == 'pos') { ?> class="treeview active"  <?php } ?> >
                    <a href="#">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i> <span>Sales</span>
                        <span class="pull-right-container">
                            <i class="glyphicon glyphicon-chevron-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li><a href="<?php  echo base_url('pos/index');    ?>"><i class="glyphicon glyphicon-tasks"></i> New Sales</a></li>
                        <li><a href="<?php echo base_url('pos/salesList'); ?>"><i class="glyphicon glyphicon-tasks"></i> List of  Sales</a></li>

                    </ul>
                </li>


                <li <?php if ($uriValue2 == 'customer_info' || $uriValue2 == 'detailsClient' || $uriValue2 == 'detailsClientReports') { ?> class="treeview active"  <?php } ?>>
                    <a href="#">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i> Customer Info
                        <span class="pull-right-container">
                                    <i class="glyphicon glyphicon-chevron-left pull-right"></i>
                                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('settings/customer_info'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>Customer Record</a></li>
                        <li><a href="<?php echo base_url('settings/customer_due_collection'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>Customer Due Collecton</a></li>


                    </ul>
                </li>
                <li <?php if ($uriValue == 'purchases' ) { ?> class="treeview active"  <?php } ?>>
                    <a href="#">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i> <span>Purchase</span>
                        <span class="pull-right-container">
                            <i class="glyphicon glyphicon-chevron-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                       <li><a href="<?php echo base_url('purchases/create'); ?>"><i class="glyphicon glyphicon-tasks"></i> Add New </a></li>
                        <li><a href="<?php echo base_url('purchases/index'); ?>"><i class="glyphicon glyphicon-tasks"></i> List </a></li>
                    </ul>
                </li>
                <!--
                <li <?php if ($uriValue2 == 'shipment_member_info' || $uriValue2 == 'member_due_collection' ) { ?> class="treeview active"  <?php } ?>>
                    <a href="#">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i> <span>Supplier</span>
                        <span class="pull-right-container">
                            <i class="glyphicon glyphicon-chevron-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('shipment_info/shipment_member_info'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>Supplier</a></li>
                        <li><a href="<?php echo base_url('shipment_info/member_due_collection'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>Supplier Due Payment</a></li>
                    </ul>
                </li>
                -->

                <!--
                <li <?php if ($uriValue == 'transfer') { ?> class="treeview active"  <?php } ?>>
                    <a href="#">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i> <span>Transfer</span>
                        <span class="pull-right-container">
                        <i class="glyphicon glyphicon-chevron-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('transfer/create'); ?>"><i class="glyphicon glyphicon-tasks"></i> Add New </a></li>
                        <li><a href="<?php echo base_url('transfer/index'); ?>"><i class="glyphicon glyphicon-tasks"></i> List </a></li>
                    </ul>
                </li>
                <li <?php if ($uriValue == 'shipment_info') { ?> class="treeview active"  <?php } ?>>
                    <a href="#">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i> <span>Shipment</span>
                        <span class="pull-right-container">
                    <i class="glyphicon glyphicon-chevron-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('shipment_info/stock_info'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i> Stock In Info </a></li>
                        <li><a href="<?php echo base_url('shipment_info/delivery_info'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>Delivery (out)</a></li>
                        <li><a href="<?php echo base_url('shipment_info/shipment_setup'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>Shipment Setup</a></li>
                        <li><a href="<?php echo base_url('shipment_info/shipment_member_info'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>Member Record</a></li>
                        <li><a href="<?php echo base_url('shipment_info/member_due_collection'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>Member Due Collection</a></li>

                        <li><a href="<?php echo base_url('shipment_info/shipment_report'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>Report</a></li>


                    </ul>
                </li>
                -->

                    <li <?php if ($uriValue2 == 'outlet_info') { ?> class="treeview active"  <?php } ?>>
                    <a href="#">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i> <span>Outlet</span>
                        <span class="pull-right-container">
                        <i class="glyphicon glyphicon-chevron-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('settings/outlet_info'); ?>"><i class="glyphicon
                    glyphicon-tasks"></i>  Outlet Record</a></li>
                    </ul>
                </li>
                <li <?php if ($uriValue == 'products') { ?> class="treeview active"  <?php } ?>>
                    <a href="#">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i> <span>Products</span>
                        <span class="pull-right-container">
                            <i class="glyphicon glyphicon-chevron-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('products/index'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>  Products Record</a></li>
                        <!--
                        <li><a href="<?php echo base_url('products/printBarcodes'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>  Barcode Print</a></li>
                        -->


                    </ul>
                </li>
                <li <?php if ($uriValue == 'reports') { ?> class="treeview active"  <?php } ?>>
                    <a href="#">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i>
                        <span>Report</span>
                        <span class="pull-right-container">
                            <i class="glyphicon glyphicon-chevron-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('reports/inventory_report'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>  Inventory</a></li>
                        <li><a href="<?php echo base_url('reports/salesReport'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>  Sales Report</a></li>
                        <li><a href="<?php echo base_url('reports/purchaseReport'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>  Purchase Report</a></li>


                    </ul>
                </li>

                <li <?php if ($uriValue2 == 'productBand' || $uriValue2 == 'productSource' || $uriValue2 == 'productType' || $uriValue2 == 'productUnit'  || $uriValue2 == 'listUser') { ?> class="treeview active"  <?php } ?> >
                    <a href="#">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i> <span>Settings</span>
                        <span class="pull-right-container">
                            <i class="glyphicon glyphicon-chevron-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('settings/listUser'); ?>"><i class="glyphicon glyphicon-tasks"></i>  User Info</a></li>
                        <li><a href="<?php echo base_url('settings/productBand'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i> Product Band</a></li>
                        <li><a href="<?php echo base_url('settings/productSource'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i> Product Source</a></li>
                        <li><a href="<?php echo base_url('settings/productType'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i> Product Type</a></li>
                        <li><a href="<?php echo base_url('settings/productUnit'); ?>"><i class="glyphicon glyphicon-tasks"></i> Product Unit</a></li>
                      <li><a href="<?php  echo base_url('settings/PosConfigIndex');
                            ?>"><i class="glyphicon glyphicon-tasks"></i> Shop Configuration</a></li>
                    </ul>
                </li>

                <li class="">
                    <a href="<?php echo base_url('login/logOut'); ?>">
                        <i class="glyphicon glyphicon-off"></i> <span>Log Out</span>
                    </a>
                </li>
            </ul>



    </section>
    <!-- /.sidebar -->
</aside>