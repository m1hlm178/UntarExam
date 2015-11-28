<!doctype html>
<html>
    <head>
        <title>Harviacode - Datatables</title>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/dataTables.bootstrap.css"/>
    </head>
    <body>
        <div class="container">
            <table id="provinsi" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="10%">Nomor</th>
                        <th width="15%">Provinsi</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Data mentah yang ditampilkan ke tabel    
                    mysql_connect('192.168.2.2', 'root', 'samsung');
                    mysql_select_db('ne-exam');
                    $sql = mysql_query('SELECT * FROM detail_dosen');
                    $no = 1;
                    while ($r = mysql_fetch_array($sql)) {
                    $id = $r['id'];
                    ?>

                        <tr align='left'>
                            <td><?php echo  $no;?></td>
                            <td><?php echo  $r['nik']; ?></td>
                            <td><?php echo  $r['nama']; ?></td>
                            <td><?php echo  $r['telephone']; ?></td>
                            <td><?php echo  $r['email']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo  $r['id_provinsi']; ?>">Edit</a> | 
                                <a href="delete.php?id=<?php echo  $r['id_provinsi']; ?>">Delete</a>
                            </td>
                        </tr>
                     <?php
                    $no++;
                    }
                    ?>
                </tbody>
            </table>  
        </div>
        
        <script src="js/jquery-1.11.0.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="datatables/jquery.dataTables.js"></script>
        <script src="datatables/dataTables.bootstrap.js"></script>
        <script type="text/javascript">
            $(function() {
                $("#provinsi").dataTable();
            });
        </script>
    </body>
</html>