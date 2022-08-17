<style>
    .bodys{
        background-color: #00092C;
    }

    .pesanvalidasi{
        color: red;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Tambah Data Transaksi</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
</head>
<body class="bodys">
    <div class="container">
        <h2 style="text-align: center; color:white;"> Tambah Data Transaksi</h2>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <!--  Mendefinisikan action Menambah/Mengubah  -->
                <div class="panel panel-default">
                    <div class="panel-heading">Tambah Data</div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo site_url('/transaksi/fungsiTambah') ?>" class="form" enctype="multipart/form-data">
     
                        <div class="form-group">
                                <label>Kode Barang</label><br>
                                <!-- <input type="hidden" class="form-control" name="kode_barang" value=""><br> -->
                                

                                <select id="kode_barang" name="kode_barang" value="">
                                    <option value="" readonly>Silahkan pilih kode barang</option>
                               <?php           
                                    foreach($queryAllBarang as $barang){;
                                ?>
                                    <option>  <?php echo $barang->kode_barang;?> - <?php  echo $barang->nama_barang?> </option>
                                <?php } ; ?>
                                </select>
                               
                                <small class="pesanvalidasi"><?php echo form_error('kode_barang'); ?></small>
                            </div>

                            <div class="form-group">
                                <label>Qty</label>
                                <input type="text" class="form-control" name="qty" value="">
                                <small class="pesanvalidasi"><?php echo form_error('qty'); ?></small>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Harga</label>
                                <input type="text" class="form-control" name="jumlah_harga" value="">
                                <small class="pesanvalidasi"><?php echo form_error('jumlah_harga'); ?></small>
                            </div>
                           
                            <input type="hidden" name="id" value="">
                            <div class="row">
                                <div class="col-xs-1 col-md-1">
                                    <input type="submit" name="transaksiSubmit" class="btn btn-success" value="MASUKKAN" title="Klik untuk Menyelesaikan"/>
                                </div>
                                <div class="col-xs-1 col-xs-offset-5 col-sm-1 col-sm-offset-8 col-md-1 col-md-offset-8">
                                    <span class="panel-heading"><a href="<?php echo site_url('/transaksi') ?>" title="Klik untuk Kembali" class="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i> Kembali</a></span>
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

<!-- <?php 
    $query = $this->db->get('barang');
    return $query->result();
    $data = array('queryAllBarang' => $queryAllBarang);
    var_dump($data);
?> -->