<?php
if(isset($_GET['update'])){
    include('koneksi.php');
       $id = $_GET['id'];
       $nis = $_GET['nis'];
       $nama = $_GET['nama'];
       $kelas = $_GET['kelas'];
       $jurusan = $_GET['jurusan'];
       $tanggal_lahir =$_GET['tanggal_lahir'];
       $no_telpon = $_GET['no_telpon'];
       $alamat = $_GET['alamat'];
       $jenis_kelamin = $_GET['jenis_kelamin'];

    $query_update = mysqli_query($koneksi,"UPDATE anggota
    SET nis ='$nis', nama ='$nama', kelas ='$kelas', jurusan ='$jurusan', tanggal_lahir ='$tanggal_lahir', no_telpon ='$no_telpon', alamat ='$alamat', jenis_kelamin ='$jenis_kelamin'
    WHERE id_anggota='$id'
    ");
    if ($query_update) {
        ?>
        <script>
            alert('data berhasil di ubah');
        </script>
        <?php
        header('refresh:0  URL=http://localhost/15_mywebsite_12RPL2/admin.php?page=anggota');
    }
}
?>


<?php
            if (isset($_POST['save'])) {
                $nis            = $_POST['nis'];
                $nama           = $_POST['nama'];
                $kelas          = $_POST['kelas'];
                $jurusan        = $_POST['jurusan'];
                $tanggal_lahir  = $_POST['tanggal_lahir'];
                $no_telepon     = $_POST['no_telpon'];
                $alamat         = $_POST['alamat'];
                $jenis_kelamin  = $_POST['jenis_kelamin'];
                $query_insert = mysqli_query($koneksi,"INSERT INTO anggota VALUES('','$nis','$nama','$kelas','$jurusan','$tanggal_lahir','$no_telepon','$alamat','$jenis_kelamin')");
        
        
        
        if ($query_insert) {
            header('refresh:1  URL=http://localhost/15_mywebsite_12RPL2/admin.php?page=anggota');
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            BERHASIL DITAMBAHKAN
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        }else{
            echo "Data Gagal Disimpan";
        }
        
    }elseif(isset($_GET['hapus'])){
        $id = $_GET['id'];
        $query_delete = mysqli_query($koneksi,"DELETE FROM anggota WHERE id_anggota = '$id'");
       if ($query_delete) {
        header('refresh:1 URL=http://localhost/15_mywebsite_12RPL2/admin.php?page=anggota');
          ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data Berhasil Di Hapus
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
       }
       }
?>
<!-- <h3 align=center>DATA ANGGOTA</h3> -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputmodal">
  Tambah Data
</button>
<br>
<table class="table table-dark">
    
    <tr class="text-center">
        <th>NO</th>
        <th>NIS</th>
        <th>NAMA</th>
        <th>KELAS</th>
        <th>JURUSAN</th>
        <th>TANGGAL LAHIR</th>
        <th> NO TELEPON</th>
        <th>ALAMAT</th>
        <th>JK </th>
        <th>ACTION</th>
    </tr>
    <?PHP
    $no =1;
    $query = mysqli_query($koneksi,"SELECT * FROM anggota");
    foreach ($query as $row ) {
  
    ?>
    <tr >
        <td class="text-center" valign=middle><?php echo $no?></td>
        <td class="text-center" valign=middle><?php echo $row['nis']?></td>
        <td valign=middle><?php echo $row['nama']?></td>
        <td class="text-center" valign=middle><?php echo $row['kelas']?></td>
        <td valign=middle>
        <?php
        if ($row['jurusan']=='RPL') {
            echo "Rekayasa Perangkat Lunak";
        }elseif ($row['jurusan']=='TAV') {
            echo "Teknik Audio Video";
        }elseif ($row['jurusan']=='TKR') {
            echo "Teknik Kendaraan Ringan";
        }else {
            echo "Teknik Instalasi Tenaga Listrik";
        }
        ?>
        <?php echo $row['jurusan']?>
        </td>
        <td class="text-center" valign=middle><?php echo $row['tanggal_lahir']?></td>
        <td class="text-center" valign=middle><?php echo $row['no_telpon']?></td>
        <td valign=middle><?php echo $row['alamat']?></td>
        <td class="text-center" valign=middle><?php echo $row['jenis_kelamin']?></td>        
        <td class="text-center" valign=middle>
        <a href="?page=anggota&hapus&id=<?php echo $row['id_anggota']; ?>">
        <button class="btn btn-danger" ><i class="far fa-trash-alt"></i></button></a>
        <a href="?page=anggota&edit&id=<?php echo $row['id_anggota']; ?>">
        <button  class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="edit-Modal"><i class="fas fa-edit"></i></button></a>
        </td>
    </tr>
    <?php
    $no++;
    }
    ?>

</table>


<!-- Modal input -->
<div class="modal fade" id="inputmodal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inputModalLabel">Form Input Data Anggota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form  action="" method="post"> 
        <div class="formm-group mb-2">
            <input class="form-control" type="text" name="nis" placeholder="NIS" required>
        </div>
        <div class="form-group mb-2">
            <input class="form-control" type="text" name="nama" placeholder="NAMA" required>
        </div>

        <div class="form-group mb-2">
           <select class="form-control" name="kelas" placeholder="KELAS" required>
           <option value="">-Pilih Kelas-</option>
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
            </select>
        </div>
        <div class="form-group mb-2">
           <select class="form-control" name="jurusan" placeholder="JURUSAN" required >
           <option value="">-Pilih Jurusan-</option>
            <option value="RPL">REKAYASA PERANGKAT LUNAK</option>
            <option value="TKR">TEKNIK KENDARAAN RINGAN </option>
            <option value="TITL">TEKNIK INSTALASAI TENAGA LISTRIK</option>
            <option value="TAV">TEKNIK AUDIO VIDEO </option>
            </select>
        </div>
        <div class="input-group mb-2">
        <span class="input-group-text">Tanggal Lahir</span>
            <input class="form-control" type="date" name="tanggal_lahir" placeholder="TANGGAL LAHIR" required>
        </div>
        <div class="from-group mb-2">
            <input class="form-control" type="text" name="no_telpon" placeholder="NO TELEPON" required>
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="alamat" required></textarea>
            <label for="floatingTextarea2">Alamat</label>
        </div>
        <div class="from-group ">
            <select class="form-control" name="jenis_kelamin" required >
            <option value="">-Pilih Jenis Kelamin-</option>
                <option value="L">Laki - Laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

            

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal input-->

<!-- modal edit-->
    <?php
        if (isset($_GET['edit'])) {
        $id =$_GET['id'];
        $query = mysqli_query($koneksi,"SELECT * FROM anggota WHERE id_anggota ='$id'");
        foreach ($query as $row){
    ?>
    <script>
        $(document).ready(function(){
            $("#edit-modal").modal('show');
        });
    </script>
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form edit Data Anggota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form  action="anggota.php" method="get"> 
        <input type="hidden" name="id" value="<?php echo $row['id_anggota']; ?>">
        <div class="formm-group mb-2">
            <input value="<?php echo $row['nis']; ?>" class="form-control" type="text" name="nis" placeholder="NIS" required>
        </div>
        <div class="form-group mb-2">
            <input value="<?php echo $row['nama']; ?>" class="form-control" type="text" name="nama" placeholder="NAMA" required>
        </div>

        <div class="form-group mb-2">
           <select value="<?php echo $row['kelas']; ?>" class="form-control" name="kelas" placeholder="KELAS" required>
           <option value="<?php echo $row['kelas']; ?>">
           <?php
                if ($row['kelas']=='x') {
                    echo "X";
                }elseif ($row['kelas']=='xi') {
                    echo "XI";
                }else{
                    echo "XII";
                }
           ?>
           </option>
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
            </select>
        </div>
        <div class="form-group mb-2">
           <select  class="form-control" name="jurusan" placeholder="JURUSAN" required >
           <option value="<?php echo $row['jurusan']; ?>">
           <?php
                    if ($row['jurusan']=='RPL') {
                        echo "Rekayasa Perangkat Lunak";
                    }elseif ($row['jurusan']=='TAV') {
                        echo "Teknik Audio Video";
                    }elseif ($row['jurusan']=='TKR') {
                        echo "Teknik Kendaraan Ringan";
                    }else {
                        echo "Teknik Instalasi Tenaga Listrik";
                    }
            ?>
           </option>
            <option value="RPL">REKAYASA PERANGKAT LUNAK</option>
            <option value="TKR">TEKNIK KENDARAAN RINGAN </option>
            <option value="TITL">TEKNIK INSTALASAI TENAGA LISTRIK</option>
            <option value="TAV">TEKNIK AUDIO VIDEO </option>
            </select>
        </div>
        <div class="input-group mb-2">
        <span class="input-group-text">Tanggal Lahir</span>
            <input value="<?php echo $row['tanggal_lahir']; ?>" class="form-control" type="date" name="tanggal_lahir" placeholder="TANGGAL LAHIR" required>
        </div>
        <div class="from-group mb-2">
            <input value="<?php echo $row['no_telpon']; ?>" class="form-control" type="text" name="no_telpon" placeholder="NO TELEPON" required>
        </div>
        <div class="form-floating">
            <textarea  class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="alamat" required><?php echo $row['alamat']; ?></textarea>
            <label for="floatingTextarea2">Alamat</label>
        </div>
        <div class="from-group ">
            <select value="<?php echo $row['jenis_kelamin']; ?>" class="form-control" name="jenis_kelamin" required >
            <option vvalue="<?php echo $row['jenis_kelamin']; ?>">
                <?php
                        if ($row['jenis_kelamin']=='l') {
                            echo "Laki-Laki";
                        }else  {
                            echo "Perempuan";
                        }
                ?>
            </option>
                <option value="l">Laki - Laki</option>
                <option value="p">Perempuan</option>
            </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php
}
}
?>