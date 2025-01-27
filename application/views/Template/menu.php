<nav class="navbar-default navbar-side">
    <div class="app-sidebar__user" style="margin-top: 1%;">
        <?php
        $id = $this->session->userdata('user_id');
        $this->load->model('Login_model');
        $profil = $this->Login_model->get_login($id);
        foreach ($profil as $p) { ?>
            <img class="app-sidebar__user-avatar" src="<?= base_url(); ?>assets_app/img/profil/<?= $p['image'] ?>">
        <?php } ?>
        <!-- <img class="app-sidebar__user-avatar" src="<?= base_url(); ?>assets_application/assets/faces/default.jpg"> -->
        <div>
            <span class="app-sidebar__user-name">
                <?php $str = $this->session->userdata('nama_pegawai');
                echo wordwrap($str, 20, "<br>\n"); ?>
            </span>
            <p class="app-sidebar__user-designation" style="padding-top: 0px; font-size: 13px;">
                <?php
                $role = $this->session->userdata('role');
                if ($role == 1) {
                    echo "Administrasi Aset";
                } elseif ($role == 2) {
                    echo "Manager";
                } elseif ($role == 3) {
                    echo "Dirut";
                } else {
                    echo "";
                }
                ?>
            </p>
        </div>
    </div>
    <div class="sidebar-collapse">
        <?php
        $role = $this->session->userdata('role');
        if ($role == 1) { ?>
            <!-- Menu Aset -->
            <ul class="nav" id="main-menu">
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "home") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Aset/home') ?>"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "data_usulan_pengadaan") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Master_data/data_usulan_pengadaan'); ?>"><i class="fa fa-laptop"></i></i>Usulan Pengadaan Aset</a>
                </li>
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "data_pengadaan") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Master_data/data_pengadaan'); ?>"><i class="fa fa-file"></i>Penambahan/Pengadaan Aset</a>
                </li>

                <!-- <li>
                    <a class="<?php if ($this->uri->segment(2) == "kib_b") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Kib/kib_b'); ?>"><i class="fa fa-barcode"></i>Daftar Aset</a>
                </li> -->
                <li class="<?php if ($this->uri->segment(1) == "Kib") {
                                echo "active";
                            } ?>">
                    <a href="#" class="<?php if ($this->uri->segment(1) == "Kib") {
                                            echo "active";
                                        } ?>"><i class="fa fa-barcode"></i> Daftar Aset<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_a") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_a'); ?>"><i class="fa fa-long-arrow-right"></i> KIB A</a>
                        </li>
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_b") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_b'); ?>"><i class="fa fa-long-arrow-right"></i> KIB B</a>
                        </li>
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_c") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_c'); ?>"><i class="fa fa-long-arrow-right"></i> KIB C</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "pengadaan_aset") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Pengadaan_aset/pengadaan_aset') ?>"><i class="fa fa-shopping-cart"></i> Pengadaan Aset</a>
                </li>
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "pemeliharaan_aset") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Pemeliharaan_aset/pemeliharaan_aset') ?>"><i class="fa fa-wrench"></i> Pemeliharaan Aset</a>
                </li>
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "penghapusan_aset") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Penghapusan_aset/penghapusan_aset') ?>"><i class="fa fa-trash-o"></i> Rekomendasi Penghapusan</a>
                </li>
                <!--
                <li class="<?php if ($this->uri->segment(1) == "Lp_kib") {
                                echo "active";
                            } elseif ($this->uri->segment(1) == "Laporan") {
                                echo "active";
                            } ?>">
                    <a href="#" class="<?php if ($this->uri->segment(1) == "Lp_kib") {
                                            echo "active";
                                        } elseif ($this->uri->segment(1) == "Laporan") {
                                            echo "active";
                                        } ?>"><i class="fa fa-file-text-o"></i> Laporan<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <!-- <li>
                            <a class="<?php if ($this->uri->segment(2) == "lp_kib_b") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Lp_kib/lp_kib_b'); ?>"><i class="fa fa-long-arrow-right"></i> Daftar Aset</a>
                        </li> -->
                <!-- <li class="<?php if ($this->uri->segment(1) == "Lp_kib") {
                                    echo "active";
                                } ?>">

                    <a href="#" class="<?php if ($this->uri->segment(1) == "Lp_kib") {
                                            echo "active";
                                        } ?>"><i class="fa fa-long-arrow-right"></i> Daftar Aset<span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "lp_kib_a") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Lp_kib/lp_kib_a'); ?>"><i class="fa fa-long-arrow-right"></i> KIB A</a>
                        </li>
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "lp_kib_b") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Lp_kib/lp_kib_b'); ?>"><i class="fa fa-long-arrow-right"></i> KIB B</a>
                        </li> -->
                <!--
                            <li>
                                <a class="<?php if ($this->uri->segment(2) == "lp_kib_c") {
                                                echo "active-menu";
                                            } ?>" href="<?= base_url('Lp_kib/lp_kib_c'); ?>"><i class="fa fa-long-arrow-right"></i> KIB C</a>
                            </li>
                            <li>
                                <a class="<?php if ($this->uri->segment(2) == "lp_kib_e") {
                                                echo "active-menu";
                                            } ?>" href="<?= base_url('Lp_kib/lp_kib_e'); ?>"><i class="fa fa-long-arrow-right"></i> KIB E</a>
                            </li>
                            
                            </ul>
                        </li>
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "lp_pemeliharaan") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Laporan/lp_pemeliharaan') ?>"><i class="fa fa-long-arrow-right"></i> Pemeliharaan</a>
                        </li>
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "lp_usul_pengadaan") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Laporan/lp_usul_pengadaan') ?>"><i class="fa fa-long-arrow-right"></i> Usulan Pengaadaan</a>
                        </li>
                    </ul>
                </li>-->
            </ul>
        <?php } elseif ($role == 2) { ?>
            <!-- Menu Manager -->
            <ul class="nav" id="main-menu">
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "home") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Manager/home') ?>"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <!-- <li>
                    <a class="<?php if ($this->uri->segment(2) == "kib_b_wk") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Kib/kib_b_wk'); ?>"><i class="fa fa-barcode"></i> Daftar Aset</a>
                </li> -->
                <li class="<?php if ($this->uri->segment(1) == "Kib") {
                                echo "active";
                            } ?>">
                    <a href="#" class="<?php if ($this->uri->segment(1) == "Kib") {
                                            echo "active";
                                        } ?>"><i class="fa fa-barcode"></i> Daftar Aset<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_a_wk") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_a'); ?>"><i class="fa fa-long-arrow-right"></i> KIB A</a>
                        </li>

                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_b_wk") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_b'); ?>"><i class="fa fa-long-arrow-right"></i> KIB B</a>
                        </li>

                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_c") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_c'); ?>"><i class="fa fa-long-arrow-right"></i> KIB C</a>
                        </li>
                        <!--
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_e_wk") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_e_wk'); ?>"><i class="fa fa-long-arrow-right"></i> KIB E</a>
                        </li>
                        -->
                    </ul>
                </li>
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "pengadaan_aset_wk") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Pengadaan_aset/pengadaan_aset_wk') ?>"><i class="fa fa-shopping-cart"></i> Usulan Pengadaan Aset</a>
                </li>
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "pemeliharaan_aset_wk") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Pemeliharaan_aset/pemeliharaan_aset_wk') ?>"><i class="fa fa-wrench"></i> Pemeliharaan Aset</a>
                </li>
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "penghapusan_aset_wk") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Penghapusan_aset/penghapusan_aset_wk') ?>"><i class="fa fa-trash-o"></i> Penghapusan Aset</a>
                </li>
                <!--
                <li class="<?php if ($this->uri->segment(1) == "Laporan") {
                                echo "active";
                            } ?>">
                    <a href="#lp" class="<?php if ($this->uri->segment(1) == "Laporan") {
                                                echo "active";
                                            } ?>"><i class="fa fa-file-text-o"></i> Laporan<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li id="lp">
                            <a class="<?php if ($this->uri->segment(2) == "lp_pengadaan_wk") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Laporan/lp_pengadaan_wk') ?>"><i class="fa fa-long-arrow-right"></i> Pengadaan</a>
                        </li>
                        <!-- <li id="lp">
                            <a class="<?php if ($this->uri->segment(2) == "lp_peminjaman_wk") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Laporan/lp_peminjaman_wk') ?>"><i class="fa fa-long-arrow-right"></i> Peminjaman</a>
                        </li> -->
                <!-- <li id="lp">
                            <a class="<?php if ($this->uri->segment(2) == "lp_pemeliharaan_wk") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Laporan/lp_pemeliharaan_wk') ?>"><i class="fa fa-long-arrow-right"></i> Pemeliharaan</a>
                        </li>
                        <li id="lp">
                            <a class="<?php if ($this->uri->segment(2) == "lp_penghapusan_wk") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Laporan/lp_penghapusan_wk') ?>"><i class="fa fa-long-arrow-right"></i> Penghapusan</a>
                        </li> 
                    </ul>
                </li>-->
            </ul>
        <?php } elseif ($role == 3) { ?>
            <!-- Menu Dirut -->
            <ul class="nav" id="main-menu">
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "home") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Dirut/home') ?>"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <!-- <li>
                    <a class="<?php if ($this->uri->segment(2) == "kib_b_kep") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Kib/kib_b_kep'); ?>"><i class="fa fa-barcode"></i>Daftar Aset</a>
                </li> -->
                <li class="<?php if ($this->uri->segment(1) == "Kib") {
                                echo "active";
                            } ?>">
                    <a href="#" class="<?php if ($this->uri->segment(1) == "Kib") {
                                            echo "active";
                                        } ?>"><i class="fa fa-barcode"></i> Daftar Aset<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_a_kep") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_a'); ?>"><i class="fa fa-long-arrow-right"></i> KIB A</a>
                        </li>
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_b_kep") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_b'); ?>"><i class="fa fa-long-arrow-right"></i> KIB B</a>
                        </li>
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_c") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_c'); ?>"><i class="fa fa-long-arrow-right"></i> KIB C</a>
                        </li>
                        <!--
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_c_kep") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_c_kep'); ?>"><i class="fa fa-long-arrow-right"></i> KIB C</a>
                        </li>
                        <li>
                            <a class="<?php if ($this->uri->segment(2) == "kib_e_kep") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Kib/kib_e_kep'); ?>"><i class="fa fa-long-arrow-right"></i> KIB E</a>
                        </li>
                        -->
                    </ul>
                </li>
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "pengadaan_aset_kep") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Pengadaan_aset/pengadaan_aset_kep') ?>"><i class="fa fa-shopping-cart"></i> Usulan Pengadaan Aset</a>
                </li>
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "pemeliharaan_aset_kep") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Pemeliharaan_aset/pemeliharaan_aset_kep') ?>"><i class="fa fa-wrench"></i> Pemeliharaan Aset</a>
                </li>
                <li>
                    <a class="<?php if ($this->uri->segment(2) == "penghapusan_aset_kep") {
                                    echo "active-menu";
                                } ?>" href="<?= base_url('Penghapusan_aset/penghapusan_aset_kep') ?>"><i class="fa fa-trash-o"></i> Penghapusan Aset</a>
                </li>
                <!--
                <li class="<?php if ($this->uri->segment(1) == "Laporan") {
                                echo "active";
                            } ?>">
                    <a href="#lp" class="<?php if ($this->uri->segment(1) == "Laporan") {
                                                echo "active";
                                            } ?>"><i class="fa fa-file-text-o"></i> Laporan<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li id="lp">
                            <a class="<?php if ($this->uri->segment(2) == "lp_pengadaan_kep") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Laporan/lp_pengadaan_kep') ?>"><i class="fa fa-long-arrow-right"></i> Pengadaan</a>
                        </li>
                        <!-- <li id="lp">
                            <a class="<?php if ($this->uri->segment(2) == "lp_peminjaman_kep") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Laporan/lp_peminjaman_kep') ?>"><i class="fa fa-long-arrow-right"></i> Peminjaman</a>
                        </li> -->
                <!-- <li id="lp">
                            <a class="<?php if ($this->uri->segment(2) == "lp_pemeliharaan_kep") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Laporan/lp_pemeliharaan_kep') ?>"><i class="fa fa-long-arrow-right"></i> Pemeliharaan</a>
                        </li>
                        <li id="lp">
                            <a class="<?php if ($this->uri->segment(2) == "lp_penghapusan_kep") {
                                            echo "active-menu";
                                        } ?>" href="<?= base_url('Laporan/lp_penghapusan_kep') ?>"><i class="fa fa-long-arrow-right"></i> Penghapusan</a>
                        </li> 
                    </ul>
                </li>-->
            </ul>
        <?php } ?>
    </div>
</nav>