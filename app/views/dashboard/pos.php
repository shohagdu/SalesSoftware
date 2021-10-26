<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EASY SALES</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/hover.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/image/favicon.ico">
    <script>
        var base_url='<?php echo base_url() ?>';
    </script>
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">-->
    <!--        <link rel="stylesheet" href="-->
    <!--    --><?php //echo base_url(); ?><!--assets/bootstrap/fonts/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/fonts/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/fonts/css/jquery-ui.css">


    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
    
    <style type="text/css"> 
        .myStyleCss {
            background: white
            height: 200px;
        }

        .inputStyle {
            height: 30px !important;
            text-align: center;

        }

        .thStyleNew {
            width: 30%;
            text-align: left;
            padding-bottom: 5px !important;
            padding-top: 5px !important;
            padding-left: 10px;

        }

        .tdStyleNew {
            width: 70%;
            text-align: center;
            padding-bottom: 5px !important;
            padding-top: 5px !important;
        }

        .appenTd {
            border-right: 2px solid #fff;
            border-bottom: 2px solid #fff;
        }

        td, th, div {
            text-transform: uppercase;
        }

        .search input {
            text-indent: 32px;
        }

        .search .glyphicon-search {
            position: absolute;
            top: 10px;
            left: 30px;
        }

        .search1 input {
            text-indent: 32px;
        }

        .search1 .glyphicon-search {
            position: absolute;
            top: 10px;
            left: 30px;
        }

        .btn-primary {
            font-family: TimeBurner;
            font-size: 15px;
            background-color: #232323;
            border-color: #222222;
        }

        .btn-success:hover {
            background-color: #111111;
            border-color: #000000;
        }

        .btn-success:focus,
        .btn-success:active,
        .btn-success.active {
            background-color: #111111;
            border-color: #000000;
        }

        /*//for scroll bar style*/

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #e4b9c0;
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #b30000;
        }
        .paymentBy{
            font-weight: bold;
            vertical-align: middle !important;
        }


    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body class="hold-transition skin-black-light layout-top-nav">
