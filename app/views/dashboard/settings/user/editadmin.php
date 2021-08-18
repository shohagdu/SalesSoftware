<section class="content-header">

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit User</h3>
                    <?php if ($this->session->flashdata('msg')) { ?>
                        <?php echo $this->session->flashdata('msg'); ?>
                    <?php } ?>
                </div>
                <div class="box-body">
                    <form action="" method="post">

                        <div class="form-group">
                            <label>User Name</label>
                            <input type="name" name="username" class="form-control" value="<?php echo $edit_admin['username'] ?>" required="">
                        </div>
                        <div class="form-group has-feedback">
                            <label>User Email</label>
                            <input name="email" type="email" class="form-control" value="<?php echo $edit_admin['email'] ?>" required="">
                        </div>
                        <div class="form-group has-feedback">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Passworde" >
                        </div>

                        <div class="form-group has-feedback">
                            <label>User Type</label>
                            <select name="roleID" class="form-control select2" required="">
                                <option <?php
                               
                                if ($edit_admin['roleID'] == 1) {
                                    echo "selected";
                                }
                                ?> value="1">Owner</option>
                                <option <?php
                                if ($edit_admin['roleID'] == 2) {
                                    echo "selected";
                                }
                                ?> value="2">Manager</option>

                                <option <?php
                                if ($edit_admin['roleID'] == 3) {
                                    echo "selected";
                                }
                                ?> value="3">Sales</option>
                                <option <?php
                                if ($edit_admin['roleID'] == 4) {
                                    echo "selected";
                                }
                                ?> value="4">Waiter</option>
                                
                                <option <?php
                                if ($edit_admin['roleID'] == 5) {
                                    echo "selected";
                                }
                                ?> value="5">Cooker</option>

                            </select>
                        </div>
                        <div class="form-group has-feedback">
                            <label>Outlet</label>
                            <select name="outlet_id" class="form-control select2" required="">
                                <option value="1">Select Outlet</option>
                                <?php 
                                    if(!empty($outlet_info)){
                                        foreach($outlet_info as $outlet){
                                            $selected=($outlet->id==$edit_admin['outlet_id'])?"selected":'';
                                ?>
                                <option value="<?php echo $outlet->id ?>" <?php echo $selected; ?>><?php echo $outlet->name ?></option>
                                <?php 
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        

                        <div class="row">
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-8 ">
                                <a href="<?php echo site_url('settings/listUser'); ?>"  class="btn btn-danger btn-flat pull-right" style="margin-left: 10px;">Back</a>
                                <button type="submit"  class="btn btn-primary btn-fla pull-right">Update</button>

                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4"></div>
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
