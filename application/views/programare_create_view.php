<section>
    <div class="content-wrapper">
        <h3>Creeaza o programare</h3>

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

        <div class="col-lg-12">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-responsive">
                                <tr>
                                    <td width="20%">
                                        <div class="media-center media-middle photo-table">
                                            <a href="<?php echo base_url(); ?>profile/<?php echo $patientInfo->id; ?>">
                                                <img src="<?php echo base_url(); ?>assets/img/profilepictures/<?php echo $patientInfo->picture_path; ?>" alt="Avatar" width="150" class="rounded-circle">
                                            </a>
                                        </div>     
                                    </td>         
                                    <td>
                                        <b>Datele tale:</b>
                                        <ul>
                                            <li><b>Nume Prenume:</b> <?php echo $patientInfo->nume; ?> <?php echo $patientInfo->prenume; ?></li>
                                            <li><b>Nr. de telefon:</b> <?php echo $patientInfo->phone; ?></li>
                                            <li><b>Data nasterii:</b> <?php echo $patientInfo->born_date; ?></li>
                                            <li><b>Locatie:</b> <?php echo $patientInfo->location; ?></li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>

                            <br>
                            <i>Pentru a face o solicitare de programare completeaza campurile de mai jos:</i><br><br>

                            <?php echo form_open("programare/send/"); ?>                                                      
                                <div class="form-group">
                                    <label>Data preferata:</label>
                                        <input name="appdate" type="text" class="form-control" placeholder="alege data" id="datepicker" required>
                                </div>
                                <div class="form-group">
                                    <label>Ora dorita:</label>
                                    <div class="radio"><label><input id="pana12" type="radio" name="oraradio" value="pana12" required> pana in ora 12:30</label></div>
                                    <div class="radio"><label><input id="intre1417" type="radio" name="oraradio" value="intre1417" required> intre 14:00 si 17:00</label></div>
                                    <div class="radio"><label><input id="dupa17" type="radio" name="oraradio" value="dupa17" required> dupa 17:00</label></div>
                                </div>
                                <div class="form-group">
                                    <label>Alte informatii:</label>
                                    <textarea class="form-control" name="alteinfo" rows="4" placeholder="puteti introduce orice detalii/cereri suplimentare pe care le aveti" maxlength="500"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Cum vrei sa fii contactat pentru confirmare?</label>
                                    <div class="radio"><label><input type="radio" name="contactOption" value="website" required> notificare website</label></div>
                                    <div class="radio"><label><input  type="radio" name="contactOption" value="telefon" required> contact telefonic</label></div>
                                </div>
                              <input type="hidden" name="doctorID" value="<?php echo $doctorInfo->id; ?>">
                              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-paper-plane"></i> trimite solicitare</button>
                              Dând click pe butonul trimite solicitare, sunteți de acord cu termenii și condițiile și politica GDPR MediCare Romania!
                            <?php echo form_close(); ?>

                            </div>
                        </div>
                    </div>
                <div class="col-md-5">
                        <div class="panel panel-default">
                        <div class="panel-body">
                            <h4><em class="fa-1x mr-2 fa fa-flag"></em> Doctorul ales de dvs.</h4>
                        <br>
                            <div class="md-input-wrapper">
                                <div class="form-group">
                                <address>
                                    <center>
                                        <div class="media-center media-middle photo-table">
                                            <a href="<?php echo base_url(); ?>profile/<?php echo $doctorInfo->id; ?>">
                                                <img src="<?php echo base_url(); ?>assets/img/profilepictures/<?php echo $doctorInfo->picture_path; ?>" alt="Avatar" class="img-circle" height="200">
                                            </a>
                                        </div>
                                    </center><br>
                                <ul>
                                    <li><b>Nume Prenume:</b> <?php echo $doctorInfo->nume; ?> <?php echo $doctorInfo->prenume; ?></li>
                                    <li><b>Nr. de telefon:</b> <?php echo $doctorInfo->phone; ?></li>
                                    <li><b>Data nasterii:</b> <?php if($doctorInfo->born_date != "null") { ?> <?php echo $doctorInfo->born_date; ?> <?php } else { ?>camp necompletat<?php } ?></li>
                                    <li><b>Locatie:</b> <?php if($doctorInfo->location != "null") { ?> <?php echo $doctorInfo->location; ?> <?php } else { ?>camp necompletat<?php } ?></li>
                                    <li><b>Specializare:</b> <?php echo doctor_type($doctorInfo->doctor_type1); ?> 
                                                             <?php if($doctorInfo->doctor_type2 != "0") { ?>, <?php echo doctor_type($doctorInfo->doctor_type2); ?><?php } ?>
                                                             <?php if($doctorInfo->doctor_type3 != "0") { ?>, <?php echo doctor_type($doctorInfo->doctor_type3); ?><?php } ?>
                                                             <?php if($doctorInfo->doctor_type4 != "0") { ?>, <?php echo doctor_type($doctorInfo->doctor_type4); ?><?php } ?>
                                                             
                                    </li>
                                                    <?php $languagesFormatter = expand_languages($doctorInfo->languages); ?>
                                    <?php if($languagesFormatter != "no_lang") { ?>
                                        <li><b>Limbi straine:</b> <?php echo $languagesFormatter; ?></li>
                                    <?php } ?>
                                </ul>
                                </address>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                        <div class="panel-body">
                            <h4><em class="fa-1x mr-2 fa fa-flag"></em> Diverse informatii</h4>
                        <br>
                            <div class="md-input-wrapper">
                                <div class="form-group">
                                <address>
                                        Vă puteți programa telefonic sau prin completarea formularului din stânga ecranului. Programările online sunt valide doar după confirmarea în funcție de metoda de contactarea aleasă în formularul din stânga.<br><br>Daca alegeți varianta telefonică, Veți fi apelat/ă de un reprezentant al MediCare, după ce un administrator din echipa MediCare va face verificarea formularului de programare.<br><br>

                                        <h4><i class="fas fa-phone"></i> Contactați-ne!</h4>
                                        <h4>0734 638 088<br>
                                        0775 594 709<br><br>
                                        suport@medicare.ro</h4>
                                </address>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>