<div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header pull-left">
                    <a href="<?php echo base_url('welcome'); ?>" class="navbar-brand"><b>RED GREEN</b></a>
                </div>
                <div class="navbar-custom-menu pull-right">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
                        </li>
                        <li class="dropdown user user-menu">
                            <?php
                            $user = $this->session->userdata('user');
                            $admin_data = $this->COMMON_MODEL->get_single_data_by_single_column('tbl_pos_users', 'userID', $user);
                            ?>

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class=""><?php echo $admin_data['username'] ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url('settings/profile') ?>"
                                           class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url('login/logOut'); ?>"
                                           class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="content-wrapper">
        <div class="container-fluid">
            <form action="<?php echo base_url('pos/store'); ?>" id="salesForm" method="post">
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12" style="background: #fff">
                                <div class="col-sm-8" style="margin-top:10px;">
                                    <div class="form-group" >
                                        <div class="col-sm-7 search col-xs-12"  style="margin-bottom:10px;">
                                            <div class="row">
                                                <span class="glyphicon glyphicon-search"></span>
                                                <input required="" name="cst_name"
                                                    placeholder="Name/Mobile/Email/ Address"
                                                    class="customer form-control" onfocus="true"
                                                    id="tags_11">
                                                <input type="hidden" name="customer" id="cst_id"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-1 col-xs-4" >
                                                <button type="button" class="btn btn-info" data-toggle="modal" onclick="addCustomerMemberInfoPos()"
            data-target="#CustomerInfoModal" tabindex="-1"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                        </div>
                                        <div class="col-sm-4 col-xs-8 text-center" style="padding-top:5px" >
                                            <div class="form-check">
                                                <input class="form-check-input" tabindex="-1" checked type="checkbox" value="1" name="allAreRunningCustomer" id="allAreRunningCustomer">
                                                <label class="form-check-label" for="allAreRunningCustomer">
                                                   All are  Running Customer
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="panel panel-default " style="margin-top:5px">
                                        <div class="panel-body"
                                             style="height:50px;padding-top:6px;">
                                            <div style="font-size:10px;font-weight:bold;float:left;text-decoration:underline"> Customer Information:
                                            </div>
                                             <table style="width:100%;font-size:11px;"
                                                   id="showMemberInfo">
                                                <tr>
                                                    <th style="width:15%;">Name</th>
                                                    <td style="width:35%;">: <span id="showName"></span>
                                                    </td>
                                                    <th style="width:15%;ext-align:right;">Mobile</th>
                                                    <td style="width:35%;">: <input type="hidden"
                                                                                    id="member_mobile"
                                                                                    name="member_mobile">
                                                        <span id="mobile"></span></td>
                                                </tr>

                                                <tr>
                                                    <th>Address</th>
                                                    <td >: <span
                                                                id="showAddress"></span></td>
                                                    <th >Email
                                                    </th>
                                                    <td >: <span
                                                                id="showEmail"></span></td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-sm-12" style="">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="search1">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                    <input id="productName" class="form-control"
                                                           placeholder="Scan/Search Product by Name/Code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row " >
                                            <div class="col-md-12 col-xs-12 myStyleCss">
                                                <div class="row table-responsive"
                                                     style="background: #fff;min-height:420px;border:1px solid #fff;">
                                                    <table class="table"
                                                           style="background: #eee; border:2px solid #fff !important;width: 100%!important;"
                                                           rules="all"
                                                    >
                                                        <thead>
                                                        <tr>
                                                            <th style="width: 30%;text-align:center;background: #737373;color:white;padding:10px;">
                                                                Product Information
                                                            </th>

                                                            <th style="10%;text-align:center;background: #737373;color:white;padding:10px;">
                                                                Price
                                                            </th>


                                                            <th style="20%;text-align:center;background: #737373;color:white;padding:10px;">
                                                                Qty
                                                            </th>
                                                            <th style="15%;text-align:center;background: #737373;color:white;padding:10px;">
                                                                Subtotal
                                                            </th>
                                                            <th style="15%;text-align:center;background: #737373;color:white;padding:10px;">
                                                                Action
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tableDynamic">
                                                        <tr id="emptyProduct">
                                                            <td colspan="6"
                                                                style="text-align:center;font-weight:bold;padding:10px;">Please
                                                                Scan/Search Product Name/Code
                                                            </td>
                                                        </tr>
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>



                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-4"
                                     style="background-color:#f2f2f2;min-height:420px;border:1px solid #fff;">
                                    <table style="width:100%;">
                                        <tbody>
                                        <tr>
                                            <th class="thStyleNew">
                                                <a tabindex="-1" href="<?php echo site_url('pos'); ?>"
                                                   class="btn btn-danger btn-sm"><i
                                                            class="glyphicon glyphicon-refresh"></i> Clear Sale</a>
                                            </th>
                                            <td class="tdStyleNew">
                                                <div class="alert alert-warning" id="emptyMember" style="padding:5px;margin:0px">
                                                    Customer Information is required
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="thStyleNew">
                                                Sales Date
                                            </th>
                                            <td class="tdStyleNew">
                                                <input type="text" tabindex="-1" readonly=""
                                                       value="<?php echo date('d-m-Y'); ?>"
                                                       id="datepicker1"
                                                       name="saleDate" class="form-control datepicker">

                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="thStyleNew">
                                                Sub Total
                                            </th>
                                            <td class="tdStyleNew">
                                                <input tabindex="-1" id="subTotal"  readonly type="text" value="0.00"
                                                       name="subTotal"
                                                       class="form-control inputStyle">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="thStyleNew" style="vertical-align:top;">Discount</th>
                                            <td style="border-top: medium none;">
                                                <label for="taka">&#2547;</label>
                                                <input checked="" tabindex="-1" type="radio" id="taka"
                                                       name="discountType"
                                                       value="0">
                                                <label for="percent" style="padding-left: 20px;">&#37;</label>
                                                <input type="radio" id="percent" name="discountType" value="1">

                                                <p id="percentP" style="display: none;">
                                                    <label for="discountPercent">Percent(%)</label>
                                                    <input  placeholder="e.g 10" name="discountPercent"
                                                           id="discountPercent"
                                                           class="form-control">
                                                </p>
                                                <p>
                                                    <input tabindex="-1" name="discount" id="discount"
                                                           class="form-control inputStyle"
                                                           value="0.00">
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="thStyleNew">Net Total</th>
                                            <th class="tdStyleNew">
                                                <input tabindex="-1" id="totalAmount" value='0.00' type="text"
                                                       class="form-control inputStyle"
                                                       readonly=""
                                                       name="totalAmount"
                                                >
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="tdStyleNew">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td rowspan="4"  class="paymentBy"> Payment By </td>
                                                        <td>
                                                            <label class="radio-inline"> <input type="checkbox" tabindex="-1"  id="cash"
                                                                                                value="cash"
                                                                                                onchange="isCheckedById(this)"
                                                                                                checked
                                                                                                name="payment_by[0]"
                                                                ></label>
                                                        </td>
                                                        <td>
                                                            Cash
                                                        </td>

                                                        <td>
                                                            <input type="text" placeholder="0.00"   id="cash_amount"
                                                                   name="payment_ctg_amount[]"
                                                                   class="form-control payment_ctg_amount">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="radio-inline"> <input type="checkbox" tabindex="-1" id="cash_cheque"
                                                                                                onchange="isCheckedById(this)"
                                                                                                value="cash_cheque"
                                                                                                name="payment_by[1]"
                                                                ></label>
                                                        </td>
                                                        <td>
                                                            Cash cheque
                                                        </td>

                                                        <td>
                                                            <input type="text" tabindex="-1" placeholder="0.00"  readonly
                                                                   id="cash_cheque_amount"
                                                                   name="payment_ctg_amount[]"
                                                                   class="form-control payment_ctg_amount">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="radio-inline"> <input type="checkbox" tabindex="-1" id="due_cheque"
                                                                                                onclick="isCheckedById(this)"
                                                                                                value="due_cheque" tabindex="-1"
                                                                                                name="payment_by[2]"
                                                                ></label>
                                                        </td>
                                                        <td>
                                                            Due cheque
                                                        </td>

                                                        <td>
                                                            <input type="text" tabindex="-1" placeholder="0.00"   id="due_cheque_amount"
                                                                   name="payment_ctg_amount[]" tabindex="-1" readonly
                                                                   class="form-control payment_ctg_amount">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="radio-inline"> <input type="checkbox" tabindex="-1" id="online"
                                                                                                onclick="isCheckedById(this)"
                                                                                                value="online_payment" tabindex="-1"
                                                                                                name="payment_by[3]"
                                                                ></label>
                                                        </td>
                                                        <td>
                                                            Online Payment
                                                        </td>

                                                        <td>
                                                            <input placeholder="0.00"  tabindex="-1" type="text"  id="online_amount" readonly
                                                                   name="payment_ctg_amount[]"
                                                                   class="form-control payment_ctg_amount">
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                        </tr>
                                        <tr>

                                            <th class="thStyleNew"  style="color:blue;">Payment </th>
                                            <th class="tdStyleNew">
                                                <input  id="paidNow"  tabindex="-1" placeholder="0.00" value=''  type="text"
                                                        class="form-control inputStyle"  name="paidNow" style='border:1px solid blue;' >
                                            </th>
                                        </tr>
                                        <tr>

                                            <th class="thStyleNew" >Current Due </th>
                                            <th class="tdStyleNew">
                                                <input tabindex="-1" id="currentDueAmount" placeholder="0.00" value=''  type="text"
                                                       class="form-control inputStyle" readonly  name="currentDueAmount" >
                                            </th>
                                        </tr>
                                        <tr>

                                            <th class="thStyleNew" >Previous Due </th>
                                            <th class="tdStyleNew">
                                                <input tabindex="-1" id="customerPreviousDue" placeholder="0.00"
                                                       value="0.00"
                                                       type="text"
                                                       class="form-control inputStyle" readonly  name="customerPreviousDue" >
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="thStyleNew">Total Due </th>
                                            <th class="tdStyleNew">
                                                <input tabindex="-1" id="totalCustomerDue" readonly placeholder="0.00" value='0.00'  type="text"  class="form-control inputStyle"  name="totalCustomerDue" >
                                            </th>
                                        </tr>

                                        <tr id="div5">
                                            <th colspan="4">
                                                <button type="button" id="confirmModal" class="btn btn-block btn-success"   >SALES NOW </button>
                                            </th>
                                        </tr>
                                        <tr id="div5">
                                            <td colspan="4">

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                        </div>
                        <div class="modal fade" id="salesConfirmModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" tabindex="-1" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Sales Order Confirmation</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width:50%;">Customer Name</th>
                                                <td><span id="showConfirmName"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Net Total</th>
                                                <td><span id="showNetTotal"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Payment Amount</th>
                                                <td><span id="showPaymentAmount"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Current Due Amount</th>
                                                <td><span id="showCurrentDueAmount"></span></td>
                                            </tr>

                                            <tr>
                                                <th>Previous Due Amount</th>
                                                <td><span id="showPreviousDueAmount"></span></td>
                                            </tr>

                                            <tr>
                                                <th>Total Due Amount</th>
                                                <td><span id="showTotalDueAmount"></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="modal-footer">
                                        <div id="show_error_save_main"></div>
                                        <div class="clearfix"></div>
                                        <button name="submitBtn" onclick="saveSalesInfo()" type="button"
                                                id="payment_genarel"
                                                class="btn btn-success subBtn"
                                        ><i class="glyphicon glyphicon-ok-circle "></i> CONFIRM SALES
                                        </button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                    class="glyphicon glyphicon-remove "></i>Close
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>


                </section>
            </form>
        </div>
    </div>
    <div class="modal fade" id="CustomerInfoModal" role="dialog">
        <div class="modal-dialog">

            <form action="" method="post" id="customerMemberInfoForm" class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Customer Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="clearfix"></div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-3 text-right">
                                Name
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required name="name" placeholder=" Name" id="name">
                            </div>
                        </div>

                        <div class="form-group col-sm-12">
                            <label class="col-sm-3 text-right">
                                Mobile
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="mobile" placeholder=" Mobile" id="mobile">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-3 text-right">
                                Email
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" placeholder="Email" id="email">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-3 text-right">
                                Address
                            </label>
                            <div class="col-sm-9">
                                                    <textarea class="form-control" name="address" placeholder="Address"
                                                              id="address"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-3 text-right">
                                Date of Birth
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datepicker"
                                       name="customer_date_of_birth" value="<?php echo date('d-m-Y') ?>"
                                       placeholder="Date of
                                       Births"
                                       id="customer_date_of_birth">
                            </div>
                        </div>

                        <div class="form-group col-sm-12">
                            <label class="col-sm-3 text-right">
                                Remarks
                            </label>
                            <div class="col-sm-9">
                                                    <textarea class="form-control" name="remarks" placeholder="Remarks"
                                                              id="remarks"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-3 text-right">
                                Status
                            </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>

                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer">
                        <div class="col-sm-12 text-left">
                            <div class="box-body" id="alert_error" style="display: none;"> <div class="callout
                                                callout-danger"><span id="show_error_save"></span></div></div>
                        </div>
                        <div class="col-sm-12">
                            <input type="hidden" value="<?php echo $this->outletID; ?>"
                                   name="outlet_id"
                                   id="outlet_id" >
                            <input type="hidden" name="upId" id="upId" >
                            <input type="hidden" value="<?php  echo 1 ?>" name="type"   id="type" >
                            <input type="hidden" value="<?php  echo (!empty($redierct_page)?$redierct_page:'') ?>" name="redierct_page" id="redierct_page" >
                            <button type="button" onclick="saveCustomerMemberInfoPos()" name="saveBtn" id="saveBtn"
                                    class="btn
                                                        btn-success submit_btn"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon
                                                glyphicon-remove"></i> Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer class="main-footer">
        <div class="container-fluid">
            <div class="pull-right hidden-xs">
                <b>Version 1.3</b>
            </div>
            <strong>Copyright &copy; <a href="http://shohozit.com/" target="_blank">SHOHOZIT</a></strong> All rights
            reserved.
        </div>
    </footer>
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/plugins/jQueryUI/jquery-new-ui.js"></script>

    <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
    <script src="<?php echo base_url(); ?>assets/modules/js/sales.js"></script>
<!--    <script src="--><?php //echo base_url(); ?><!--assets/modules/js/settings.js"></script>-->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
    <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
</div>
</body>
</html>
