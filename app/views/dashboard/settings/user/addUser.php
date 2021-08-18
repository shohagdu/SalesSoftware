

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">New User</h3>
                    <?php if ($this->session->flashdata('msg')) { ?>
                        <?php echo $this->session->flashdata('msg'); ?>
                    <?php } ?>
                    <a href="<?php echo site_url('settings/listUser'); ?>"
                       class="btn btn-primary btn-sm pull-right"><i class="glyphicon glyphicon-list"></i> View</a>
                </div>
                <div class="box-body">
                    <form action="" method="post">

                        <div class="form-group">
                            <label>User Name</label>
                            <input type="name" name="username" class="form-control" placeholder="User Name" required="">
                        </div>
                        <div class="form-group has-feedback">
                            <label>User Email</label>
                            <input name="email" type="email" class="form-control" placeholder="User Email Address" required="">
                        </div>
                        <div class="form-group has-feedback">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control " placeholder="Passworde" required="">
                        </div>

                        <div class="form-group has-feedback">
                            <label>User Type</label>
                            <select name="roleID" class="form-control select2" required="">
                                <option value="">Select</option>
                                <option value="1">Owner</option>
                                <option value="2">Manager</option>
                                <option value="3">Sales</option>
                                <option value="4">Waiter</option>
                                <option value="5">Cooker</option>
                            </select>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Outlet</label>
                            <select name="outlet_id" class="form-control select2" required="">
                                <option value="1">Select Outlet</option>
                                <?php 
                                    if(!empty($outlet_info)){
                                        foreach($outlet_info as $outlet){
                                           
                                ?>
                                <option value="<?php echo $outlet->id ?>" ><?php echo $outlet->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-xs-4">
                                <button type="submit"  class="btn btn-success btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <h3>Can Access</h3>
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th>Owner</th>
                        <td>
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <td>
                                        <ul>
                                            <li>Dashboard</li>
                                            <li>Sales</li>
                                            <li>Products</li>
                                            <li>Inventory</li>
                                            <li>Purchase</li>
                                            <li>Cashbook</li>
                                            <li>Expenses</li>
                                            <li>Suppliers</li>
                                            <li>Report</li>
                                            <li>Setting</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>Manager</th>
                        <td>
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <td>
                                        <ul>
                                            <li>Dashboard</li>
                                            <li>Sales</li>
                                            <li>Products</li>
                                            <li>Inventory</li>
                                            <li>Purchase</li>
                                            <li>Expenses</li>
                                            <li>Report</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                     <tr>
                        <th>Sales Man</th>
                        <td>
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <td>
                                        <ul>
                                            <li>Dashboard</li>
                                            <li>Sales</li>
                                            <li>Products</li>
                                            <li>Inventory</li>
                                            <li>Report</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<script type="text/javascript">
    var randomString = function (length) {
        var text = "";
        var possible = "0123456789";
        for (var i = 0; i < length; i++) {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        return text;
    };

    var codeLenghtCheck = function () {
        var code = $('#productCode').val();
        if (code.length < 8) {
            $("#productCodeError").text("Product Code must be minimum 8 digit lenght.");
        } else if (code.length > 8) {
            $("#productCodeError").text("Product Code must be maximum 8 digit lenght.");
        } else {
            $("#productCodeError").empty();
        }
    };

    $("#random").click(function () {
        $('#productCode').val(randomString(8));
        codeLenghtCheck();
    });

    $("#productCode").keyup(function () {
        codeLenghtCheck();
    });

    $("#productCode").change(function () {
        codeLenghtCheck();
    });

</script>
