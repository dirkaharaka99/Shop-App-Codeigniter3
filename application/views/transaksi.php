<!-- <?php
    // var_dump($joinKodeBarang);
    ?> -->
    
    <style>
    .center {
      text-align: center;
    }
     .pagination {
      display: inline-block;
      
    }
    

    .pagination a {
      margin: 0 4px;
      border: 1px solid #ddd;
      color: white;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
    }
     .pagination a.active {
      background-color: #4CAF50;
      color: white;
    }
    
    .pagination a:hover:not(.active) {background-color: #ddd;}
    
    
    .bodys{
        background-color: #00092C;
        color: #FFF;
    }

    tr{
        border: 1px solid green;
    }
    thead{
        background-color: #0093AB;
    }
    
    td{
        background-color: #15133C;
    }

    table{
        border-color: #B1E1FF;
    }

  
    }
    
    <</style>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Daftar Transaksi</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
       
    </head>
    <body class="bodys">
        <div class="container">
            <h2 style="text-align: center; color: #FFF;">Daftar Transaksi</h2>
            <?php if($this->session->flashdata('status')):?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('status'); ?>
                        </div>
                    <?php endif; ?>
            <div class="buttonkembali" style="text-align: left;">
                <span class="panel-heading"><a href="<?= base_url("") ?>" title="Klik untuk Kembali" class="btn btn-success"><i class="glyphicon glyphicon-arrow-left"></i> Kembali Ke Daftar Barang</a></span>
            </div>
        
    
            <div class="row">
                <div class="col-md-3 search-panel">
                    <!-- Form Pencarian -->
                    <form action="<?php echo site_url('/transaksi/index') ?>" method='get'>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari data..." value="">
                        <div class="input-group-btn">
                            <button title="Klik untuk Mencari" class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-md-4 col-md-offset-5">
                    <!--  link tambah -->
                    <span class="pull-right tambahbutton">
                        <a href="<?php echo site_url('/transaksi/halaman_tambah') ?>" title="Klik untuk Menambah Data" class="btn btn-primary"><i  class="glyphicon glyphicon-plus"></i> Tambah Data</a>
                        <br>
                    </span>
                </div>
            </div>
            <!-- list Tabel Data --> 
            <table colspan="5" class="table table-striped table-bordered">
                <br>
                <thead >
                    <tr>
                        <th>Id</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Jumlah Harga</th>
                        <th>Created At</th>
                        <th>Updated_at</th>
                        <th>Aksi</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(!empty($joinKodeBarang)){ $count = 0; 
                        foreach($joinKodeBarang as $transaksi){ $count++;
                    ?>
                    <tr>
                        <td><?php echo '#'.$count; ?></td>
                        <td><?php echo $transaksi->kode_barang; ?></td>
                        <td><?php echo $transaksi->nama_barang; ?></td>
                        <td><?php echo $transaksi->qty; ?></td>
                        <td><?php echo 'Rp ' . number_format($transaksi->jumlah_harga,2,",","."); ?></td>
                        <td><?php echo date('d M Y H:i:s',strtotime($transaksi->created_at)); ?></td>
                        <td><?php echo date('d M Y H:i:s',strtotime($transaksi->updated_at)); ?></td>
                        <td>
                            <a title="Sunting" href="<?php echo site_url('/transaksi/halaman_ubah');?>/<?php echo $transaksi->id; ?>" style="color:white"class="glyphicon glyphicon-edit"></a>
                            <a title="Hapus" href="<?php echo site_url('/transaksi/fungsiDelete');?>/<?php echo $transaksi->id; ?>" style="color:white" class="glyphicon glyphicon-trash" onclick="return confirm('Yakin ingin Menghapus Data?')"></a>
                        </td>
                    </tr>
                    <?php } }else{ ?>
                    <tr><td colspan="5">DATA TIDAK TERSEDIA</td></tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
            
          
         
        </div>
          <!-- Menampilkan pagination links -->
        <div class="center">
            <div class="pagination">
                 <?php echo $pagination ?>
            </div>
        </div>
    </body>
    </html>