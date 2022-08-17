
<style>
    .pesanvalidasi{
        color: red;
    }

    .bodys{
        background-color: #00092C;
    }
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Data Barang</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body class="bodys
">
    <div class="container">
        <h2 style="text-align: center; color: white; "> Tambah Data Barang</h2>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">

              

                <!--Form Tambah/Ubah-->
                <div class="panel panel-default">
                    <div class="panel-heading">Tambah Data </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo site_url('/barang/fungsiTambah') ?>" class="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control" name="kode_barang" value="">
                                <small  class="pesanvalidasi"><?php echo form_error('kode_barang'); ?></small>
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" value="">
                                <small class="pesanvalidasi"><?php echo form_error('nama_barang'); ?></small>
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="text" class="form-control" name="stok" value="">
                                <small class="pesanvalidasi"><?php echo form_error('stok'); ?></small>
                            </div>
                            <div class="form-group">
                                <label>Harga Barang</label>
                                <input type="text" class="form-control" name="harga_barang" value="">
                                <small class="pesanvalidasi"><?php echo form_error('harga_barang'); ?></small>
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" class="form-control" name="gambar_barang" accept="image/x-png,image/gif,image/jpeg" value="">
                                <!-- <small class="pesanvalidasi"> <?php echo $imageError; ?></small> -->
                                <small><?php if(isset($imageError)){echo $imageError;} ?></small>
                            </div>
                        
                            <input type="hidden" name="id" value="">
                            <div class="row">
                                <div class="col-xs-1 col-md-1">
                                    <input type="submit" name="barangSubmit" class="btn btn-success" value="MASUKKAN" title="Klik untuk Menyelesaikan"/>
                                </div>
                                <div class="col-xs-1 col-xs-offset-5 col-sm-1 col-sm-offset-8 col-md-1 col-md-offset-8">
                                    <span class="panel-heading"><a href="<?= base_url("");?>" title="Klik untuk Kembali" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</a></span>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    
</body>
</html>