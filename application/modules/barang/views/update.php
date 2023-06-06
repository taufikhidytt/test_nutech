<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $judul?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('barang')?>">Data Barang</a></li>
            <li class="breadcrumb-item active"><?= $judul?></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <div class="card-title">
            <a href="<?= base_url('barang')?>" class="btn btn-secondary btn-sm">
                <i class="fa fa-reply-all"></i> Back
            </a>
        </div>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="id" id="id" value="<?= $data->id_barang?>">
                <label for="nama_barang">Nama Barang :</label>
                <input type="text" class="form-control <?= form_error('nama_barang') ? 'is-invalid' : null ?>" id="nama_barang" name="nama_barang" placeholder="Masukan Nama Barang" value="<?= $this->input->post('nama_barang') ?? $data->nama_barang ?>">
                <span class="text-red"><?= form_error('nama_barang')?></span>
            </div>
            <div class="form-group">
                <label for="harga_beli">Harga Beli :</label>
                <input type="number" class="form-control <?= form_error('harga_beli') ? 'is-invalid' : null ?>" id="harga_beli" name="harga_beli" placeholder="Masukan Harga Beli" value="<?= $this->input->post('harga_beli') ?? $data->harga_beli ?>">
                <span class="text-red"><?= form_error('harga_beli')?></span>
            </div>
            <div class="form-group">
                <label for="harga_jual">Harga Jual :</label>
                <input type="number" class="form-control <?= form_error('harga_jual') ? 'is-invalid' : null ?>" id="harga_jual" name="harga_jual" placeholder="Masukan Harga Jual" value="<?= $this->input->post('harga_jual') ?? $data->harga_jual ?>">
                <span class="text-red"><?= form_error('harga_jual')?></span>
            </div>
            <div class="form-group">
                <label for="stock">Stock :</label>
                <input type="number" class="form-control <?= form_error('stock') ? 'is-invalid' : null ?>" id="stock" name="stock" placeholder="Masukan Stock Barang" value="<?= $this->input->post('stock') ?? $data->stock ?>">
                <span class="text-red"><?= form_error('stock')?></span>
            </div>
            <div class="form-group">
                <label for="photo_barang">Photo Barang :</label>
                <input type="file" class="form-control <?= form_error('photo_barang') ? 'is-invalid' : null ?>" id="photo_barang" name="photo_barang" placeholder="Masukan Photo Barang" value="<?= $this->input->post('photo_barang')?>">
                <span class="text-red"><?= form_error('photo_barang')?></span>
                <span class="text-warning">
                  <ul>
                    <li>max 100kb</li>
                    <li>format jpg, png</li>
                  </ul>
                </span>
            </div>
            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-check"></i> Submit
            </button>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->