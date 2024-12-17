<?php
$data['tittle'] = "Daftar Aset";
$this->load->view('template/head', $data);
?>

<body>
    <div id="wrapper">
        <?php $this->load->view('template/navbar'); ?>
        <!--/. NAV TOP  -->
        <?php $this->load->view('template/menu'); ?>
        <!-- /. NAV SIDE  -->

        <div id="page-wrapper">
            <div class="header">
                <h3 class="page-header">KARTU INVENTARIS BANGUNAN </h3>
                <?= $this->session->flashdata('pesan'); ?>
                <ol class="breadcrumb">
                    <li><a href="#"><?php $str = $this->session->userdata('nama_pegawai');
                                    echo wordwrap($str, 30, "<br>\n"); ?></a></li>
                    <li><a href="<?= base_url() ?>Aset/home">Home</a></li>
                    <li>Daftar Aset</li>
                    <li class="active">KIB A</li>
                </ol>
            </div>

            <div id="page-inner">
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <!-- <h4 style="font-weight:bold;">Data Kartu Inventaris Peralatan dan Mesin</h4> -->
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-sm" id="dt_kib_a">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Aset</th>
                                                <th>Kode Aset</th>
                                                <th>Tahun Pembelian</th>
                                                <th>Asal-Usul</th>
                                                <th>Kondisi <span style="color:red;">*</span></th>
                                                <th>Harga</th>
                                                <th>Umur Ekonomis</th>
                                                <th>Nilai Sisa</th>
                                                <th>Penyusutan Pertahun</th>
                                                <th>Akumulasi Penyusutan</th>
                                                <th>Nilai Sisa Tahun Ini</th>
                                                <th>Tanggal Pembelian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (is_array($kib_a)) {
                                                $i = 1;
                                                foreach ($kib_a as $b) {
                                                    $harga = 'Rp' . number_format("$b[harga]", 2, ",", ".");
                                                    $nilsisa = 'Rp' . number_format("$b[nli_sisa]", 2, ",", ".");
                                                    $penyusutan_pertahun = ($b['harga'] - $b['nli_sisa']) / $b['umr_ekonomis'];
                                                    $nilaisisa_sekarang = 'Rp' . number_format($b['harga'] - (date('Y') - $b['thn_beli']) * $penyusutan_pertahun, 2, ",", ".");
                                                    $akumulasi_penyusutan = 'Rp' . number_format($penyusutan_pertahun * $b['umr_ekonomis'], 2, ",", ".");
                                                    $penyusutan_pertahun = 'Rp' . number_format(($b['harga'] - $b['nli_sisa']) / $b['umr_ekonomis'], 2, ",", ".");

                                                    if ($b['kondisi'] == 1) {
                                                        $kondisi = "Baik";
                                                    } elseif ($b['kondisi'] == 2) {
                                                        $kondisi = "Rusak Ringan";
                                                    } elseif ($b['kondisi'] == 3) {
                                                        $kondisi = "Rusak Berat";
                                                    } else {
                                                        $kondisi = "-";
                                                    }



                                                    echo "<tr data-id='$b[id_brg]'>
                                                                <td>$i</td>
                                                                <td>$b[nm_brg]</td>
                                                                <td>$b[kd_brg]</td>
                                                                <td>$b[thn_beli]</td>
                                                                <td>$b[perolehan]</td>
                                                                <td>
                                                                    <span class='span-kondisi caption' data-id='$b[id_brg]'>$kondisi</span>
                                                                    <input type='text' class='field-kondisi form-control editor' style='display: none;' value='$b[kondisi]' data-id='$b[id_brg]' />
                                                                </td>
                                                                <td style='text-align: right;'>$harga</td>
                                                                <td style='text-align: right;'>$b[umr_ekonomis]</td>
                                                                <td style='text-align: right;'>$nilsisa</td>
                                                                <td style='text-align: right;'>$penyusutan_pertahun</td>
                                                                <td style='text-align: right;'>$akumulasi_penyusutan</td>
                                                                <td style='text-align: right;color: red;'>$nilaisisa_sekarang</td>
                                                                <td style='text-align: right;'>$b[thn_pengadaan]</td>
                                                                </tr>";
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <h4 style="font-weight: bold;">Keterangan :</h4>
                                (<span style="color:red;">*</span>) : <span style="font-weight: bold;">Inputkan Angka: 1 (Baik), 2 (Rusak Ringan), 3 (Rusak Berat)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
                <?php $this->load->view('template/copyright') ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <?php $this->load->view('template/script') ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dt_kib_a').dataTable();
        })

        $(function() {
            $.ajaxSetup({
                type: "post",
                cache: false,
                dataType: "json"
            })

            $(document).on("click", "td", function() {
                $(this).find("span[class ~='caption']").hide();
                $(this).find("input[class ~='editor']").fadeIn().focus();
            });

            $(document).on("keydown", ".editor", function(e) {
                if (e.keyCode == 13) {
                    var target = $(e.target);
                    var value = target.val();
                    var id = target.attr("data-id");
                    var data = {
                        id: id,
                        value: value
                    };

                    if (target.is(".field-kondisi")) {
                        data.modul = "kondisi";
                    }

                    $.ajax({
                        data: data,
                        url: "<?= base_url('Kib/uptd_kib_a'); ?>",
                        success: function(a) {
                            target.hide();
                            target.siblings("span[class~='caption']").html(value).fadeIn();
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>