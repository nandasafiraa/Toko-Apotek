<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
  <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Data Kategori Obat</h6>
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
                                <th>NO</th><th>ID</th><th>NAMA KATEGORI</th><th>Aksi</th>
                              </tr>
                              <?php
                              $no=0;
                              foreach ($data_kategori as $dt_kat) {
                                $no++;
                                echo '<tr style="text-align: center;">
                                <td >'.$no.'</td>
                                <td>'.$dt_kat->id_kategori.'</td>
                                <td>'.$dt_kat->nama_kategori.'</td>
                                <td><a href="#update_kategori" class="btn btn-warning" data-toggle="modal" onclick="tm_detail('.$dt_kat->id_kategori.')">Update</a> <a href="'.base_url('index.php/Kategori/hapus_kategori/'.$dt_kat->id_kategori).'" class="btn btn-danger" onclick="return confirm(\'Serius Mau menghapus?\')">Delete</a></td>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Kategori</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/kategori/simpan_kategori')?>" method="post">
        Nama Kategori
        <input type="text" name="nama_kategori" class="form-control"><br>
        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update_kategori">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Update Kategori</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/Kategori/update_kategori')?>" method="post">
        <input type="hidden" name="id_kategori" id="id_kategori">  
        Nama Kategori
        <br>
        <input id="nama_kategori" type="text" name="nama_kategori" class="form-control"><br>
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

  function tm_detail(id_kat) {
    $.getJSON("<?=base_url()?>index.php/Kategori/get_detail_kategori/"+id_kat,function(data){
      $("#id_kategori").val(data['id_kategori']);
      $("#nama_kategori").val(data['nama_kategori']);
      
    });
  }
</script>