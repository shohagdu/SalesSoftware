<section class="content">
    <div class="row">
        <div class="box-body" id="alert" style="display: none;"> <div class="callout callout-info"><span
                    id="show_message"></span></div></div>
        <div class="col-md-12">
            <div class="box no-border" >
                <div class="box-header">
                    <h3 class="box-title">  <?php echo !empty($title)?$title:'' ?></h3>
                    <button class="btn btn-warning btn-sm pull-right no-print"  onclick="goBack()" ><i
                            class="glyphicon glyphicon-backward"></i> Back</button>
                    <button class="btn btn-primary btn-sm pull-right no-print" style="margin-right:5px;"
                            onclick="window
                    .print()
"><i
                            class="glyphicon glyphicon-print"></i> Print</button>
                </div>
                <div class="clearfix"></div>
                <div class="box-body">
                    <table  class="table-style width100per table-striped" >
                        <thead>
                        <tr>
                            <th> SL</th>
                            <th> Name</th>
                            <th> Mobile Number</th>
                            <th> Address</th>
                            <th class="text-right"> Debit</th>
                            <th class="text-right"> Credit</th>
                            <th class="text-right"> Due Amount </th>
<!--                            <th class="no-print" style="width: 10%;">Action</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($info)){
                            $i          =   1;
                            $tDebit     ='0.00';
                            $tCredit    ='0.00';
                            $tDue       ='0.00';
                            foreach ($info as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td class="text-left"><?php echo (!empty($row->name)?ucwords($row->name):'');
                                    ?> </td>
                                    <td class="text-left"><?php echo (!empty($row->mobile)?$row->mobile:'');    ?> </td>
                                    <td class="text-left"><?php echo (!empty($row->address)?$row->address:'');    ?> </td>

                                    <td class="text-right"><?php echo !empty($row->total_debit)
                                            ?number_format($row->total_debit,2):'0.00';
                                    $tDebit+=$row->total_debit;

                                        ?></td>
                                    <td class="text-right"><?php echo !empty($row->total_credit)
                                            ?number_format($row->total_credit,2):'0.00';
                                        $tCredit+=$row->total_credit; ?></td>
                                    <td class="text-right"><?php echo !empty($row->current_due)
                                            ?$row->current_due:'0.00';
                                        $tDue+=$row->current_due_cal;
                                        ?></td>

<!--                                    <td class="text-right">--><?php //echo !empty($row->action)
//                                            ?$row->action:'-';
//                                        ?><!--</td>-->


                                </tr>
                                <?php
                            }
                        }else{
                            echo "<tr><td colspan='7' class='red'>No Data Exist</td></tr>";
                        }
                        ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total Summery</th>
                                <th class="text-right"><?php echo !empty($tDebit)?number_format($tDebit,2):'0.00' ?></th>
                                <th class="text-right"><?php echo !empty($tCredit)?number_format($tCredit,2):'0.00' ?></th>
                                <th class="text-right"><span class="badge bg-color-red" style='background-color:blue'>
                                        <?php echo !empty($tDue)
                                        ?number_format
                                    ($tDue,
                                        2):'0.00'
                                    ?></span></th>
<!--                                <th></th>-->
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
