<?php
$data['tittle'] = "Pemeliharaan Aset";
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
                <h2 class="page-header">
                    Pemeliharaan Aset
                </h2>
                <?= $this->session->flashdata('pesan'); ?>
                <ol class="breadcrumb">
                    <li><a href="#"><?php $str = $this->session->userdata('nama_pegawai');
                                    echo wordwrap($str, 40, "<br>\n"); ?></a></li>
                    <li><a href="<?= base_url() ?>Aset/home">Home</a></li>
                    <li class="active">Pemeliharaan Aset</li>
                </ol>
            </div>

            <div id="page-inner">
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 style="font-weight:bold;">Pemeliharaan Aset Internal</h3>
                                <hr align="right" color="black">
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="internal">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Aset</th>
                                                <th>Nama Aset</th>
                                                <th>Kondisi</th>
                                                <th>Umur Ekonomis</th>
                                                <th>Nilai Sisa</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dt_internal">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 style="font-weight:bold;">Pemeliharaan Aset External</h3>
                                <hr align="right" color="black">
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="external">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Aset</th>
                                                <th>Nama Aset</th>
                                                <th>Kondisi</th>
                                                <th>Umur Ekonomis</th>
                                                <th>Nilai Sisa</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dt_external">
                                        </tbody>
                                    </table>
                                </div>
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
            tampil_internal();
            tampil_external();

            $('#internal').dataTable();
            $('#external').dataTable();
        })

        function tampil_internal() {
            $.ajax({
                type: "GET",
                url: "<?= base_url('Pemeliharaan_aset/get_pelihara_aset_internal') ?>",
                async: false,
                dataType: "JSON",
                success: function(c) {
                    var pgdn = "";
                    for (h = 0; h < c.length; h++) {
                        var bilangan = c[h].nli_sisa;

                        var reverse = bilangan.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');

                        if (c[h].stts_approval == 4) {
                            text = "Selesai";
                            stts = "success";
                            icon = "check";
                        } else if (c[h].stts_approval == 6) {
                            text = "Penghapusan";
                            stts = "danger";
                            icon = "trash";
                        } else {
                            text = "Proses";
                            stts = "info";
                            icon = "cog";
                        }

                        if (c[h].kondisi_brg == 2) {
                            kondisi_brg = "Rusak Ringan";
                        } else if (c[h].kondisi_brg == 3) {
                            kondisi_brg = "Rusak Berat";
                        } else {
                            kondisi_brg = "Baik";
                        }

                        pgdn +=
                            '<tr>' +
                            '<td>' + (h + 1) + '</td>' +
                            '<td>' + c[h].kd_brg + '</td>' +
                            '<td>' + c[h].nm_brg + '</td>' +
                            '<td>' + kondisi_brg + '</td>' +
                            '<td style="text-align: right;">' + c[h].umr_ekonomis + '</td>' +
                            '<td style="text-align: right;">' + ribuan + '</td>' +
                            '<td style="text-align: center;"><button type="button" disabled title="Selesai" class="btn btn-xs btn-' + stts + '"><i class="fa fa-' + icon + '"></i> ' + text + '</button></td>' +
                            '</tr>';
                    }
                    $('#dt_internal').html(pgdn);

                }
            });
        }

        function tampil_external() {
            $.ajax({
                type: "GET",
                url: "<?= base_url('Pemeliharaan_aset/get_pelihara_aset_external_kep') ?>",
                async: false,
                dataType: "JSON",
                success: function(c) {
                    var pgdn = "";
                    for (h = 0; h < c.length; h++) {
                        if (c[h].nli_sisa != "") {
                            var bilangan = c[h].nli_sisa;

                            var reverse = bilangan.toString().split('').reverse().join(''),
                                ribuan = reverse.match(/\d{1,3}/g);
                            nli_sisa = ribuan.join('.').split('').reverse().join('');
                        } else {
                            nli_sisa = "";
                        }

                        if (c[h].harga != "") {
                            var bil = c[h].harga;

                            var reverse = bil.toString().split('').reverse().join(''),
                                ribuan = reverse.match(/\d{1,3}/g);
                            harga = ribuan.join('.').split('').reverse().join('');
                        } else {
                            harga = "";
                        }

                        var dateMonth = new Date();
                        var thn_new = dateMonth.getFullYear();
                        var thn_beli = c[h].thn_beli;
                        var selisih = thn_new - thn_beli;

                        var tahun = Math.ceil(c[h].nil_bku / 12);
                        var bulan = dateMonth.getMonth() + 1;

                        var penyusutan = tahun * bulan;
                        var reverse = penyusutan.toString().split('').reverse().join(''),
                            ribuan_bln = reverse.match(/\d{1,3}/g);
                        penyusutan_fix = ribuan_bln.join('.').split('').reverse().join('');

                        var hsl_fix = c[h].harga - (c[h].nil_bku * selisih);

                        var reverse = hsl_fix.toString().split('').reverse().join(''),
                            ribuan_bku = reverse.match(/\d{1,3}/g);
                        nil_bku = ribuan_bku.join('.').split('').reverse().join('');

                        var sisa_umr_ekonomis = c[h].sisa_umr_ekonomis;
                        setuju = "2";
                        tolak = "3";

                        if (c[h].stts_approval_kep == 1) {
                            aksi1 = "";
                            aksi2 = "display: none;";
                            aksi3 = "display: none;";
                        } else if (c[h].stts_approval_kep == 2) {
                            aksi1 = "display: none;";
                            aksi2 = "";
                            aksi3 = "display: none;";
                        } else if (c[h].stts_approval_kep == 3) {
                            tmbh = "disabled";
                            hps = "success";
                            btl = "";
                            aksi1 = "display: none;";
                            aksi2 = "display: none;";
                            aksi3 = "";
                        } else {
                            aksi1 = "display: none;";
                            aksi2 = "display: none;";
                            aksi3 = "display: none;";
                        }

                        if (c[h].stts_approval == 5) {
                            text = "Selesai";
                            stts = "success";
                            icon = "check";
                        } else if (c[h].stts_approval == 7) {
                            text = "Penghapusan";
                            stts = "danger";
                            icon = "trash";
                        } else {
                            text = "Proses";
                            stts = "info";
                            icon = "cog";
                        }

                        if (c[h].kondisi_brg == 2) {
                            kondisi_brg = "Rusak Ringan";
                        } else if (c[h].kondisi_brg == 3) {
                            kondisi_brg = "Rusak Berat";
                        } else {
                            kondisi_brg = "Baik";
                        }

                        pgdn +=
                            '<tr>' +
                            '<td>' + (h + 1) + '</td>' +
                            '<td>' + c[h].kd_brg + '</td>' +
                            '<td>' + c[h].nm_brg + '</td>' +
                            '<td>' + kondisi_brg + '</td>' +
                            '<td style="text-align: right;">' + c[h].umr_ekonomis + '</td>' +
                            '<td style="text-align: right;">' + nil_bku + '</td>' +
                            '<td style="text-align: center;">' +
                            '<button style="' + aksi1 + '" class="btn btn-xs btn-primary" onclick="aksi_pelihara_kep(\'' + c[h].id_pemeliharaan + '\', \'' + c[h].id_brg + '\', \'' + setuju + '\', \'' + hsl_fix + '\', \'' + sisa_umr_ekonomis + '\' )"><i class="fa fa-check"></i> Setuju</button> &nbsp;' +
                            '<button style="' + aksi1 + '" class="btn btn-xs btn-danger" onclick="aksi_pelihara_kep(\'' + c[h].id_pemeliharaan + '\', \'' + c[h].id_brg + '\', \'' + tolak + '\', \'' + hsl_fix + '\', \'' + sisa_umr_ekonomis + '\')"><i class="fa fa-times"></i> Tolak</button> &nbsp;' +
                            '<button style="' + aksi3 + '" type="button" class="btn btn-xs btn-danger" disabled><i class="fa fa-times"></i> Ditolak</button> &nbsp;' +
                            '<button style="' + aksi2 + '" type="button" disabled class="btn btn-xs btn-' + stts + '"><i class="fa fa-' + icon + '"></i> ' + text + '</button> &nbsp;' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#dt_external').html(pgdn);
                }
            });
        }

        function aksi_pelihara_kep(id_pemeliharaan, id_brg, stts_approval_kep, nilai_buku_bln, sisa_umr_ekonomis) {
            $.ajax({
                type: "POST",
                data: {
                    id_pemeliharaan: id_pemeliharaan,
                    id_brg: id_brg,
                    stts_approval_kep: stts_approval_kep,
                    nilai_buku_bln: nilai_buku_bln,
                    sisa_umr_ekonomis: sisa_umr_ekonomis
                },
                url: "<?= base_url('Pemeliharaan_aset/aksi_pelihara_kep') ?>",
                async: false,
                dataType: "JSON",
                success: function(a) {
                    if (stts_approval_kep == 2) {
                        stts = "Disetujui";
                    } else if (stts_approval_kep == 3) {
                        stts = "Ditolak";
                    } else {
                        stts = "-";
                    }
                    swal({
                        title: "Berhasil " + stts,
                        type: "success",
                        timer: 2500,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        location.reload()
                    }, 2500);
                }
            });
        }
    </script>

</body>

</html>