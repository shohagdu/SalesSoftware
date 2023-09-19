<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header" >
                    <h3 class="box-title">  <?php echo !empty($title)?$title:'' ?></h3>
                    <button class="btn btn-primary btn-sm pull-right no-print" onclick="window.print()"><i
                            class="glyphicon glyphicon-print"></i> Print</button>
                </div>
                <form action="" method="post" id="salesReportForm">
                    <div class="form-group no-print">
                        <div class="col-sm-3">
                            <label>Date</label>
                            <div class="clearfix"></div>
                            <input type="text" id="reservation" name="searchingDate" placeholder="Date" class="form-control">
                        </div>
                        <div class="col-sm-2" style="margin-top:25px;">
                            <button type="button" onclick="searchingBestSales()" class="btn btn-info" ><i
                                    class="glyphicon
                            glyphicon-search" ></i> Search</button>
                        </div>

                    </div>
                </form>
                <div class="clearfix"></div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <div id="stock_info_data">
                            <table  class="table-style table" style="width:100%;border:1px solid #d0d0d0;">
                                <thead>
                                <tr>
                                    <td class="font-weight-bold"> SL</td>
                                    <td class="font-weight-bold"> Product Info</td>
                                    <td class="font-weight-bold">  Numbers of Product</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=1;
                                if(!empty($info)){
                                    foreach ($info as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td class="text-left">
                                                <?php echo $row->name.' ['.$row->productCode.']'; ?>
                                                <?php echo $row->bandTitle; ?>
                                                <?php echo (!empty($row->sourceTitle)?", ".$row->sourceTitle:''); ?>
                                                <?php echo (!empty($row->ProductTypeTitle)?", ".$row->ProductTypeTitle:''); ?>
                                                <div class="clearfix"></div>
                                            </td>
                                            <td><i class="badge"><?php echo (!empty($row->totalCountItems)?$row->totalCountItems:''); ?></i></td>

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

    </div>
</section>
