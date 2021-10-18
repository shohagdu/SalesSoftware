<table  class="table-style table" style="width:100%;border:1px solid #d0d0d0;">
    <thead>

    <tr>
        <td class="font-weight-bold"> SL</td>
        <td class="font-weight-bold"> Sales ID</td>
        <td class="font-weight-bold"> Date</td>
        <td class="font-weight-bold"> Product Info</td>
        <td class="font-weight-bold"> Unit Sales Price</td>
        <td class="font-weight-bold"> Unit Purchase Price</td>

        <td class="font-weight-bold"> Qty</td>
        <td class="font-weight-bold"> Total Purchase Amount </td>
        <td class="font-weight-bold"> Total Sales Amount </td>
        <td class="font-weight-bold"> profit /Lose </td>

    </tr>
    </thead>
    <tbody>
    <?php
    $profiteLose=0;
    $i=1;
    if(!empty($info)){
        foreach ($info as $row) {
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td>
                    <?php echo (!empty($row->invoice_no)?$row->invoice_no:''); ?>
                </td>
                <td nowrap="">
                    <?php echo (!empty($row->sales_date)?date('d, M, Y',strtotime($row->sales_date)):''); ?>
                </td>

                <td class="text-left">
                    <?php echo $row->name.' ['.$row->productCode.']'; ?>
                    <?php echo $row->bandTitle; ?>
                    <?php echo (!empty($row->sourceTitle)?", ".$row->sourceTitle:''); ?>
                    <?php echo (!empty($row->ProductTypeTitle)?", ".$row->ProductTypeTitle:''); ?>
                    <div class="clearfix"></div>


                </td>
                <td><i class="badge"><?php echo (!empty($row->unit_price)?$row->unit_price:''); ?></i></td>


                <td><i class="badge"><?php echo (!empty($row->purchaseAmtForSales)?$row->purchaseAmtForSales:''); ?></i></td>
                <td><i class="badge"><?php echo (!empty($row->total_item)?$row->total_item:''); ?></i></td>
                <td><i class="badge"><?php echo (!empty($row->total_item*$row->purchaseAmtForSales)?$row->total_item*$row->purchaseAmtForSales:''); ?></i></td>
                <td><i class="badge"><?php echo (!empty($row->total_price)?$row->total_price:''); ?></i></td>
                <td><i class="badge"><?php echo (!empty($row->profileAmount)?$row->profileAmount:''); $profiteLose+=$row->profileAmount; ?></i></td>
            </tr>
            <?php
        }
    }
    ?>

    </tbody>
    <tfoot>
    <tr>
        <td colspan="8" class="text-right">Current Profit/Lose</td>
        <td><i class="badge"><?php echo number_format($profiteLose,2); ?></i></td>
    </tr>
    </tfoot>
</table>