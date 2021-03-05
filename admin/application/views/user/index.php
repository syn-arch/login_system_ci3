<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title"><?php echo $judul ?></h5>
        <div class="card-tools">
          <a href="<?php echo base_url('user/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
        </div>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-12">

            <?php if ($message = $this->session->flashdata('message')): ?>
              <div class="alert alert-success">
                <strong>Berhasil</strong>
                <p><?php echo $message ?></p>
              </div>
            <?php endif ?>

            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Email</th>
                  <th>Ip Address</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $index = 1; foreach ($user as $row): ?>
                <tr>
                  <td><?php echo $index++ ?></td>
                  <td><?php echo $row['email'] ?></td>
                  <td><?php echo $row['ip_address'] ?></td>
                  <td>
                    <a class="btn btn-warning" href="<?php echo base_url('user/ubah/') . $row['id_user'] ?>"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')" href="<?php echo base_url('user/hapus/') . $row['id_user'] ?>"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>


    </div>
  </div>
</div>
</div>

