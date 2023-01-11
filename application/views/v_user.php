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
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Level</th>
                                <th>Aksi</th>
                              </tr>
                              <?php
                              $no=0;
                              foreach ($data_user as $dt_ser) {
                                $no++;
                                echo '<tr style="text-align: center;">
                                <td>'.$no.'</td>
                                <td>'.$dt_ser->id_user.'</td>
                                <td>'.$dt_ser->nama_user.'</td>
                                <td>'.$dt_ser->username.'</td>
                                <td>'.$dt_ser->password.'</td>
                                <td>'.$dt_ser->level.'</td>
                                <td><a href="#update_user" class="btn btn-warning" data-toggle="modal" onclick="tm_detail('.$dt_ser->id_user.')">Update</a> <a href="'.base_url('index.php/User/hapus_user/'.$dt_ser->id_user).'" class="btn btn-danger" onclick="return confirm(\'Serius Mau menghapus?\')">Delete</a></td>
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
        <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/User/simpan_user')?>" method="post">
        Nama User
        <input type="text" name="nama_user" class="form-control"><br>
        username
        <input type="text" name="username" class="form-control"><br>
        password
        <input type="text" name="password" class="form-control"><br>
        level
        <input type="text" name="level" class="form-control"><br>

        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update_user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Update User</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <form action="<?=base_url('index.php/User/update_user')?>" method="post">
        <input type="hidden" name="id_user" id="id_user">  
        Nama User
        <input id="nama_user" type="text" name="nama_user" class="form-control"><br>
        username
        <input id="username" type="text" name="username" class="form-control"><br>
        password
        <input id="password" type="text" name="password" class="form-control"><br>
        level
        <input id="level" type="text" name="level" class="form-control"><br>

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

  function tm_detail(id_ser) {
    $.getJSON("<?=base_url()?>index.php/User/get_detail_user/"+id_ser,function(data){
      $("#id_user").val(data['id_user']);
      $("#nama_user").val(data['nama_user']);
      $("#username").val(data['username']);
      $("#password").val(data['password']);
      $("#level").val(data['level']);

    });
  }
</script>