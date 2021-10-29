<?php
    $uriValue = $this->uri->segment(1);
    $uriValue2 = $this->uri->segment(2);
    if(empty($uriValue2)){
        $urlConcat = $uriValue;
    }else {
        $urlConcat = $uriValue . "/" . $uriValue2;
    }
    $acl_menu_info = $this->session->userdata('acl_info');
    $permission_info = $this->session->userdata('permission_info');
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <?php
            $user = $this->session->userdata('user');
            $user_role = $this->session->userdata('user_role');
        ?>
        <ul class="sidebar-menu">
        <?php
        $childArray=[];
        $allChildArray=[];
        if(!empty($acl_menu_info)){
            foreach($acl_menu_info as $main_menu){
                if(!isset($permission_info[$main_menu->id])){
                    continue;
                }
                $childArray=!empty($main_menu->all_sub_menu)?array_column($main_menu->all_sub_menu,'link'):'';

                ?>
                <li  class="treeview  <?php  echo( !empty($childArray) && (in_array($urlConcat,$childArray))?'active':'');  ?>" >
                    <a href="<?php echo base_url().$main_menu->link; ?>">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i> <?php echo $main_menu->title ?>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <?php
                    if(!empty($main_menu->all_sub_menu)){
                        ?>
                        <ul class="treeview-menu">
                            <?php
                            foreach($main_menu->all_sub_menu as $sub_menu){
                                if(!isset($permission_info[$main_menu->id][$sub_menu->id]) ){
                                    continue;
                                }
                                if(empty($sub_menu->all_child_menu)){
                                    ?>
                                    <li class="treeview ">
                                        <a href="<?php echo base_url().$sub_menu->link; ?>">
                                            <i class="glyphicon glyphicon-tasks"></i> <?php echo $sub_menu->title ?>
                                        </a>
                                    </li>
                                <?php }else{  ?>
                                    <li class="treeview ">
                                    <a href="#">
                                        <i class="fa fa-folder"></i> <?php echo $sub_menu->title ?>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <?php
                                }
                                ?>
                                <?php

                                if(!empty($sub_menu->all_child_menu)){
                                    ?>
                                    <ul class="treeview-menu  ">
                                        <?php
                                        foreach($sub_menu->all_child_menu as $child_menu){
                                            if(!isset($permission_info[$main_menu->id][$sub_menu->id][$child_menu->id]) ){
                                                continue;
                                            }
                                            ?>
                                            <li class="treeview active">
                                                <a href="<?php echo base_url().$child_menu->link; ?>">
                                                    <i class="glyphicon glyphicon-tasks"></i> <?php echo $child_menu->title ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    </li>

                                <?php } ?>

                            <?php }  ?>

                        </ul>
                    <?php }  ?>
                </li>
            <?php  } } ?>
        </ul>
            <!--
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
<!--

                    </ul>
                </li>
                <li  <?php if ($uriValue == 'reports') { ?> class="treeview active"  <?php } ?> >
                    <a href="#">
                        <i class="glyphicon glyphicon-circle-arrow-right"></i> All Report                <span class="pull-right-container">
                                <i class="glyphicon glyphicon-chevron-left pull-right"></i>
                             </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($uriValue == 'reports') { ?> class="treeview active"  <?php } ?>>
                            <a href="#">
                                <i class="fa fa-folder"></i> Sales                                        <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu  ">
                                <li class="treeview active">
                                    <a href="<?php echo base_url('reports/dailySalesStatement'); ?>">
                                        <i class="glyphicon glyphicon-tasks"></i> Daily Sales                                                 </a>
                                </li>
                                <li class="treeview active">
                                    <a href="<?php echo base_url('reports/salesReport'); ?>">
                                        <i class="glyphicon glyphicon-tasks"></i> Details Sales                                                 </a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('reports/inventory_report'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>  Inventory</a></li>
                        <!--
                        <li><a href="<?php echo base_url('reports/purchaseReport'); ?>"><i class="glyphicon
                        glyphicon-tasks"></i>  Purchase Report</a></li>
                        -->
        <!--
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
                        <li><a href="<?php echo base_url('UserAccessRole'); ?>"><i class="glyphicon glyphicon-tasks"></i>  Access Role</a></li>

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
        -->



    </section>
    <!-- /.sidebar -->
</aside>