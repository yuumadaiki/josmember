<div class="content table-responsive table-full-width">
    <table class="table table-striped">
        <thead>
          <th>No</th>
        	<th>Nama</th>
        	<th>Status</th>
          <th>Bukti Pembayaran</th>
          <th>Aksi</th>
        </thead>
        <tbody>
            <?php  
                $no = 1;
                if ($upgrade == NULL) {
                    echo "<tr>";
                    echo "<td colspan='5' style='text-align: center'>";
                    echo "Belum ada member yang menguprade";
                    echo "</td>";
                    echo "</tr>";
                } else {
                    foreach ($upgrade as $row) {
                              echo "<tr>";
                              echo "<td>$no</td>";
                              echo "<td>".$row['id_member']."</td>";
                              echo "<td>".$row['status']."</td>";
                              echo "<td><a href='".base_url("upload/bukti_pembayaran/$row[bukti_pembayaran]")."'>Lihat</a></td>";
                              echo "<a href='".base_url("admin/hapus/$row[id]")."' class='btn btn-default btn-danger'>Hapus</a>";
                              echo "</td>";
                              echo "</tr>";
                              $no++;
                          }      
                }
            ?>
        </tbody>
    </table>
    <?php  
        // print_r($member);
    ?>
</div>