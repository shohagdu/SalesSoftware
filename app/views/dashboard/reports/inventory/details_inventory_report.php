<section class="content">
    <div class="row">
        <div class="box-body" id="alert" style="display: none;"> <div class="callout callout-info"><span
                    id="show_message"></span></div></div>
        <div class="col-md-12">
            <div class="box no-border">
                <div class="box-header">
                    <h3 class="box-title">  <?php echo (!empty($title)?$title:'')." ".(!empty($products->name)
                                ?"<b>".$products->name."</b>":'') ?></h3>
                    <button class="btn btn-warning btn-sm pull-right no-print"  onclick="goBack()" ><i
                                class="glyphicon glyphicon-backward"></i> Back</button>
                    <button class="btn btn-primary btn-sm pull-right no-print" style="margin-right:5px;" onclick="window.print()"><i
                            class="glyphicon glyphicon-print"></i> Print</button>
                </div>
                <div class="col-sm-12">
                    <table  class="table-style width80per" >
                        <tr>
                            <th class="text-left width20per"> Product name</th>
                            <td class="width30per text-left"> <?php echo (!empty($products->name)?$products->name:'') ?></td>
                            <th class="text-left width20per"> Product Code</th>
                            <td class="width30per text-left"> <?php echo (!empty($products->productCode)
                                    ?$products->productCode:'') ?></td>

                        </tr>
                        <tr>
                            <th class="text-left"> Brand</th>
                            <td class="text-left"><?php echo (!empty($products->bandTitle)?$products->bandTitle:'') ?> </td>
                            <th class="text-left"> Source</th>
                            <td class="text-left"><?php echo (!empty($products->sourceTitle)?$products->sourceTitle:'') ?> </td>
                        </tr>
                        <tr>
                            <th class="text-left"> Product type</th>
                            <td class="text-left"><?php echo (!empty($products->ProductTypeTitle)?$products->ProductTypeTitle:'') ?>
                            </td>
                            <th class="text-left"> Current Stock</th>
                            <td class="text-left"> </td>
                        </tr>





                    </table>
                </div>
                <div class="clearfix"></div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table  class="table-style" style="width:100%">
                        <thead>
                        <tr>
                            <th colspan="3"></th>
                            <th colspan="2">Stock In</th>
                            <th colspan="2">Stock Out</th>
                        </tr>
                        <tr>
                            <th> SL</th>
                            <th> Date</th>
                            <th> Details</th>
                            <th class="width10per"> Opening Stock</th>
                            <th class="width10per"> Stock In</th>
                            <th class="width10per"> Sale </th>
                            <th class="width10per"> Transfer</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                             if(!empty($info)){
                                 $i=1;
                                 $tDebit=0;
                                 $tCredit=0;
                                foreach($info as $row){
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo (!empty($row->created_time)?date('d M, Y',strtotime
                                            ($row->created_time)):'') ?></td>
                                        <td></td>
                                        <td>
                                            <?php
                                                // add type
                                                if(!empty($row->debit_outlet) && !empty($row->stock_type) &&
                                                    ($row->stock_type==6) ) {
                                                        echo(!empty($row->total_item) ? $row->total_item : '0');
                                                    $tDebit+=$row->total_item;
                                                 }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if(!empty($row->debit_outlet) && !empty($row->stock_type) &&
                                                    $row->stock_type==1) {
                                                    echo(!empty($row->total_item) ? $row->total_item : '0');
                                                    $tDebit+=$row->total_item;
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if(!empty($row->credit_outlet) && !empty($row->stock_type) &&
                                                    $row->stock_type==2) {
                                                    echo(!empty($row->total_item) ? $row->total_item : '0');
                                                    $tCredit+=$row->total_item;
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if(!empty($row->credit_outlet) && !empty($row->stock_type) &&
                                                    $row->stock_type==3) {
                                                    echo(!empty($row->total_item) ? $row->total_item : '0');
                                                    $tCredit+=$row->total_item;
                                                }
                                            ?>

                                        </td>

                                    </tr>
                        <?php
                                }

                            }
                        ?>


                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Total Debit Item</td>
                                <td colspan="2"> <span class="badge bg-green"><?php echo !empty($tDebit)?$tDebit:'0';
                                        ?></span></td>
                                <td  colspan="2"><span class="badge bg-red"><?php echo !empty($tCredit)?$tCredit:'0';
                                        ?></span></td>
                            </tr>
                            <tr>
                                <td colspan="3">Balances</td>
                                <td colspan="4"><span class="badge bg-yellow"><?php echo !empty($tDebit-$tCredit)
                                            ?$tDebit-$tCredit:'0'; ?></span></td>
                            </tr>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
