<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary" style="text-align: center;">Data Kategori Obat</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <a href="#tambah" class="btn btn-primary btn-icon-split" data-toggle="modal">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Tambah</span>
                  </a>
                              <table class="table table-hover table-striped">
                                <tr style="text-align: center;">
                                <th>ID Obat</th>
                                <th>Kode</th>
                                <th>Nama Obat</th>
                                <th>Foto</th>
                                <th>Tgl Kaduluarsa</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>ID Kat</th>
                                <th>AKSI</th>
                              </tr>
                              <?php
                              $no=0;
                              foreach ($arr as $dt_bat) {
                                $no++;
                                echo '<tr style="text-align: center;">
                                <td>'.$dt_bat->id_obat.'</td>
                                <td>'.$dt_bat->kode_obat.'</td>
                                <td>'.$dt_bat->nama_obat.'</td>
                                <td><img src='.base_url("asset/foto/$dt_bat->foto").' width="100px" height="100px"></img></td>
                                <td>'.$dt_bat->tanggal_kaduluarsa.'</td>
                                <td>'.$dt_bat->stok.'</td>
                                <td>'.$dt_bat->harga.'</td>
                                <td>'.$dt_bat->nama_kategori.'</td>
                                <td><a href="#update_obat" class="btn btn-warning" data-toggle="modal" onclick="tm_detail('.$dt_bat->id_obat.')">Update</a> <a href="'.base_url('index.php/Obat/hapus_obat/'.$dt_bat->id_obat).'" class="btn btn-danger" onclick="return confirm(\'Serius Mau menghapus?\')">Delete</a></td>
                                </tr>';
                              }
                              ?>

                              </table>
                              <?php if($this->session->flashdata('pesan')!=null): ?>
                              <div class= "alert alert-danger"><?= $this->session->flashdata('pesan');?></div>
                              <?php endif?>
                            </div>
                </div>
  </div>
</div>
                    

                <!-- Modal -->
<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Tambah Obat</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/Obat/simpan_obat')?>" method="post" enctype="multipart/form-data">
        Kode Obat
        <input type="text" name="kode_obat" class="form-control"><br>
        Nama Obat
        <input type="text" name="nama_obat" class="form-control"><br>
        Upload Foto
       <input type="file" name="foto" class="form-control"><br>
        Tanggal Kaduluarsa
        <input type="date" name="tanggal_kaduluarsa" class="form-control"><br>
        Stok
        <input type="text" name="stok" class="form-control"><br>
        Harga
        <input type="text" name="harga" class="form-control"><br>

        <select name="id_kategori" class="form-control">
        <?php
        foreach ($data_kategori as $kat) {
          echo "<option value= '".$kat->id_kategori."'>
          ".$kat->nama_kategori."
          </option>";
        }
         ?>
       </select><br>
        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update_obat">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Update Obat</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/Obat/update_obat')?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_obat" id="id_obat">  
        Kode Obat
        <input id="kode_obat" type="text" name="kode_obat" class="form-control"><br>
        Nama Obat
        <input id="nama_obat" type="text" name="nama_obat" class="form-control"><br>
        Upload Foto
       <input type="file" name="foto" class="form-control"><br>
        Tanggal Kaduluarsa
        <input id="tanggal_kaduluarsa" type="date" name="tanggal_kaduluarsa" class="form-control"><br>
        Stok
        <input id="stok" type="text" name="stok" class="form-control"><br>
        Harga
        <input id="harga" type="text" name="harga" class="form-control"><br>

        <select id="id_kategori" name="id_kategori" class="form-control">
        <?php
        foreach ($data_kategori as $kat) {
          echo "<option value= '".$kat->id_kategori."'>
          ".$kat->nama_kategori."
          </option>";
        }
         ?>
       </select><br>
        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<script>

  function tm_detail(id_bat) {
    $.getJSON("<?=base_url()?>index.php/Obat/get_detail_obat/"+id_bat,function(data){
      $("#id_obat").val(data['id_obat']);
      $("#kode_obat").val(data['kode_obat']);
      $("#nama_obat").val(data['nama_obat']);
      $("#tanggal_kaduluarsa").val(data['tanggal_kaduluarsa']);
      $("#stok").val(data['stok']);
      $("#harga").val(data['harga']);
      $("#id_kategori").val(data['id_kategori']);

    });
  }
</script>