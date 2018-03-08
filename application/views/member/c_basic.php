<?php  
	if (isset($url)) {
		// cek apakah member dapat mengakses premium content
		// buat tingkatan kekuatannya dulu
		$tingkat_konten = 1;
		$hak_akses = 1;
		if ($isi[0]['status'] == 'premium') {
			$tingkat_konten = 2;
		}
		if ($status == 'premium') {
			$hak_akses = 2;
		}
		if ($hak_akses < $tingkat_konten) {
?>
<img src="<?=base_url('asset/member/img/sad.png')?>" alt="" class="sorry">
<p class="deskripsi pesan-sorry" style="text-align: center">
	Maaf Keanggotaan anda saat ini tidak dapat mengakses halaman ini. Untuk mengakses lakukan upgrade terlebih dahulu dengan <br> 
	<a href="<?=base_url('member/dashboard/upgrade')?>" class="btn-besar">Klik Disini</a>
</p>
<?php
		} else {
?>
<div class="frame_video">
	<div class="video">
		<?=$isi[0]['content']?>
	</div>
	<div class="judul">
		<?=$isi[0]['judul']?>
	</div>
	<div class="time">
		<i class="fa fa-clock"></i> <?=$isi[0]['date']?>
	</div>
	<div class="author">
		<i class="fa fa-user"></i> <button type="button" data-toggle="modal" data-target="#myModal"> <?=$isi[0]['author']?></button>
		
	</div>
</div>
<?php	
		} //untuk tingkat konten
	} else {
		$banyak_data = count($content) - 1;
		if ($banyak_data == -1) {
?>
	<img src="<?=base_url('asset/member/img/sad.png')?>" alt="" class="sorry">
	<p class="deskripsi pesan-sorry" style="text-align: center">
		Belum Terdapat Materi untuk Bagian Ini
	</p>
<?php
		} else {
?>
<h3>List of Content : </h3>
<table class="table table-hover" id="tabelnya">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Daftar Materi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php  
      	for($i = 1;$i <= count($content)-1;++$i) {
      		echo "<tr>";
      		echo "<td># ".$i."</td>";
      		echo "<td>";
      		echo anchor("member/dashboard/$page/".$content[$i-1]['link'],$content[$i-1]['judul']);
      		if ($content[$i-1]['status'] == 'premium') {
	      		echo "<div class='premium-badge'>";
	      		echo strtoupper($content[$i-1]['status']);
	      		echo "</div>";
      		}
      		echo "</td>";
      		echo "</tr>";
		}// punya for

      ?>
    </tr>
  </tbody>
</table>
<?php

		}// punya else yg jika data == 0
	}
?>
