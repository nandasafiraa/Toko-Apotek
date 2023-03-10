<div class="main-content">
	<div class="container-fluid">
		<h3 class="page-title">Transaksi</h3>
		<?php
			$notif = $this->session->flashdata('notif');
			if($notif != NULL){
				echo '
					<div class="alert alert-danger">'.$notif.'</div>
				';  
			}
		?>

		<div class="row">
			<div class="col-md-12">
				<div class="panel"> 
					<div class="panel-heading">Cari obat</div>
					<div class="panel-body">
						<form action="<?php echo base_url('index.php/transaksi/cari_obat') ?>" method="post">
							<div class="row">
								<div class="col-md-9">
									<input type="text" class="form-control input-lg" placeholder="Nama Obat" name="nama_obat" required>
								</div>
								<div class="col-md-3">
									<input type="submit" class="btn btn-info btn-lg btn-block" name="submit" value="TAMBAH">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">KERANJANG BELANJA</div>
					<div class="panel-body">

						<form action="<?php echo base_url('index.php/transaksi/bayar'); ?>" method="post">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Obat</th>
										<th>Tanggal Kadaluarsa</th>
										<th>Jumlah</th>
										<th>Sub Total</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								
								<?php
									$no = 1;
									if($cart_transaksi != NULL){
										foreach ($cart_transaksi as $cart) {

											echo '
												<tr>
													<input type="hidden" name="id_obat[]" value="'.$cart->id_obat.'">
													<td>'.$no.'</td>
													<td>'.$cart->nama_obat.'</td>
													<td>'.$cart->tanggal_kaduluarsa.'</td>
													<td>
														<input type="number" name="jumlah[]" class="form-control" onchange="hitung_subtotal('.$cart->id.','.$cart->harga.',this.value,'.$cart->id_obat.')" value="'.$cart->jumlah.'">
													</td>
													<td><span id="subtot_'.$cart->id.'">'.$cart->harga*$cart->jumlah.'</span></td>
													<td>
														<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus_cart" onclick="prepare_hapus_cart('.$cart->id.')">Hapus</a>
													</td>
												</tr>
											';
											$no++;
										}
									} else {
										echo '
											<tr>
												<td colspan="8">
													Keranjang belanja kosong.
												</td>
											</tr>
										';
									}
								?>
								</tbody>
							</table>
							<?php
								if($cart_transaksi != NULL)
								{
									echo '
										<div class="row">
											<div class="col-md-4">
												<h1 style="margin:0">Rp <span id="total_belanja">0</span>,-</h1>
											</div>
											<div class="col-md-5">
												<input type="text" name="nama_pembeli" placeholder="NAMA PEMBELI" class="form-control input-lg" required>
											</div>
								
											<div class="col-md-3">
												<input type="submit" name="submit" value="BAYAR" class="btn btn-lg btn-default btn-primary">
											</div>

										';
								}
							?>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal_hapus_cart" class="modal fade" role="dialog"> 
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Konfirmasi Hapus Item Cart</h4>
      </div>
      <form action="<?php echo base_url('index.php/transaksi/hapus_item_cart'); ?>" method="post">
	      <div class="modal-body">
	        	<input type="hidden" name="hapus_id"  id="hapus_id">
	        	<p>Apakah anda yakin menghapus produk ini di cart ?</p>
	      </div>
	      <div class="modal-footer">
	        <input type="submit" class="btn btn-default" name="submit" value="YA">
	        <button type="button" class="btn btn-danger" data-dismiss="modal">TIDAK</button>
	      </div>
      </form>
    </div>

  </div>
</div>

<script type="text/javascript">
	$.getJSON("<?php echo base_url('index.php/transaksi/get_total_belanja') ?>", function(data){
        $("#total_belanja").text(data.total);
    });

	function prepare_hapus_cart(id)
	{
		$("#hapus_id").val(id);
	}

	function hitung_subtotal(id,harga,qty,id_obat)
	{
		var price;
		price = harga*qty;
		$("#subtot_"+id).text(price);
		
		$.post("<?php echo base_url('index.php/transaksi/ubah_jumlah_cart') ?>",
	    {
	    	id: id,
	    	id_obat: id_obat,
	        jumlah: qty
	    }, function(data, status){
	    	console.log(data);
	    	if(data == '0'){
	    		alert("Stok obat tidak mencukupi!");
	    	}
	    });
		
	    $.getJSON("<?php echo base_url('index.php/transaksi/get_total_belanja') ?>", function(data){
	        $("#total_belanja").text(data.total);
	    });
	}
</script>
