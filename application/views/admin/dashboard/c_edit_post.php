<?php 
    // print_r($post_id) 
?>
<?=form_open()?>
	<div class="row">
        <input type="hidden" value="<?=$post_id[0]['id_content']?>" name="id_content">
		<div class="col-md-10">
			<div class="form-group col-md-8">
                <label>Judul</label>
                <input type="text" class="form-control border-input" placeholder="Judul" autofocus="" required="" name="judul" value="<?=$post_id[0]['judul']?>">
            </div>
            <div class="form-group col-md-6">
                <label>Author</label>
                <input type="text" class="form-control border-input" placeholder="Author" required="" name="author" value="<?=$post_id[0]['author']?>">
            </div>
            <div class="form-group col-md-8">
                <label>Content</label>
				<textarea rows="5" class="form-control border-input" placeholder="Post Something" name="content"><?=$post_id[0]['content']?></textarea>
            </div>
            <div class="form-group col-md-8">
            	<div class="form-group">
			    <label for="sel1">Kategori</label>
			    <select class="form-control" name="kategori">
			    	<option value="">-- PILIH KATEGORI -- </option>
			        <option value="basic" <?php  
                        if ($post_id[0]['kategori'] == 'basic') {
                            echo "selected";
                        }
                    ?>>Basic</option>
			        <option value="Advance" <?php  
                        if ($post_id[0]['kategori'] == 'Advance') {
                            echo "selected";
                        }
                    ?>>Advance</option>
			    </select>
            </div>
        	</div>
        	<div class="form-group col-md-8">
            	<div class="form-group">
			    <label for="sel1">Tingkat</label>
			    <select class="form-control" name="status">
			    	<option value="">-- PILIH tingkat -- </option>
			        <option value="free" <?php  
                        if ($post_id[0]['status'] == 'free') {
                            echo "selected";
                        }
                    ?>>FREE</option>
			        <option value="premium" <?php  
                        if ($post_id[0]['status'] == 'premium') {
                            echo "selected";
                        }
                    ?>>PREMIUM</option>
			    </select>
            </div>
            <div class="form-group">
            	<input type="submit" value="Post" class="btn btn-primary" name="tombol">
            </div>
        	</div>
		</div>
	</div>

<?=form_close()?>
