<?php
require_once 'koneksi.php';
require_once 'header1.php';
?>
<section class="gelombang">
<div class="container">
  
<br>

 <table class="table table-bordered">
  <thead align="center">
   <tr>
    <th>#</th>
    <th>Tgl. Transaksi</th>
    <th>Total Item</th>
    <th>Total Bayar</th>
    <th>Aksi</th>
   </tr>
  </thead>
  <tbody align="center">

   <?php
   $query = mysqli_query($conn, "SELECT * FROM tb_order");
   $no = 1;
   while ($dt = $query->fetch_assoc()) :
    ?>

    <tr>
     <td><?= $no++; ?></td>
     <td><?= $dt['tgl_transaksi']; ?></td>
     <td><?= $dt['total_item']; ?></td>
     <td><?= $dt['total_bayar']; ?></td>
     <td>
      <a href="detail_order.php?id_order=<?= $dt['id_order']; ?>">Detail Order</a>
     </td>
    </tr>

   <?php endwhile; ?>

  </tbody>
 </table>
</div>
</section>
<?php require_once 'footer.php'; ?>