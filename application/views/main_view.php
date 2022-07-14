<section>


    <div class="content-wrapper">

        <?php if($this->session->flashdata('error') !== null): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('success') !== null): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>


        <div class="row">

            <div class="col-lg-3 col-sm-6">

                <div class="panel widget bg-danger">

                    <div class="row row-table row-flush">

                        <div class="col-xs-4 bg-danger-dark text-center">

                            <em class="fa fa-users fa-2x"></em>

                        </div>

                        <div class="col-xs-8">

                            <div class="panel-body text-center">

                                <h4 class="mt0"><?php echo $conturiCreate; ?></h4>

                                <p class="mb0">CONTURI<br>CREATE</p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-sm-6">


                <div class="panel widget bg-primary">

                    <div class="row row-table row-flush">

                        <div class="col-xs-4 bg-primary-dark text-center">
                            <i class="fas fa-briefcase-medical fa-2x"></i>

                        </div>

                        <div class="col-xs-8">

                            <div class="panel-body text-center">

                                <h4 class="mt0"><?php echo $appointmentsInLast24Hours; ?></h4>

                                <p class="mb0">PROGRAMARI ONLINE<br>IN ULTIMELE 24H</p>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">


                <div class="panel widget">

                    <div class="row row-table row-flush">

                        <div class="col-xs-4 bg-green text-center">

                            <i class="fas fa-user-nurse fa-2x"></i>

                        </div>

                        <div class="col-xs-8">

                            <div class="panel-body text-center">

                                <h4 class="mt0"><?php echo $numberOfDoctors; ?></h4>

                                <p class="mb0 text-muted">DOCTORI DISPONIBILI<br>IN CLINICA</p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">


                <div class="panel widget">

                    <div class="row row-table row-flush">

                        <div class="col-xs-4 bg-warning text-center">

                            <em class="fa fa-plug fa-2x"></em>

                        </div>

                        <div class="col-xs-8">

                            <div class="panel-body text-center">

                                <h4 class="mt0"><?php echo $appointmentsInLast30days; ?></h4>

                                <p class="mb0 text-muted">PROGRAMARI ONLINE<br>IN ULTIMELE 30 DE ZILE</p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">

                <div class="row">
                    <div class="col-xs-12 hidden-sm hidden-md hidden-lg">  
                        <a href="<?php echo base_url("medici"); ?>">
                            <img src="<?php echo base_url("assets/img/home-center-small.png"); ?>" class="img-responsive">
                        </a>
                    </div>
                    <div class="hidden-xs col-sm-12 hidden-md hidden-lg">
                        <a href="<?php echo base_url("medici"); ?>">
                    <img src="<?php echo base_url("assets/img/home-center-small.png"); ?>" class="img-responsive">
                </a>   
                    </div>
                    <div class="hidden-xs hidden-sm col-md-12 hidden-lg">
                        <a href="<?php echo base_url("medici"); ?>">
                    <img src="<?php echo base_url("assets/img/home-center-small.png"); ?>" class="img-responsive">
                </a>   
                    </div>
                    <div class="hidden-xs hidden-sm hidden-md col-lg-12">
                        <a href="<?php echo base_url("medici"); ?>">
                    <img src="<?php echo base_url("assets/img/home-center.png"); ?>" class="img-responsive">
                </a> 
                    </div>
                </div>

                

                <div class="panel panel-default">

                    <div role="tabpanel">

                        <ul class="nav nav-tabs" role="tablist">

                            <em class="icon-feed" style="margin-left: 10px;font-size: 20px;margin-top: 9px !important;display: inline-block;margin-right: 4px;"></em> <span style="font-size:20px;margin-right:10px;margin-top:5px"></span>

                            <?php if($this->session->userdata('logged_in')['id'] && $appointmentInfo) {  ?>
                                <li class="pull-right" role="presentation"><a href="#futureappointments" aria-controls="factions" role="tab" data-toggle="tab">Urmatoarea programare</a></li>
                            <?php } ?>

                            <li class="active pull-right" role="presentation"><a href="#news" aria-controls="news" role="tab" data-toggle="tab">Stiri medicale</a>

                            </li>


                        </ul>

                    </div>

                    <div class="tab-content">

                            <div class="tab-pane active" id="news" role="tabpanel">

                                <div class="panel-wrapper collapse in" aria-expanded="true">

                                    <div class="panel-body">

                                        <?php if($last3news) { ?>
                                            <?php foreach($last3news as $row) { ?>
                                                <div class="media">         
                                                    <table class="table table-responsive">
                                                        <tr>
                                                            <td>
                                                                <div class="media-left media-middle photo-table">
                                                                    <img src="<?php echo base_url(); ?>assets/img/newsphoto/<?php echo $row->photo_path; ?>" alt="Avatar" class="media-object img-thumbnail thumb62"> 
                                                                </div>           
                                                            </td>                                               
                                                            <td>
                                                                <div class="media-body">
                                                                    <a href="<?php echo base_url(); ?>/news/view/<?php echo $row->id; ?>" style="font-size: 14px;"><b><?php echo $row->title; ?></b></a><br>
                                                                    <p>data postarii: <?php echo $row->dateadd; ?></p>                                         
                                                                </div><br>
                                                                <?php echo substr(htmlentities(str_replace("<p>", "", $row->text)), 0, 500); ?>... <a href="<?php echo base_url(); ?>/news/view/<?php echo $row->id; ?>"><b><i>citeste tot</i></b></a>
                                                            
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <hr>
                                                </div>                                     
                                        <?php } } else { ?>
                                            Nu a fost gasita nicio stire in baza de date.
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>

                            <?php if($this->session->userdata('logged_in')['id']) {  ?>
                                <div class="tab-pane" id="futureappointments" role="tabpanel">

                                    <div class="panel-wrapper collapse in" aria-expanded="true">

                                        <div class="panel-body">

                                            <div class="table-responsive">

                                                <?php if($appointmentInfo) { ?>
                                                    <table class="table table-responsive">
                                                                                        
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Data crearii</b></td>
                                                                <td><?php echo $appointmentInfo->requested_time; ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td><b>Data aleasa</b></td>
                                                                <td><?php echo date("d/m/Y", strtotime($appointmentInfo->date)); ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td><b>Intervalul orar dorit</b></td>
                                                                <td><?php echo interval_orar($appointmentInfo->hour); ?></td>
                                                            </tr> 
                                                            <tr>
                                                                <td><b>Metoda de contact</b></td>
                                                                <td><?php if($appointmentInfo->contactoption == "telefon") { ?> 
                                                                        telefonic
                                                                    <?php } else { ?>
                                                                        notificare website
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Status</b></td>
                                                                <td><?php if($appointmentInfo->verified == "0") { ?> 
                                                                        <i>in asteptare</i>
                                                                    <?php } elseif($appointmentInfo->verified == "2") { ?>
                                                                        <font color="red"><b>respinsa</b></font>
                                                                    <?php } else { ?>
                                                                        <font color="green"><b>verificata</b></font>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php if($appointmentInfo->verified == "1") { ?>
                                                                <tr>
                                                                    <td><b>Ora confirmata</b></td>
                                                                    <td>
                                                                        <?php echo $appointmentInfo->confirmed_hour; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Doctor</b></td>
                                                                    <td>
                                                                        <a href="<?php echo base_url(); ?>profile/<?php echo $appointmentInfo->doctorid; ?>">Dr. <?php echo getUserFullName($appointmentInfo->doctorid); ?></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <div align="center">
                                                                            <a href="<?php echo base_url(); ?>programari/view/<?php echo $appointmentInfo->id; ?>" class="btn btn-purple"><b>vezi detalii</b></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>        
                                                        </tbody>                                          


                                                    </table>
                                                <?php } else { ?>
                                                    Nu a fost gasita nicio programare.
                                                <?php } ?>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            <?php } ?>
                </div>


               
            </div>
        </div>


            <aside class="col-lg-4">



                <div class="panel widget">

                    <div class="panel-body text-center" style="background-color: #656da2; color:#ffffff;">

                        <div class="text-lg" style="color:#ffffff"><?php echo $usersLoggedInLast24Hours; ?></div>
                        <br>
                        <p>Utilizatori conectati pe platforma noastra<br>in ultimele 24 de ore.</p>

                        <div class="mb-lg"></div>

                    </div>

                </div>

                 <div class="panel-widget" style="width:100%;" align="center">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FClinica-Medi-Care-106134697827726%2F&tabs=timeline&width=505&height=700&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="505" height="700" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>

                
            </aside>

        </div>

    </div>

</section>

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>
