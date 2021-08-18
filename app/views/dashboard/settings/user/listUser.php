
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">User Info</h3>
            <?php if ($this->session->flashdata('msg')) { ?>
                <?php echo $this->session->flashdata('msg'); ?>
            <?php } ?>
            <a href="<?php echo site_url('settings/addUser'); ?>"
               class="btn btn-primary btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($admin_list as $each_admin) {
                        if($each_admin['username']!='superadmin'):
                        ?>
                        <tr>
                            <td><?php echo $each_admin['username']; ?></td>
                            <td><?php echo $each_admin['email']; ?></td>
                            <td>
                                <?php
                               
                                if ($each_admin['roleID'] == 1) {
                                    echo 'Owner';
                                } elseif ($each_admin['roleID'] == 2) {
                                    echo 'Manager';
                                } elseif ($each_admin['roleID'] == 3) {
                                    echo 'Sales';
                                }elseif ($each_admin['roleID'] ==4) {
                                    echo 'Waiter';
                                }elseif ($each_admin['roleID'] ==5) {
                                    echo 'Cooker';
                                }
                                ?>
                            </td>

                            <td>
                                <a style="margin-right: 5px;" href="<?php echo base_url('settings/editadmin'); ?>/<?php echo $each_admin['userID']; ?>" class="btn btn-primary btn-sm pull-left">Edit</a>  
<!--                                <a href="--><?php //echo base_url('settings/deleteadmin'); ?><!--/--><?php //echo $each_admin['userID']; ?><!--" onclick="return confirm('Are You sure, Your want to delete This!')" class="btn btn-danger btn-sm pull-left">Delete</a>-->
                            </td>
                        </tr>

                    <?php endif; } ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->