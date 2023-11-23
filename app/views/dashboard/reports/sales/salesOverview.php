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
                    <a href="<?php base_url('reports/salesOverview') ?>" class="btn btn-warning btn-sm pull-right no-print" style="margin-right: 5px;" ><i class="glyphicon glyphicon-refresh"></i> Refresh</a>
                </div>
                <div class="clearfix"></div>
                <?php
                $months         = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
                ?>
                <div class="box-body">
                    <div class="table-responsive">
                        <form action="#" method="post" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-4 no-print">
                                    <select name="fromDate" class="form-control select2">
                                        <option value="">Select From</option>
                                        <?php
                                        for($i=2021;$i<=date('Y');$i++){
                                            foreach ($months as $key=>$month){
                                                echo "<option value='".$i.'-'.$key."'>".$month.'-'.$i."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 no-print">
                                    <select name="toDate" class="form-control select2">
                                        <option value="">Select To</option>
                                        <?php
                                        for($i=2021;$i<=date('Y');$i++){
                                            foreach ($months as $key=>$month){
                                                echo "<option value='".$i.'-'.$key."'>".$month.'-'.$i."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 no-print">
                                    <button class="btn btn-success" type="submit" name="searchBtn"><i class="glyphicon glyphicon-search"></i> Search</button>
                                </div>
                            </div>
                        </form>
                        <?php
                            if(!empty($searchDateRange)){
                                echo "<h4>".$searchDateRange."</h4>";
                            }
                        ?>

                        <div id="infoDataShow">
                            <table  class="table-style table" style="width:100%;border:1px solid #d0d0d0;">
                                <thead>

                                <tr>
                                    <th style="width: 5%;">S/N</th>
                                    <th style="width: 15%;">Year/Months</th>
                                    <th style="width: 10%;">Sub Total</th>
                                    <th style="width: 10%;">Discount</th>
                                    <th style="width: 10%;">Net Total</th>
                                    <th style="width: 10%;">Payment/RCV</th>
                                    <th style="width: 10%;">Costing Amt</th>
                                    <th style="width: 10%;">Profit/Lose Amt</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i              = 1;
                                $tsubTotal      = 0;
                                $tDiscount      = 0;
                                $tNetTotal      = 0;
                                $tSumAmnt       = 0;
                                $tPuchaseAmnt   = 0;
                                $tProfitLose    = 0;
                                if(!empty($info)){
                                    foreach ($info as $row) {
                                        $purchaseInfo   =   (!empty($row->getPurchaseInfo)?$row->getPurchaseInfo:'');
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td class="text-left">
                                                <?php

                                                echo (!empty($row->months)?$months[$row->months]:'');
                                                echo (!empty($row->year)?", ".$row->year:'');
                                                ?>
                                            </td>
                                            <td><?php echo (!empty($row->sum_sub_total)?number_format($row->sum_sub_total,2):''); $tsubTotal+=$row->sum_sub_total;   ?></td>
                                            <td><?php echo (!empty($row->sum_discount)?number_format($row->sum_discount,2):'');  $tDiscount+=$row->sum_discount;  ?></td>
                                            <td><?php echo (!empty($row->sum_net_total)?number_format($row->sum_net_total,2):'');  $tNetTotal+=$row->sum_net_total;   ?></td>
                                             <td><?php echo (!empty($row->sum_payment_amount)?number_format($row->sum_payment_amount,2):'');  $tSumAmnt+=$row->sum_payment_amount;   ?></td>
                                            <td>
                                                <?php
                                                echo (!empty($purchaseInfo->totalPurchasePrice)?number_format($purchaseInfo->totalPurchasePrice,2):'0.00');$tPuchaseAmnt+=$purchaseInfo->totalPurchasePrice;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                               echo (!empty($purchaseInfo->totalPurchasePrice)?number_format($row->sum_net_total-$purchaseInfo->totalPurchasePrice,2):'0.00');$tProfitLose+=(!empty($purchaseInfo->totalPurchasePrice)?$row->sum_net_total-$purchaseInfo->totalPurchasePrice:'0.00');
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
                                    <th colspan="2" class="text-right">Total Summery</th>

                                    <th><i class="badge"><?php echo !empty($tsubTotal)? number_format($tsubTotal,2):'0.00'; ?></i></th>
                                    <th><i class="badge"><?php echo !empty($tDiscount)? number_format($tDiscount,2):'0.00'; ?></i></th>
                                    <th><i class="badge"><?php echo !empty($tNetTotal)? number_format($tNetTotal,2):'0.00'; ?></i></th>
                                    <th><i class="badge"><?php echo !empty($tSumAmnt)? number_format($tSumAmnt,2):'0.00'; ?></i></th>
                                    <th><i class="badge"><?php echo !empty($tPuchaseAmnt)? number_format($tPuchaseAmnt,2):'0.00'; ?></i></th>
                                    <th><i class="badge"><?php echo !empty($tProfitLose)? number_format($tProfitLose,2):'0.00'; ?></i></th>

                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
