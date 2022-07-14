<section>
    <div class="content-wrapper">
        <h3>Programarea dvs. (<?php echo $personalInformations->nume; ?> <?php echo $personalInformations->prenume; ?>) din data de <?php $mysql_date = date('Y-m-d G:i:s', strtotime($appointmentInfo->date)); ?>
                                                    <?php echo date('d/m/Y', strtotime($mysql_date)); ?></h3>
        
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
        
            <div class="col-md-7">
                <div class="panel panel-default">
                        <div class="panel-body">
                                <center><h4>Programarea ta din data de <?php $mysql_date = date('Y-m-d G:i:s', strtotime($appointmentInfo->date)); ?>
                                                    <?php echo date('d/m/Y', strtotime($mysql_date)); ?>
                                        </td></h4></center>
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
                                <br>
                                <?php if($appointmentInfo->date > date('m/d/Y', '-1 days') || $personalInformations->doctor > 0 ){ ?>
                                        <br>
                                        <?php if($personalInformations->doctor == 0 || $appointmentInfo->date != date('m/d/Y')) { ?>
                                              <center><h4>Rezultate consult / programare</h4></center>
                                            <div class="md-input-wrapper">
                                                <h4>Diagnostic</h4>
                                                <blockquote>
                                                    <font style="font-size: 14px;">
                                                        <?php echo $appointmentDetails->diagnostic; ?>
                                                    </font>
                                                </blockquote>
                                                <h4>Tratament</h4>
                                                <blockquote>
                                                    <font style="font-size: 14px;">
                                                        <?php echo $appointmentDetails->treatment; ?>
                                                    </font>
                                                </blockquote>
                                                <h4>Recomandari</h4>
                                                <blockquote>
                                                    <font style="font-size: 14px;">
                                                        <?php echo $appointmentDetails->recommandation; ?>
                                                    </font>
                                                </blockquote>
                                                <h4>Urmatorul consult recomandat</h4>
                                                <blockquote>
                                                    <font style="font-size: 14px;">
                                                        <?php echo $appointmentDetails->next_appointment; ?>
                                                    </font>
                                                </blockquote>
                                                <h4>Alte informatii</h4>
                                                <blockquote>
                                                    <font style="font-size: 14px;">
                                                        <?php echo $appointmentDetails->more_informations; ?>
                                                    </font>
                                                </blockquote>                                    
                                                <br>
                                                <?php if($appointmentDetails->added_date) { ?>
                                                        <i>date adaugate pe data:</i> <?php echo $appointmentDetails->added_date; ?>
                                                    <?php } ?>
                                            </div>
                                        <?php } elseif($this->session->userdata('logged_in')['id'] == $appointmentInfo->doctorid && $appointmentInfo->date == date('m/d/Y')) { ?>
                                            <?php echo form_open_multipart("programaridoctor/addinfotoappointment"); ?>
                                                 <input type="hidden" name="appointmentID" value="<?php echo $appointmentInfo->id; ?>">
                                                <div class="md-input-wrapper">
                                                    <h4>Diagnostic</h4>
                                                        <div class="form-group">
                                                            <?php if($appointmentDetails->diagnostic != null) { ?>
                                                                <textarea class="form-control" name="diagnostic" rows="3" maxlength="950"><?php echo $appointmentDetails->diagnostic; ?></textarea>
                                                            <?php } else { ?>
                                                                <textarea class="form-control" name="diagnostic" value="camp necompletat" placeholder="introduceti aici textul dorit..." rows="3" maxlength="950" required></textarea>
                                                            <?php } ?>
                                                        </div>
                                                    <br>
                                                    <h4>Tratament</h4>
                                                        <div class="form-group">
                                                            <?php if($appointmentDetails->treatment != null) { ?>
                                                                <textarea class="form-control" name="treatment" rows="3" maxlength="950"><?php echo $appointmentDetails->treatment; ?></textarea>
                                                            <?php } else { ?>
                                                                <textarea class="form-control" name="treatment" value="camp necompletat" placeholder="introduceti aici textul dorit..." rows="3" maxlength="950"></textarea>
                                                            <?php } ?>
                                                        </div>
                                                    <br>
                                                    <h4>Recomandari</h4>
                                                        <div class="form-group">
                                                            <?php if($appointmentDetails->recommandation != null) { ?>
                                                                <textarea class="form-control" name="recommandation" rows="3" maxlength="950"><?php echo $appointmentDetails->recommandation; ?></textarea>
                                                            <?php } else { ?>
                                                                <textarea class="form-control" name="recommandation" value="camp necompletat" placeholder="introduceti aici textul dorit..." rows="3" maxlength="950"></textarea>
                                                            <?php } ?>
                                                        </div>
                                                        <h4>Urmatorul consult recomandat</h4>
                                                        <div class="form-group">
                                                            <?php if($appointmentDetails->next_appointment != null) { ?>
                                                                <textarea class="form-control" name="next_appointment" rows="3" maxlength="950"><?php echo $appointmentDetails->next_appointment; ?></textarea>
                                                            <?php } else { ?>
                                                                <textarea class="form-control" name="next_appointment" value="camp necompletat" placeholder="introduceti aici textul dorit..." rows="3" maxlength="950"></textarea>
                                                            <?php } ?>
                                                        </div>
                                                    <h4>Alte informatii</h4>
                                                    <div class="form-group">
                                                            <?php if($appointmentDetails->more_informations != null) { ?>
                                                                <textarea class="form-control" name="more_informations" rows="3" maxlength="950"><?php echo $appointmentDetails->more_informations; ?></textarea>
                                                            <?php } else { ?>
                                                                <textarea class="form-control" name="more_informations" value="camp necompletat" placeholder="introduceti aici textul dorit..." rows="3" maxlength="950"></textarea>
                                                            <?php } ?>
                                                        </div>                                    
                                                    <br>
                                                    <?php if($appointmentDetails->added_date) { ?>
                                                        <i>date adaugate pe data:</i> <?php echo $appointmentDetails->added_date; ?>
                                                    <?php } ?>
                                                </div>
                                                            <div align="center">
                                                        <button type="submit" class="btn btn-danger waves-effect waves-light">
                                                        Trimite informatiile
                                                    </button>
                                                </div>
                                            <?php echo form_close(); ?>
                                        <?php } ?>
                                <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="panel b">
                    <div class="panel-body">
                        <h4><em class="fa-1x mr-2 fa fa-flag"></em> Doctorul ales de dvs.</h4>
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
                                    <li><a href="">viziteaza profil</a></li>
                                </ul>
                                </address>
                                </div>
                        </div>
                        <br>
                        <?php if($appointmentInfo->date <= date('m/d/Y', strtotime('-1 days')) && $appointmentInfo->reviewed == 0 && $personalInformations->doctor == 0) { ?>                        	
                            <center><h4>Lasă o recenzie</h4></center><br>
                            	<?php echo form_open("programari/addreview/"); ?>
                            		<div class="form-group">
                            			<label>Nota oferita de dvs. doctorului</label>
                            				<table class="table table-responsive"><tr>
		                            			<td><label><input id="1" type="radio" name="notaservicii" value="1" required> <i class="fas fa-star"></i></label></td>
		                                   		<td><label><input id="2" type="radio" name="notaservicii" value="2" required> <i class="fas fa-star"></i><i class="fas fa-star"></i></label></td>
		                                    	<td><label><input id="3" type="radio" name="notaservicii" value="35" required> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></label></td>
		                                    	<td><label><input id="4" type="radio" name="notaservicii" value="4" required> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></label></td>
		                                    	<td><label><input id="5" type="radio" name="notaservicii" value="5" required> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></label></td>
                                    		</tr></table>                              	
									<div class="form-group">
										<textarea class="form-control" name="reviewmessage" placeholder="Scrie recenzia ta aici..." rows="3" maxlength="350" required></textarea>
									</div>
									<input type="hidden" name="idAppointment" value="<?php echo $appointmentInfo->id; ?>">
									<input type="hidden" name="patientID" value="<?php echo $appointmentInfo->clientid; ?>">
									<input type="hidden" name="doctorID" value="<?php echo $doctorInfo->id; ?>">
									<div align="center">
                                        <button type="submit" class="btn btn-purple waves-effect waves-light">
                                        trimite
                                    </button>
                                	</div>
                            	<?php form_close(); ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
    </div>
</section>