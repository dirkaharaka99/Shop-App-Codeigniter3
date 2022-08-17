<style>
    .bodys{
        background-color: #00092C;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Ubah Data Barang</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body class="bodys">
    <div class="container">
        <h2 style="text-align: center; color:white;"> Ubah Data Barang</h2>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
               

                <!--Form Tambah/Ubah-->
                <div class="panel panel-default">
                    <div class="panel-heading"> Ubah Data</div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo site_url('/barang/fungsiUbah/'.$barang->kode_barang) ?>" class="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control" name="kode_barang" value="<?php echo $barang->kode_barang ?>">
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" value="<?php echo $barang->nama_barang ?>">
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="text" class="form-control" name="stok" value="<?php echo $barang->stok ?>">
                            </div>
                            <div class="form-group">
                                <label>Harga Barang</label>
                                <input type="text" class="form-control" name="harga_barang" value="<?php echo $barang->harga_barang ?>">
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="hidden" name="old_gambar_barang" value="<?php echo $barang->gambar_barang; ?>">
                                <input type="file" class="form-control" name="gambar_barang" accept="image/x-png,image/gif,image/jpeg">
                            </div>
                        
                            <!-- <input type="hidden" name="id" value="<?php echo $barang->id; ?>"> -->
                            <div class="row">
                                <div class="col-xs-1 col-md-1">
                                    <input type="submit" name="barangUpdate" class="btn btn-success" value="UPDATE" title="Klik untuk Menyelesaikan"/>
                                </div>
                                <div class="col-xs-1 col-xs-offset-5 col-sm-1 col-sm-offset-8 col-md-1 col-md-offset-8">
                                    <span class="panel-heading"><a href="<?= base_url(""); ?>" title="Klik untuk Kembali" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</a></span>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div col-md-5>
                    <img src="<?= base_url('images/'.$barang->gambar_barang) ?>" alt="Image" width="250" height="250">
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
