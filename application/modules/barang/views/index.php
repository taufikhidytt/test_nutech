<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url()?>assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url()?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url()?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url()?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- DataTables  & Plugins -->
<script src="<?= base_url()?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url()?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url()?>assets/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url()?>assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url()?>assets/admin/plugins/sweetalert2/sweetalert2.min.js"></script>

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
              <li class="breadcrumb-item">Data Barang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    
    <div id="flashSuccess" data-success="<?= $this->session->flashdata('success');?>"></div>
    <div id="flashWarning" data-warning="<?= $this->session->flashdata('warning');?>"></div>
    <div id="flashError" data-error="<?= $this->session->flashdata('error');?>"></div>


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Barang</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <a href="<?= base_url('barang/add')?>" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i> Tambah
            </a>
            <br><br>
            <table class="table table-bordered table-lg-responsive table-sm-responsive table-striped text-center" id="hero">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($data->result() as $dt):?>
                    <tr>
                        <td><?= $no++;?></td>
                        <td>
                          <img class="img-fluid img-size-50" src="<?= base_url('assets/upload/'.$dt->photo_barang)?>" alt="Photo Barang">
                        </td>
                        <td><?= $dt->nama_barang?></td>
                        <td><?= $dt->harga_beli?></td>
                        <td><?= $dt->harga_jual?></td>
                        <td><?= $dt->stock?></td>
                        <td>
                            <a href="<?= base_url('barang/update/'.$dt->id_barang)?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil-alt"></i>
                            </a>  |
                            <form action="<?= base_url('barang/del')?>" method="post" class="d-inline">
                                <input type="hidden" name="id" value="<?= $dt->id_barang?>">
                                    <button class="btn btn-sm btn-danger" id="form-delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->

    <script>
        $('#hero').DataTable();

        var flashsuccess = $('#flashSuccess').data('success');
        var flashwarning = $('#flashWarning').data('warning');
        var flasherror = $('#flashError').data('error');

        if(flashsuccess)
        {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: flashsuccess,
            })
        }

        if(flashwarning)
        {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: flashwarning,
            })
        }

        if(flasherror)
        {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: flasherror,
            })
        }

        $(document).on('click', '#form-delete', function(e){
            e.preventDefault();
            var link = $(this).parent('form');
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Ingin Menghapus Data Ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Hapus Data Ini!'
            }).then((result) => {
                if (result.isConfirmed) {
                    link.submit();
                }
            })
        });
    </script>