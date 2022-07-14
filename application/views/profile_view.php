<section>
    <div class="content-wrapper">
        <div class="unwrap">
            <div class="p-lg">
                <div class="row">
                    <div class="col-lg-12">

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


                        <div role="tabpanel">
                                <div class="col-lg-9">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="active" role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa fa-user"></i> Informatii generale</a>
                                        </li>
                                        <?php if(($this->session->userdata("logged_in")["id"] === $info["id"] || $loggedin->devowner > 0) && $info["doctor"] == 0) { ?>
                                            <li role="presentation" class=""><a href="#nextp" aria-controls="nextp" role="tab" data-toggle="tab" aria-expanded="false"><i class="fas fa-briefcase-medical"></i> Urmatoarea programare</a>
                                            </li>
                                        <?php } ?>
                                        <?php if($this->session->userdata("logged_in")["id"] === $info["id"] || $loggedin->devowner > 0 || $loggedin->doctor > 0) { ?>
                                            <li role="presentation" class=""><a href="#other" aria-controls="other" role="tab" data-toggle="tab" aria-expanded="false"><i class="fas fa-briefcase-medical"></i> Actiuni</a>
                                            </li>
                                        <?php } ?>
                                        <?php if($loggedin->devowner > 0) { ?>
                                            <li role="presentation" class=""><a href="#admin" aria-controls="admin" role="tab" data-toggle="tab" aria-expanded="false"><i class="fas fa-briefcase-medical"></i> Admin Tools</a>
                                            </li>
                                        <?php } ?>
                                        
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home" role="tabpanel">
                                            <div class="row">                                      
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <table class="table bb">
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="25%">
                                                                            <strong>Nume</strong>
                                                                        </td>
                                                                        <td><?php echo $info["nume"]; ?></td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <td>
                                                                            <strong>Prenume</strong>
                                                                        </td>
                                                                        <td><?php echo $info["prenume"]; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>Email</strong>
                                                                        </td>
                                                                        <td><?php echo $info["email"]; ?></td>
                                                                    </tr>  
                                                                    <?php if($info["doctor"]) { ?>
                                                                        <tr>
                                                                            <td><strong>Tip cont</strong></td>
                                                                            <td>Doctor</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Categorie doctor: </strong></td>
                                                                            <td>
                                                                                <?php $countType = 0; ?>
                                                                                <?php if($info["doctor_type1"] > 0) { ?>
                                                                                          <?php echo doctor_type($info["doctor_type1"]); $countType++; ?>
                                                                                      <?php } ?>
                                                                                      <?php if($info["doctor_type2"] > 0) { ?>
                                                                                          <?php echo ", "; echo doctor_type($info["doctor_type2"]); $countType++; ?>
                                                                                      <?php } ?>
                                                                                      <?php if($info["doctor_type3"] > 0) { ?>
                                                                                          <?php echo ", "; echo doctor_type($info["doctor_type3"]); $countType++; ?>
                                                                                      <?php } ?>
                                                                                      <?php if($info["doctor_type4"] > 0) { ?>
                                                                                          <?php echo ", "; echo doctor_type($info["doctor_type4"]); $countType++; ?>
                                                                                      <?php } ?> 
                                                                                      <?php if($countType == 0 ) { ?>
                                                                                            fara categorie.
                                                                                      <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Limbi straine:</strong></td>
                                                                            <td><?php echo expand_languages($info["languages"]); ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Nota din recenzii:</strong></td>
                                                                            <td>
                                                                                <?php for($index1 = 0; $index1 < ((int)($info["rating_value"]/$info["rating_number"])); $index1++) { ?>
                                                                                    <i class="fas fa-star" style="color: #FF9E00;"></i>
                                                                                <?php } ?>
                                                                                <?php if((int)($info["rating_value"]/$info["rating_number"]) == 0) { ?>
                                                                                    fara recenzii
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>                                                                        
                                                                    <?php } ?>
                                                                    <?php if($info["devowner"] > 0 && $loggedin->devowner > 0) { ?>
                                                                        <tr>
                                                                            <td><strong>Tip permisii</strong></td>
                                                                            <td>dev / owner, level: <?php echo $info["devowner"]; ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>Telefon</strong>
                                                                        </td>
                                                                        <td><?php echo $info["phone"]; ?></td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <td>
                                                                            <strong>Data inregistrarii</strong>
                                                                        </td>
                                                                        <td><?php echo $info["regdate"]; ?></td>
                                                                    </tr> 
                                                                    <tr>
                                                                        <td>
                                                                            <strong>Data nasterii</strong>
                                                                        </td>
                                                                        <td><?php if($info["born_date"] != NULL) { ?>
                                                                            <?php echo $info["born_date"]; ?>
                                                                                <?php } else { ?>
                                                                                    <i>camp necompletat</i>
                                                                                <?php } ?>
                                                                        </td>
                                                                    </tr>                                                                      
                                                                    <tr>
                                                                        <td>
                                                                            <strong>Locatie</strong>
                                                                        </td>
                                                                        <td><?php if($info["location"] != NULL) { ?>
                                                                            <?php echo $info["location"]; ?>
                                                                                <?php } else { ?>
                                                                                    <i>camp necompletat</i>
                                                                                <?php } ?>
                                                                        </td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <td>
                                                                            <strong>Data ultimei programari</strong>
                                                                        </td>
                                                                        <td><?php if($info["data_ultima_programare"] != NULL) { ?>
                                                                            <?php echo $info["data_ultima_programare"]; ?>
                                                                                <?php } else { ?>
                                                                                    <i>nicio programare gasita</i>
                                                                                <?php } ?>
                                                                        </td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <td>
                                                                            <strong>Adresa</strong>
                                                                        </td>
                                                                        <td><?php if($info["adress"] != NULL) { ?>
                                                                            <?php echo $info["adress"]; ?>
                                                                                <?php } else { ?>
                                                                                    <i>camp necompletat</i>
                                                                                <?php } ?>
                                                                        </td>
                                                                    </tr>  
                                                                    <tr>
                                                                        <td>
                                                                            <strong>Cod Postal</strong>
                                                                        </td>
                                                                        <td><?php if($info["zipcode"] != NULL) { ?>
                                                                            <?php echo $info["zipcode"]; ?>
                                                                                <?php } else { ?>
                                                                                    <i>camp necompletat</i>
                                                                                <?php } ?>
                                                                        </td>
                                                                    </tr>                                                                                                                              
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>                                    

                                        <div class="tab-pane" id="nextp" role="tabpanel">
                                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                                <div class="row">                                      
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <?php if($appointmentInfo) { ?>
                                                                    <table class="table table-responsive">                                                                                    
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><b>Data crearii</b></td>
                                                                                <td><?php echo $appointmentInfo->requested_time; ?></td>
                                                                            </tr> 
                                                                            <tr>
                                                                                <td><b>Data aleasa</b></td>
                                                                                <td><?php echo date("d-m-Y", strtotime($appointmentInfo->date)); ?></td>
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
                                                                                            <a href="<?php echo base_url(); ?>programari/view/<?php echo $appointmentInfo->$id; ?>" class="btn btn-purple"><b>vezi detalii</b></a>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>        
                                                                        </tbody>                                          


                                                                    </table>
                                                                <?php } else { ?>
                                                                    Nu a fost gasita nicio programare în baza de date.
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="other" role="tabpanel">
                                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                                <div class="row">                                      
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <div class="col-md-6">
                                                                    <table class="table table-responsive">                                                                                    
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><b>Lista programarilor create de  <?php if($this->session->userdata("logged_in")["id"] === $info["id"]) { ?>dvs.<?php } elseif($loggedin->devowner > 0 || $loggedin->doctor > 0) { ?> <?php echo $info["nume"]; echo " "; echo $info["prenume"]; ?><?php } ?> </b></td>
                                                                                <td><div align="center">
                                                                                            <a href="<?php echo base_url(); ?>logs/appointments/<?php echo $info["id"]; ?>" class="btn btn-purple"><b>vezi lista</b></a>
                                                                                        </div></td>
                                                                            </tr> 
                                                                                <?php if($this->session->userdata("logged_in")["id"] === $info["id"] || $loggedin->devowner > 0) { ?>
                                                                                    <tr>
                                                                                        <td><b>Lista recenziilor lasate de  <?php if($this->session->userdata("logged_in")["id"] === $info["id"]) { ?>dvs.<?php } elseif($loggedin->devowner > 0) { ?> <?php echo $info["nume"]; echo " "; echo $info["prenume"]; ?><?php } ?> </b></td>
                                                                                        <td><div align="center">
                                                                                                    <a href="<?php echo base_url(); ?>logs/reviews/<?php echo $info["id"]; ?>" class="btn btn-purple"><b>vezi recenzii</b></a>
                                                                                                </div></td>
                                                                                    </tr> 
                                                                                <?php } ?>
                                                                            <tr>
                                                                                <td><b>Lista ticketelor lasate de  <?php if($this->session->userdata("logged_in")["id"] === $info["id"]) { ?>dvs.<?php } elseif($loggedin->devowner > 0 || $loggedin->doctor > 0) { ?> <?php echo $info["nume"]; echo " "; echo $info["prenume"]; ?><?php } ?> </b></td>
                                                                                <td><div align="center">
                                                                                        <?php if($this->session->userdata("logged_in")["id"] === $info["id"]) { ?>
                                                                                            <a href="<?php echo base_url(); ?>contact" class="btn btn-purple"><b>vezi tickete</b></a>
                                                                                        <?php } elseif($loggedin->devowner > 0 || $loggedin->doctor > 0) { ?> 
                                                                                            <a href="<?php echo base_url(); ?>logs/tickets/<?php echo $info["id"]; ?>" class="btn btn-purple"><b>vezi recenzii</b></a>
                                                                                        <?php } ?>                                                                                            
                                                                                        </div></td>
                                                                            </tr> 
                                                                        </tbody>                                        
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="admin" role="tabpanel">
                                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                                <div class="row">                                      
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <div class="col-md-6">
                                                                    <table class="table table-responsive">                                                                                    
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <ul>
                                                                                        <li><a href="<?php echo base_url(); ?>logs/iplogs/<?php echo $this->uri->segment(2); ?>">lista IP-uri conectate pe cont</a></li>
                                                                                    </ul>
                                                                                    <hr>
                                                                                    <ul>
                                                                                        <li><a href="#"><button type="button" data-toggle="modal" data-target="#setDoctor" style="background: transparent;border: none;padding: 0;">
                                                                                            <?php if($info["doctor"] == 0) { ?>
                                                                                                seteaza profil la gradul de doctor
                                                                                            <?php } else { ?>
                                                                                                scoate gradul de doctor
                                                                                            <?php } ?></button></a></li>
                                                                                        <li><a href="#"><button type="button" data-toggle="modal" data-target="#addDoctorR" style="background: transparent;border: none;padding: 0;">seteaza tipul de doctor</button></a></li>
                                                                                        <hr>
                                                                                        <li><a href="#"><button type="button" data-toggle="modal" data-target="#setAdmin" style="background: transparent;border: none;padding: 0;">seteaza user ca administrator</button></a></li>
                                                                                    </ul>
                                                                                </td>
                                                                            </tr> 
                                                                        </tbody>                                        
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="modal fade" id="addDoctorR" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">Seteaza tipul de doctor</h4>
                                        </div>
                                        <?php echo form_open("profile/setdoctorroles"); ?>
                                        <div class="modal-body">
                                            <input type="hidden" name="userID" value="<?php echo $info["id"]; ?>">
                                            <div class="form-group">
                                                <label>Specializare 1:</label>
                                                <select class="form-control m-b" name="specializare1" required>
                                                            <?php if($info["doctor_type1"] > 0) { ?>
                                                                <option selected value="<?php echo $info["doctor_type1"]; ?>">setata deja: <?php echo doctor_type($info["doctor_type1"]); ?></option>
                                                            <?php } else { ?>
                                                                <option disabled selected value> -- alege specializare -- </option>
                                                            <?php } ?>
                                                           <option value="1">Acupunctura</option>
                                                           <option value="2">Alergologie pediatrica</option>
                                                           <option value="3">Alergologie si imunologie clinica</option>
                                                           <option value="4">Anestezie si terapie intensiva</option>
                                                           <option value="5">Apifitoterapie</option>
                                                           <option value="6">Boli infectioase</option>
                                                           <option value="7">Cardiologie</option>
                                                           <option value="8">Cardiologie pediatrica</option>
                                                           <option value="9">Chirurgie cardiovasculara</option>
                                                           <option value="10">Chirurgie generala</option>
                                                           <option value="11">Chirurgie pediatrică</option>
                                                           <option value="12">Chirurgie plastică</option>
                                                           <option value="13">Chirurgie vasculara</option>
                                                           <option value="14">Consiliere nutritie pediatrica</option>
                                                           <option value="15">Dermatologie</option>
                                                           <option value="16">Diabetologie</option>
                                                           <option value="17">Ecografie</option>
                                                           <option value="18">Endocrinologie</option>
                                                           <option value="19">Epidemiologie</option>
                                                           <option value="20">Gastroenterologie</option>
                                                           <option value="21">Genetica medicala</option>
                                                           <option value="22">Geriatrie - gerontologie</option>
                                                           <option value="23">Ginecologie</option>
                                                           <option value="24">Hematologie</option>
                                                           <option value="25">Homeopatie</option>
                                                           <option value="26">Medicină de familie</option>
                                                           <option value="27">Medicină de urgență</option>
                                                           <option value="28">Medicină fizică și de reabilitare</option>
                                                           <option value="29">Medicină generală</option>
                                                           <option value="30">Medicină internă</option>
                                                           <option value="31">Medicină maritimă</option>
                                                           <option value="32">Medicina muncii</option>
                                                           <option value="33">Nefrologie</option>
                                                           <option value="34">Neonatologie</option>
                                                           <option value="35">Neurochirurgie</option>
                                                           <option value="36">Neurologie</option>
                                                           <option value="37">Neurologie pediatrica</option>
                                                           <option value="38">Oftalmologie</option>
                                                           <option value="39">Oncologie medicala</option>
                                                           <option value="40">ORL</option>
                                                           <option value="41">ORL pediatric</option>
                                                           <option value="42">Ortopedie</option>
                                                           <option value="43">Ortopedie pediatrica</option>
                                                           <option value="44">Pediatrie</option>
                                                           <option value="45">Pneumologie</option>
                                                           <option value="46">Proctologie</option>
                                                           <option value="47">Psihiatrie</option>
                                                           <option value="48">Psihiatrie pediatrica</option>
                                                           <option value="49">Psihologie</option>
                                                           <option value="50">Psihoterapie</option>
                                                           <option value="51">Reumatologie</option>
                                                           <option value="52">Stomatologie</option>
                                                           <option value="53">Urologie</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Specializare 2:</label>
                                                <select class="form-control m-b" name="specializare2">
                                                           <?php if($info["doctor_type2"] > 0) { ?>
                                                                <option selected value="<?php echo $info["doctor_type2"]; ?>">setata deja: <?php echo doctor_type($info["doctor_type2"]); ?></option>
                                                            <?php } else { ?>
                                                                <option disabled selected value> -- alege specializare -- </option>
                                                            <?php } ?>
                                                           <option value="1">Acupunctura</option>
                                                           <option value="2">Alergologie pediatrica</option>
                                                           <option value="3">Alergologie si imunologie clinica</option>
                                                           <option value="4">Anestezie si terapie intensiva</option>
                                                           <option value="5">Apifitoterapie</option>
                                                           <option value="6">Boli infectioase</option>
                                                           <option value="7">Cardiologie</option>
                                                           <option value="8">Cardiologie pediatrica</option>
                                                           <option value="9">Chirurgie cardiovasculara</option>
                                                           <option value="10">Chirurgie generala</option>
                                                           <option value="11">Chirurgie pediatrică</option>
                                                           <option value="12">Chirurgie plastică</option>
                                                           <option value="13">Chirurgie vasculara</option>
                                                           <option value="14">Consiliere nutritie pediatrica</option>
                                                           <option value="15">Dermatologie</option>
                                                           <option value="16">Diabetologie</option>
                                                           <option value="17">Ecografie</option>
                                                           <option value="18">Endocrinologie</option>
                                                           <option value="19">Epidemiologie</option>
                                                           <option value="20">Gastroenterologie</option>
                                                           <option value="21">Genetica medicala</option>
                                                           <option value="22">Geriatrie - gerontologie</option>
                                                           <option value="23">Ginecologie</option>
                                                           <option value="24">Hematologie</option>
                                                           <option value="25">Homeopatie</option>
                                                           <option value="26">Medicină de familie</option>
                                                           <option value="27">Medicină de urgență</option>
                                                           <option value="28">Medicină fizică și de reabilitare</option>
                                                           <option value="29">Medicină generală</option>
                                                           <option value="30">Medicină internă</option>
                                                           <option value="31">Medicină maritimă</option>
                                                           <option value="32">Medicina muncii</option>
                                                           <option value="33">Nefrologie</option>
                                                           <option value="34">Neonatologie</option>
                                                           <option value="35">Neurochirurgie</option>
                                                           <option value="36">Neurologie</option>
                                                           <option value="37">Neurologie pediatrica</option>
                                                           <option value="38">Oftalmologie</option>
                                                           <option value="39">Oncologie medicala</option>
                                                           <option value="40">ORL</option>
                                                           <option value="41">ORL pediatric</option>
                                                           <option value="42">Ortopedie</option>
                                                           <option value="43">Ortopedie pediatrica</option>
                                                           <option value="44">Pediatrie</option>
                                                           <option value="45">Pneumologie</option>
                                                           <option value="46">Proctologie</option>
                                                           <option value="47">Psihiatrie</option>
                                                           <option value="48">Psihiatrie pediatrica</option>
                                                           <option value="49">Psihologie</option>
                                                           <option value="50">Psihoterapie</option>
                                                           <option value="51">Reumatologie</option>
                                                           <option value="52">Stomatologie</option>
                                                           <option value="53">Urologie</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Specializare 3:</label>
                                                <select class="form-control m-b" name="specializare3">
                                                           <?php if($info["doctor_type3"] > 0) { ?>
                                                                <option selected value="<?php echo $info["doctor_type3"]; ?>">setata deja: <?php echo doctor_type($info["doctor_type3"]); ?></option>
                                                            <?php } else { ?>
                                                                <option disabled selected value> -- alege specializare -- </option>
                                                            <?php } ?>
                                                           <option value="1">Acupunctura</option>
                                                           <option value="2">Alergologie pediatrica</option>
                                                           <option value="3">Alergologie si imunologie clinica</option>
                                                           <option value="4">Anestezie si terapie intensiva</option>
                                                           <option value="5">Apifitoterapie</option>
                                                           <option value="6">Boli infectioase</option>
                                                           <option value="7">Cardiologie</option>
                                                           <option value="8">Cardiologie pediatrica</option>
                                                           <option value="9">Chirurgie cardiovasculara</option>
                                                           <option value="10">Chirurgie generala</option>
                                                           <option value="11">Chirurgie pediatrică</option>
                                                           <option value="12">Chirurgie plastică</option>
                                                           <option value="13">Chirurgie vasculara</option>
                                                           <option value="14">Consiliere nutritie pediatrica</option>
                                                           <option value="15">Dermatologie</option>
                                                           <option value="16">Diabetologie</option>
                                                           <option value="17">Ecografie</option>
                                                           <option value="18">Endocrinologie</option>
                                                           <option value="19">Epidemiologie</option>
                                                           <option value="20">Gastroenterologie</option>
                                                           <option value="21">Genetica medicala</option>
                                                           <option value="22">Geriatrie - gerontologie</option>
                                                           <option value="23">Ginecologie</option>
                                                           <option value="24">Hematologie</option>
                                                           <option value="25">Homeopatie</option>
                                                           <option value="26">Medicină de familie</option>
                                                           <option value="27">Medicină de urgență</option>
                                                           <option value="28">Medicină fizică și de reabilitare</option>
                                                           <option value="29">Medicină generală</option>
                                                           <option value="30">Medicină internă</option>
                                                           <option value="31">Medicină maritimă</option>
                                                           <option value="32">Medicina muncii</option>
                                                           <option value="33">Nefrologie</option>
                                                           <option value="34">Neonatologie</option>
                                                           <option value="35">Neurochirurgie</option>
                                                           <option value="36">Neurologie</option>
                                                           <option value="37">Neurologie pediatrica</option>
                                                           <option value="38">Oftalmologie</option>
                                                           <option value="39">Oncologie medicala</option>
                                                           <option value="40">ORL</option>
                                                           <option value="41">ORL pediatric</option>
                                                           <option value="42">Ortopedie</option>
                                                           <option value="43">Ortopedie pediatrica</option>
                                                           <option value="44">Pediatrie</option>
                                                           <option value="45">Pneumologie</option>
                                                           <option value="46">Proctologie</option>
                                                           <option value="47">Psihiatrie</option>
                                                           <option value="48">Psihiatrie pediatrica</option>
                                                           <option value="49">Psihologie</option>
                                                           <option value="50">Psihoterapie</option>
                                                           <option value="51">Reumatologie</option>
                                                           <option value="52">Stomatologie</option>
                                                           <option value="53">Urologie</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Specializare 4:</label>
                                                <select class="form-control m-b" name="specializare4">
                                                           <?php if($info["doctor_type4"] > 0) { ?>
                                                                <option selected value="<?php echo $info["doctor_type4"]; ?>">setata deja: <?php echo doctor_type($info["doctor_type4"]); ?></option>
                                                            <?php } else { ?>
                                                                <option disabled selected value> -- alege specializare -- </option>
                                                            <?php } ?>
                                                           <option value="1">Acupunctura</option>
                                                           <option value="2">Alergologie pediatrica</option>
                                                           <option value="3">Alergologie si imunologie clinica</option>
                                                           <option value="4">Anestezie si terapie intensiva</option>
                                                           <option value="5">Apifitoterapie</option>
                                                           <option value="6">Boli infectioase</option>
                                                           <option value="7">Cardiologie</option>
                                                           <option value="8">Cardiologie pediatrica</option>
                                                           <option value="9">Chirurgie cardiovasculara</option>
                                                           <option value="10">Chirurgie generala</option>
                                                           <option value="11">Chirurgie pediatrică</option>
                                                           <option value="12">Chirurgie plastică</option>
                                                           <option value="13">Chirurgie vasculara</option>
                                                           <option value="14">Consiliere nutritie pediatrica</option>
                                                           <option value="15">Dermatologie</option>
                                                           <option value="16">Diabetologie</option>
                                                           <option value="17">Ecografie</option>
                                                           <option value="18">Endocrinologie</option>
                                                           <option value="19">Epidemiologie</option>
                                                           <option value="20">Gastroenterologie</option>
                                                           <option value="21">Genetica medicala</option>
                                                           <option value="22">Geriatrie - gerontologie</option>
                                                           <option value="23">Ginecologie</option>
                                                           <option value="24">Hematologie</option>
                                                           <option value="25">Homeopatie</option>
                                                           <option value="26">Medicină de familie</option>
                                                           <option value="27">Medicină de urgență</option>
                                                           <option value="28">Medicină fizică și de reabilitare</option>
                                                           <option value="29">Medicină generală</option>
                                                           <option value="30">Medicină internă</option>
                                                           <option value="31">Medicină maritimă</option>
                                                           <option value="32">Medicina muncii</option>
                                                           <option value="33">Nefrologie</option>
                                                           <option value="34">Neonatologie</option>
                                                           <option value="35">Neurochirurgie</option>
                                                           <option value="36">Neurologie</option>
                                                           <option value="37">Neurologie pediatrica</option>
                                                           <option value="38">Oftalmologie</option>
                                                           <option value="39">Oncologie medicala</option>
                                                           <option value="40">ORL</option>
                                                           <option value="41">ORL pediatric</option>
                                                           <option value="42">Ortopedie</option>
                                                           <option value="43">Ortopedie pediatrica</option>
                                                           <option value="44">Pediatrie</option>
                                                           <option value="45">Pneumologie</option>
                                                           <option value="46">Proctologie</option>
                                                           <option value="47">Psihiatrie</option>
                                                           <option value="48">Psihiatrie pediatrica</option>
                                                           <option value="49">Psihologie</option>
                                                           <option value="50">Psihoterapie</option>
                                                           <option value="51">Reumatologie</option>
                                                           <option value="52">Stomatologie</option>
                                                           <option value="53">Urologie</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" type="submit">Seteaza</button>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal fade" id="setDoctor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Seteaza gradul user-ului <?php echo $info["id"]; ?></h4>
                                            </div>
                                            <?php echo form_open("profile/setdoctor"); ?>
                                            <div class="modal-body">
                                                <input type="hidden" name="userID" value="<?php echo $info["id"]; ?>">
                                                <label>Esti sigur ca vrei sa faci asta?</label>
                                            <div class="modal-footer">
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-primary" type="submit">
                                                    <?php if($info["doctor"] == 0) { ?>
                                                        Seteaza ca doctor
                                                        <?php } else { ?>
                                                        Scoate gradul de doctor
                                                    <?php } ?>
                                                </button>
                                            </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal fade" id="setAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">Seteaza gradul user-ului <?php echo $info["id"]; ?> la administrator</h4>
                                            </div>
                                            <?php echo form_open("profile/setadmin"); ?>
                                            <div class="modal-body">
                                                <input type="hidden" name="userID" value="<?php echo $info["id"]; ?>">
                                                <label>Esti sigur ca vrei sa faci asta?</label>
                                            <div class="modal-footer">
                                                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-primary" type="submit">
                                                    <?php if($info["devowner"] == 0) { ?>
                                                        Seteaza ca administrator
                                                        <?php } else { ?>
                                                        Scoate gradul de administrator
                                                    <?php } ?>
                                                </button>
                                            </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="panel panel-default">
                                <div class="panel-body">                                                 
                                    <img style="width: 355px; display: block;margin: auto; border-radius: 5%;" src="<?php echo base_url(); ?>assets/img/profilepictures/<?php echo $info["picture_path"]; ?>" class="img-responsive" alt="Big avatar">                                                       
                                    <h3 class="m0" style="text-align:center"><br>
                                        <?php echo $info["nume"]; ?> <?php echo $info["prenume"]; ?> 
                                    </h3><br>                                                
                                    
                                    <?php if($this->session->userdata("logged_in")["id"] === $info["id"] || $loggedin->devowner > 0) { ?>
                                        <div align="center">
                                            <h4>
                                                <a href="<?php echo base_url("profile/editprofile"); ?>">[editare profil]</a>
                                            </h4>
                                        </div>
                                    <?php } ?>

                                    <div style="text-align:center;">
                                        <?php if($info["Admin"] > 6) { ?>
                                            <span class="label" style="background-color: #00a65a;"><font style="font-family:tahoma; font-size:12px;"><i class="fa fa-cog"></i> owner</font></span><br>
                                        <?php } ?>
                                    </div>                                                             
                                </div>
                                </div>
                            
                                <?php if($this->session->userdata("logged_in")["id"] != $info["id"]) { ?>
                                    <a href="<?php echo base_url("complaint/create/" . $info["id"] . ""); ?>" style="display:block;margin:auto" class="btn btn-danger">Reclama jucator</a><br>
                                <?php } ?>
                        </div>                
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>
<script>
    <?php if($loggedin->devowner > 0) { ?>
    $('#addDoctorR').appendTo("body");
    $('#setDoctor').appendTo("body");
    $('#setAdmin').appendTo("body");    
    <?php } ?>
</script>