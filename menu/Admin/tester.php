<?php  
session_start();
include "../../database/db_conection.php"; 
if(!$_SESSION['username'])  
{  
  
    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.  
}   
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Exam Tarumanagara Unversity</title>
    <style type="text/css" class="init">

    body { font-size: 140%; }
    div.DTTT { margin-bottom: 0.5em; float: right; }
    div.dataTables_wrapper { clear: both; }

    </style>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Form Validation CSS -->
    <link rel="stylesheet" href="../dist/css/formValidation.css"/>

    <!-- Bootstrap Basic CSS -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.css"/>

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="../dist/css/demo_table_jui.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="../dist/css/dataTables.tableTools.css" rel="stylesheet">
    <!-- <link href="http://192.168.2.2/share/real/menu/Admin/DataTables-1.10.7/media/css/jquery.dataTables.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- JQUERY JS -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/jquery/dist/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Form Validation JS -->
    <script type="text/javascript" src="../dist/js/formValidation.js"></script>

    <!-- BootStrap JS -->
    <script type="text/javascript" src="../dist/js/framework/bootstrap.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>


    <!-- DataTables JavaScript -->

    <script src="../bower_components/datatables/media/js/jquery.dataTables.js"></script>
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../dist/js/dataTables.tableTools.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>

    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

        <div id="konten">
            <?php
            $pages_dir = 'test';
            if(!empty($_GET['p'])){
                $pages = scandir($pages_dir, 0);
                unset($pages[0], $pages[1]);
     
                $p = $_GET['p'];
                if(in_array($p.'.php', $pages)){
                    include($pages_dir.'/'.$p.'.php');
                } else {
                    echo 'Halaman tidak ditemukan! :(';
                }
            } else {
                include($pages_dir.'/home.php');
            }
            ?>
        </div>
    <!-- /#wrapper -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    // $(document).ready(function() {
    //     var table = $('#tabel-list').DataTable();
    //     var tt = new $.fn.dataTable.TableTools( table );

    //     $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');

    // } );
    // $(document).ready(function() {
    //     $('#tabel-list').DataTable( {
    //         responsive: true,
             
    //         "dom": 'T<"clear">lfrtip',
    //         "oTableTools": {
    //             "sSwfPath": "../dist/swf/copy_csv_xls_pdf.swf",
                 
    //             "aButtons": [
    //             "xls",
    //             {
    //                 "sExtends": "pdf",
    //                 "sPdfOrientation": "landscape"
    //             }]
    //         }           
    //      });
    // });  
    
    // $(document).ready(function() {
    // $('#tabel-list').DataTable({ 
    // "sPaginationType": "full_numbers",
    // "sDom": 'T<"clear">lfrtip',
    // "oTableTools": {
    // "sSwfPath": "../dist/swf/copy_csv_xls_pdf.swf"
    // }
    // });
    // } );

    $(document).ready(function() {
        $('#tabel-list').DataTable( {
                "sPaginationType": "full_numbers",
            dom: 'T<"clear">lfrtip',
            tableTools: {
                "sSwfPath": "../dist/swf/copy_csv_xls_pdf.swf"
            }
        } );
    } );

    $(document).ready(function() {
    $('#registrationForm')
        // .find('[name="selectmatakul"]')
        //     .selectpicker()
        //     .change(function(e) {
        //         // revalidate the color when it is changed
        //         $('#registrationForm').formValidation('revalidateField', 'selectmatakul');
        //     })
        //     .end()
        // .find('[name="selectkelas"]')
        //     .selectpicker()
        //     .change(function(e) {
        //         // revalidate the language when it is changed
        //         $('#registrationForm').formValidation('revalidateField', 'selectkelas');
        //     })
            // .end()
    .formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            // selectmatakul: {
            //         validators: {
            //             notEmpty: {
            //                 message: 'Please select your native language.'
            //             }
            //         }
            //     },
            // selectkelas: {
            //         validators: {
            //             notEmpty: {
            //                 message: 'Please select your native language.'
            //             }
            //         }
            //     },
            nim: {
                validators: {
                    digits: {
                        message: 'NIM Hanya dalam bentuk digit'
                    },
                    notEmpty: {
                        message: 'NIM harus di isi'
                    }
                }
            },
            nama: {
                validators: {
                    notEmpty: {
                        message: 'Nama harus di isi'
                    }
                }
            },
            telp: {
                validators: {
                    digits: {
                        message: 'Hanya dalam bentuk digit'
                    },
                    notEmpty: {
                        message: 'Telephone harus di isi'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'Masukan email yang valid'
                    }
                }
            },
            angkt: {
                  validators: {
                    digits: {
                        message: 'Hanya dalam bentuk digit'
                    },
                    notEmpty: {
                        message: 'Telephone harus di isi'
                    }
                }
            }
        }
    });
});
</script>
</body>

</html>

