<?php ob_start(); ?>
<?php
// ob_end_clean();
// $content = ob_get_contents();
include "koneksi.php";
$content = '
  <style type="text/css">
    .table{border-collapse: collapse;}
    .table th{padding: 8px 5px; background-color: lightgrey;}
    .table td{padding: 8px 5px;}
  </style>
';

  $content .= '

  <page>
       <h5 align="center">Polsek SABAK AUH <br>
LAPORAN DATA SURAT MASUK POLSEK SABAK AUH <br>
Jl. Lintas Sei Pakning - Siak <br>
=======================================================</h5>
    <div align = "center">
    <table border="1" class="table" align="center">
      <tr>
                <th align="center">No</th>
                <th align="center">No Kartu Keluarga</th>
                <th align="center">Nama</th>
                <th align="center">No HP</th>
                <th align="center">Alamat</th>

            </tr>';
                                   
            $no = 1;
        $sql = mysqli_query($con,"SELECT * FROM tbl_ktp");
        while ($data = $sql->fetch_assoc()) {

      $content .='

      <tr>
                <td align="center">'.$no++.'</td>
                <td>'.$data['no_kk'].'</td>
                <td>'.$data['nama'].'</td>
                <td>'.$data['no_hp'].'</td>
                <td>'.$data['alamat'].'</td>
   
          </tr>
            ';
            }
        $content .='
        </table>
        </div>
    </page>';                 
                                        
  require_once('assets/html2pdf/html2pdf.class.php');
  // $html2pdf = new HTML2PDF('L','A4','fr');
    $html2pdf = new HTML2PDF('P', 'A5', 'en');
  $html2pdf -> WriteHTML($content);
   ob_end_flush();
  $html2pdf -> Output('doc.pdf', 'FI');
?>