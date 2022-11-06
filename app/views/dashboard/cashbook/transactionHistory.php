<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body" id="alert_delete" style="display: none;">      <div  class="callout
                callout-success">
                        <span id="show_message_delete"></span>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Transaction History</h3>
                    <button type="button" class="btn btn-primary btn-sm
                    pull-right"  data-toggle="modal" onclick="addTransactionInfo()"
                            data-target="#transactionModal" title="Record"><i class="glyphicon glyphicon-plus"></i> Add New</button>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <select  id="bankID" class="form-control select2"  style="width: 100%;">
                                    <option value="">-- Select Account --</option>
                                    <?php
                                    if(!empty($account)){
                                        foreach ($account as $eachaccount) {
                                            ?>
                                            <option value="<?php echo $eachaccount->accountID; ?>"><?php echo $eachaccount->accountName; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" id="reservation" placeholder="Date" class="form-control
                                dateRangeReservation">
                            </div>
                        </div>
                    </div>
<!--                    <div class="col-sm-12" style="height: 10px"></div>-->
                    <table id="transactionTBL" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Account Info</th>
                                <th>Date</th>
                                <th>Trans. Type</th>
                                <th>Amount</th>
                                <th>Note</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="transactionModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Transaction Information</h4>
            </div>
            <form action="#"  id="transactionInfoForm" class="form-horizontal"
                  enctype="multipart/form-data"
                  method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-3 text-right">Account</label>
                        <div class=" col-sm-9 ">
                            <select required name="account_id" class="form-control select2 bank_id"  style="width: 100%;">
                            <option value="">-- Select Account --</option>
                            <?php
                                if(!empty($account)){
                                    foreach ($account as $eachaccount) {
                            ?>
                                    <option value="<?php echo $eachaccount->accountID; ?>"><?php echo $eachaccount->accountName; ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group has-feedback updatedHideDiv">
                        <label class="col-sm-3 text-right">Remaining Amount</label>
                        <div class=" col-sm-9 ">
                            <input readonly id="availableAmount"
                               class="form-control
                                av_amount"
                               placeholder="Remaining Amount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 text-right">Trans. Type</label>
                        <div class="col-sm-9 ">
                            <select  name="transType" id="transType" class="form-control " >
                                <option value="">Trans. Type</option>
                                <option value="4">Deposit (+)</option>
                                        <!--   bank Debit Expense Ctg Credit -->
                                <option value="5">Withdraw (-)</option>
                                        <!--   bank Credit Expense Ctg Debit -->
                            </select>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <label class="col-sm-3 text-right">Amount</label>
                        <div class=" col-sm-9 ">
                            <input required="" id="transAmount" onkeyup="checkAvailableTransaction()" name="amount"
                               class="form-control " placeholder="Amount">
                        </div>
                    </div>
                    <div class="form-group has-feedback updatedHideDiv">
                        <label class="col-sm-3 text-right">Current Amount</label>
                        <div class=" col-sm-9 ">
                            <input  readonly id="accountCurrentAmount"  name="accountCurrentAmount"
                               class="form-control " placeholder="Current Amount">
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <label class="col-sm-3 text-right">Date</label>
                        <div class=" col-sm-9 ">
                            <input required="" value="<?php echo date('Y-m-d'); ?>" id="payment_date" name="date"
                               class="form-control" placeholder="YYYY-MM-DD">
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="col-sm-3 text-right">Note/Remarks</label>
                        <div class=" col-sm-9 ">
                            <textarea name="note" colspan="2" id="note"  placeholder="Enter Note/Remarks........."  class="form-control clearInput"></textarea>
                        </div>
                    </div>


                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12 text-left">
                        <div class="box-body" id="alert_error" style="display: none;">      <div  class="callout callout-danger">
                                <span id="show_error_save_info"></span>
                            </div>
                        </div>
                        <div class="box-body" id="alert" style="display: none;">      <div  class="callout
                                callout-info">
                                <span id="show_message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <input type="hidden" name="upId" id="upId" >
                        <button type="button" onclick="saveTransactionInfo()" name="saveBtn" id="saveBtn" class="btn
                                btn-success submit_btn"><i class="glyphicon glyphicon-ok-sign"></i> <span id="show_label"></span></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon
                        glyphicon-remove"></i> Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>