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