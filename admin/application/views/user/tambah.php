<div class="row">
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h5 class="card-title"><?php echo $judul ?></h5>
        <div class="card-tools">
          <a href="<?php echo base_url('user') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-12">
            <form method="post">
              <div class="form-group">
                <label for="">ID user</label>
                <input type="number" name="id_user" id="id_user" class="form-control" placeholder="ID user" required="" value="<?php echo id('user', 'id_user') ?>" readonly>
              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email" required="">
              </div>
              <div class="form-group">
                <label for="">IP Address</label>
                <input type="text" name="ip_address" id="ip_address" class="form-control" placeholder="IP Address" required="">
              </div>
              <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="password" required="">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>

