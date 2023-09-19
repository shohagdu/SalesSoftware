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
                <div class="clearfix"></div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <div id="infoDataShow">
                            <table  class="table-style table" style="width:100%;border:1px solid #d0d0d0;">
                                <thead>

                                <tr>
                                    <th style="width: 5%;">S/N</th>
                                    <th style="width: 15%;">Year/Months</th>
                                    <th style="width: 10%;">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i              = 1;
                                $tNetTotal      = 0;
                                $months         = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
                                if(!empty($info)){
                                    foreach ($info as $row) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td class="text-left">
                                                <?php

                                                echo (!empty($row->months)?$months[$row->months]:'');
                                                echo (!empty($row->year)?", ".$row->year:'');
                                                ?>
                                            </td>
                                            <td><?php echo (!empty($row->amount)?$row->amount:''); $tNetTotal+=$row->amount;  ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="2" class="text-right">Total Summery</th>

                                    <th><i class="badge"><?php echo !empty($tNetTotal)? number_format($tNetTotal,2):'0.00'; ?></i></th>

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
