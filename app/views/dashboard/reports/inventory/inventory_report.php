<section class="content">
    <div class="row">
        <div class="box-body" id="alert" style="display: none;"> <div class="callout callout-info"><span
                        id="show_message"></span></div></div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">  <?php echo !empty($title)?$title:'' ?></h3>
                    <button class="btn btn-primary btn-sm pull-right no-print" onclick="window.print()"><i
                                class="glyphicon glyphicon-print"></i> Print</button>
                </div>
                <form action="" method="post" id="inventoryReportForm">
                    <div class="form-group no-print">
                        <?php
                        if($this->outletType=='main'){
                            ?>
                            <div class="col-sm-2">
                                <label>Outlet</label>
                                <div class="clearfix"></div>
                                <select id="outletID" name="outletID" class="form-control" required style="width:
                                100%;">
                                    <option value="">Select Outlet</option>
                                    <?php if(!empty($outlet_info)){ foreach ($outlet_info as $outlet) { ?>
                                        <option value="<?php echo $outlet->id; ?>"><?php echo $outlet->name; ?></option>
                                    <?php } }?>
                                </select>
                            </div>
                        <?php } ?>
                        <div class="col-sm-3">
                            <label>Product</label>
                            <div class="clearfix"></div>
                            <input type="text" id="productName_1" required data-type="productName" placeholder="Product Name" class="productName form-control">
                            <input type="hidden" name="product_id" id="productID_1" class="form-control">

                        </div>
                        <div class="col-sm-2">
                            <label>Brand</label>
                            <div class="clearfix"></div>
                            <select id="bandID" name="bandID" class="form-control" >
                                <option value="">Select Band</option>
                                <?php if(!empty($bandInfo)){ foreach ($bandInfo as $brand) { ?>
                                    <option value="<?php echo $brand->id; ?>"><?php echo $brand->title; ?></option>
                                <?php } }?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Brand</label>
                            <div class="clearfix"></div>
                            <button type="button" onclick="searchingInvantoryReport()" class="btn btn-info" ><i
                                        class="glyphicon
                            glyphicon-search" ></i> Search</button>
                        </div>

                    </div>
                </form>
                <div class="clearfix"></div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="stock_info_data">
                        <table  class="table-style table" style="width:100%;border:1px solid #d0d0d0;">
                            <thead>

                            <tr>
                                <td class="font-weight-bold"> SL</td>
                                <td class="font-weight-bold"> Product name</td>
                                <td class="font-weight-bold"> Brand</td>
                                <td class="font-weight-bold"> Source</td>
                                <td class="font-weight-bold"> p. type</td>
                                <td class="font-weight-bold"> Stock In(Opening+In) </td>
                                <td class="font-weight-bold"> Stock Out (Sale+Transfer)</td>
                                <td class="font-weight-bold" >Balance</td>
                                <td class="no-print font-weight-bold " style="width: 10%;">Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($info)){
                                $i=1;
                                foreach ($info as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td class="text-left"><?php echo $row->name.' ['.$row->productCode.']'; ?></td>
                                        <td class="text-left"><?php echo $row->bandTitle; ?></td>
                                        <td class="text-left"><?php echo $row->sourceTitle; ?></td>
                                        <td><?php echo $row->ProductTypeTitle; ?></td>
                                        <td><i class="badge"><?php echo $row->debit_item_info; ?></i></td>
                                        <td><i class="badge"><?php echo $row->credit_item_info; ?></i></td>
                                        <td><i class="badge"><?php echo $row->current_stock_item; ?></i></td>
                                        <td class="no-print">
                                            <a href="<?php echo base_url('reports/details_inventory_report/'.$row->id)
                                            ?>" class="btn btn-info btn-xs"><i
                                                        class="glyphicon glyphicon-share-alt"></i>
                                                Details</a>
                                        </td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
