<?=form_open()?>
	
	<input type="hidden" name="id" value="<?=$_SESSION['id_member']?>">

	<div class="form-group">
    	<label for="">Upload Bukti Pembayaran</label>
    	<input type="file" class="form-control-file" id="exampleFormControlFile1">
  	</div>

<?=form_close()?>
