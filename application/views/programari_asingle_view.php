<section>
    <div class="content-wrapper">
        <h3><a href="<?php echo base_url(); ?>/programari/admin">>> inapoi la lista</a></h3>
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
        
            <div class="col-md-8">
                <div class="panel panel-default">
                        <div class="panel-body">
                                <center><h4>Programarea lui <?php echo $personalInformations->nume; ?> <?php echo $personalInformations->prenume; ?>  din data de <?php $mysql_date = date('Y-m-d G:i:s', strtotime($appointmentInfo->date)); ?>
                                                    <?php echo date('d/m/Y', strtotime($mysql_date)); ?></h4></center>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">                                
                                        <tbody>
                                            <tr>
                                                <td><b>Data crearii</b></td>
                                                <td><?php echo $appointmentInfo->requested_time; ?></td>
                                            </tr> 
                                            <tr>
                                                <td><b>Data aleasa</b></td>
                                                <td><?php $mysql_date = date('Y-m-d G:i:s', strtotime($appointmentInfo->date)); ?>
                                                    <?php echo date('d/m/Y', strtotime($mysql_date)); ?></td>
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
                                                        Dr. <?php echo $doctorInfo->nume; ?> <?php echo $doctorInfo->prenume; ?> 
                                                    </td>
                                                </tr>
                                            <?php } ?>                         
                                        </tbody>
                                    </table>                                                              
                                </div>
                    </div>
                </div>

                <?php if(strlen($appointmentInfo->confirmed_hour) < 2) { ?>
                    <div class="panel panel-default">
                            <div class="panel-body">
                                <center><h4>Disponibilitatea doctorului <i><?php echo $doctorInfo->nume; ?> <?php echo $doctorInfo->prenume; ?></i> pentru ziua de <?php $mysql_date = date('Y-m-d G:i:s', strtotime($appointmentInfo->date)); ?>
                                                    <?php echo date('d/m/Y', strtotime($mysql_date)); ?>.</h4></center>
                                <br>
                                 <?php echo form_open("programari/acceptappointment/"); ?>
                                    <input type="hidden" name="appointmentID" value="<?php echo $this->uri->segment(3); ?>">
                                   <table class="table table-responsive table-striped">
                                            <?php if($workingHours) { ?>
                                                <?php $index = 0; ?>
                                                <?php foreach($workingHours as $row) { ?>
                                                    <tr>
                                                        <td align="center" width="40%">
                                                            <?php echo $row->hour; ?>:<?php echo $row->minute; ?>
                                                        </td>
                                                        <td width="22%">
                                                            <?php if($isHourAvailableByTimeAndDoctor[$index] == 1) { ?>
                                                                <font color="green"><b>disponibil</b></font>
                                                                <td>
                                                                    <?php $choiceHour = "".$row->hour.":".$row->minute.""; ?>
                                                                    <label><input type="radio" value="<?php echo $choiceHour; ?>" name="choicenHour" required> alege ora pentru programare</label>
                                                                </td>
                                                            <?php } else { ?>
                                                                <font color="red"><b>ocupat</b></font>
                                                                <td>
                                                                    <i>indisponibil</i>
                                                                </td>
                                                            <?php } ?>
                                                        </td>                                                    
                                                    </tr>
                                                    <?php $index = $index + 1; ?>
                                                <?php } ?>
                                            <?php } ?>
                                    </table>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            Programarea este acceptata pentru ora <?php echo $appointmentInfo->confirmed_hour; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="col-md-4">
                <div class="panel b">
                    <div class="panel-body">
                        <h4><em class="fa-1x mr-2 fa fa-flag"></em> Doctorul ales</h4>
                        <br>
                            <div class="md-input-wrapper">
                                <div class="form-group">
                                <address>
                                    <center>
                                        <div class="media-center media-middle photo-table">
                                            <a href="<?php echo base_url(); ?>profile/<?php echo $doctorInfo->id; ?>">
                                                <img src="<?php echo base_url(); ?>assets/img/profilepictures/<?php echo $doctorInfo->picture_path; ?>" alt="Avatar" class="media-object img-thumbnail thumb62" style="height: 250px;">
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
                                    <li><b>Nota:</b> <?php echo get_mark($doctorInfo->rating_value, $doctorInfo->rating_number); ?>/5.00 din <?php echo $doctorInfo->rating_number; ?> recenzii
                                    <li><a href="<?php echo base_url('profile/') ?><?php echo $doctorInfo->id; ?>">viziteaza profil</a></li>
                                </ul>
                                </address>
                                </div>
                        </div>
                    </div>
                </div>
                 <div class="panel b">
                    <div class="panel-body">
                        <h4><em class="fa-1x mr-2 fa fa-flag"></em> Actiuni</h4><hr>                            
                                    <div class="col-md-6">
                                        <?php if($appointmentInfo->verified == 0) { ?>
                                        <label>Accepta programare</label>
                                        <br>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> accepta programare</button>
                                        <?php echo form_close(); ?>
                                            <hr>
                                            <?php } ?>
                                        <?php echo form_open("programari/cancelappointment/"); ?>  
                                            <label>Respinge programare</label> <br>   
                                                <input type="hidden" name="appointmentID" value="<?php echo $this->uri->segment(3); ?>">                                                
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-paper-plane"></i> respinge programare</button>
                                        <?php echo form_close(); ?>
                                        <hr>
                                    </div>

                                <div class="col-md-6">                                      
                                        <?php echo form_open("programari/changedate/"); ?>  
                                        <label>Schimba data</label>                                                    
                                            <div class="form-group">
                                                <input name="appdate" type="text" class="form-control" placeholder="alege data" id="datepicker" required>
                                            </div>
                                            <input type="hidden" name="appointmentID" value="<?php echo $this->uri->segment(3); ?>">
                                            <button type="submit" class="btn btn-warning"><i class="fa fa-paper-plane"></i> schimba data</button>
                                        <?php echo form_close(); ?>
                                </div>
                    </div>
                </div>
            </div>

    </div>
</section>