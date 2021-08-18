<style type="text/css">
	.printArea{
		padding: 0mm 13mm;
	}
	.printItem{
		float: left;
    text-align: center;
    padding: 0mm;
    width: 28mm;
    height: 33mm;
	}
	.printProduct{
		display: block;
    	text-transform: uppercase;
    	font-size: 12px;
	}
	.printPrice{
		display: block;
    	text-transform: uppercase;
    	font-size: 12px;
	}
	.printBar{
		display: block;
    	text-transform: uppercase;
	}

	@media print {
	  .printItem{
	    page-break-after: auto;
	  }
	}
     #tableStyle td{
        border:1px solid #d0d0d0;
    } #tableStyle th{
               border:1px solid #d0d0d0;
    }
</style>


<!-- Main content -->
<section class="content">
	<div class="row no-print">

		<div class="col-md-12">
			<div class="box">
		        <div class="box-header with-border">
		          <h3 class="box-title">Print Barcode/Label</h3>
		          	<?php if($this->session->flashdata('msg')){?>
    
				        <?php echo $this->session->flashdata('msg'); ?>
				    
				    <?php }?>
		        </div>
		        <div class="box-body">
		          	<div class="row">
		          		<div class="col-md-12">
		          			<div class="form-group has-feedback">
						        <label>Add Product</label>
						        <input id="productName" class="form-control" placeholder="Add Product">
						    </div>
		          		</div>	
		          	</div>
		          	<form action="<?php echo base_url('products/printBarcodes'); ?>" method="post">
		          	<div class="row">
		          		<div class="col-md-12">
		          			<table id="tableStyle" class="table table-bordered" >
				                <thead>
				                <tr>
				                  <th>Product Name (Product Code)</th>
				                  <th style="width: 8%;">Quantity</th>
				                  <th style="width: 20%;">Product Catagory</th>
				                  <th style="width:10%;">Action</th>
				                </tr>
					            </thead>
					            <tbody id="tableDynamic">
				                
					            </tbody>
				            </table>
		          		</div>	
		          	</div>
		          	<div class="row">
		          		<div class="col-md-3">
		          			<button type="submit" class="btn  btn-primary btn-sm">Save</button>
		          			<a href="<?php echo base_url(); ?>products/printBarcodes" class="btn btn-danger btn-sm">Clear</a>
		          		</div>	

		          	</div>
		          	</form>
				</div>
		        <!-- /.box-body -->
		    </div>
		</div>
		<div class="col-md-1"></div>
	</div>
	<?php if(isset($barcodes)){ ?>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
<!--			<button type="button" onclick="window.print();" class="no-print btn btn-sm btn-success"><i class="glyphicon glyphicon-print"></i>  Print</button>-->
			<div class="box" style="border-top: 0px;margin-bottom: 0px;">
		        <div class="box-body">
		          	
		          	<div class="printArea">
		          		<?php foreach($barcodes as $barcode){ ?>
		          		<?php for($i = 0 ; $i < $barcode['productQuantity']; $i++){?>
		          		<div class="printItem">
		          			<span class="printProduct"><?php echo $barcode['productName']; ?></span>
		          			<span class="printPrice">Price <?php echo $barcode['productPrice']; ?></span>
		          			<span class="printBar"><img src="<?php echo base_url(); ?>products/genBarcode/<?php echo $barcode['productCode']; ?>" alt="50219056"></span>
		          		</div>
		          		<?php } ?>
		          		<?php } ?>
		          	</div>

		          	

				</div>
		        <!-- /.box-body -->
		    </div>
		    <button type="button" onclick="window.print();" class="no-print btn btn-block btn-success btn-flat"><i class="fa fa-print"></i>  Print</button>
		</div>

	</div>
	<?php } ?>
</section>
<!-- /.content -->

<script type="text/javascript">
	var addRowProduct = function (product) {
		var productID = $('#productID_'+ product.id).val();
		var productQuantity = parseInt($('#productQuantity_'+ product.id).val());
		
		if(productID == product.id){
			return $('#productQuantity_'+ product.id).val(productQuantity + 1);
		}
		
		return $('<tr>\n\
					<td>'+ product.value +'</td>\n\
					<td style="width: 8%;">\n\
						<input id="productQuantity_'+ product.id +'" type="text" class="form-control" name="productQuantity[]" value="1">\n\
						<input type="hidden" class="form-control" name="productName[]" value="'+ product.productName +'">\n\
						<input type="hidden" class="form-control" name="productCode[]" value="'+ product.productCode +'">\n\
						<input type="hidden" class="form-control" name="productPrice[]" value="'+ product.productPrice +'">\n\
						<input id="productID_'+ product.id +'" type="hidden" class="form-control" name="productID[]" value="'+ product.id +'">\n\
					</td>\n\
					<td style="width: 20%;">'+ product.catName +'</td>\n\
					<td style="width: 2%;">\n\
						<a href="javascript:void(0);" id="removeRow" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>\n\
					</td></tr>').appendTo('#tableDynamic');
		
	};
	
	
	$( "#productName" ).autocomplete({
      source: 'get_suggestions',
      response: function (event, ui) {
      	if(ui.content){
      		if(ui.content.length == 1){
	      		//console.log(ui.content[0]);
	      		addRowProduct(ui.content[0]);
      			$(this).val(''); 
      			$(this).focus();
      			$(this).autocomplete('close');
      			return false;
	      	}
      	}
      	
      },
      select: function (event, ui) {
      	//console.log(ui);
      	addRowProduct(ui.item);
      	$(this).val(''); return false;
      }

    });


    $(document).on("click", "#removeRow", function(e) {
		$('#removeRow').closest('tr').remove();
	});

</script>