<section>
    <div class="content-wrapper">
        <h3>Medici <?php if($this->uri->segment(2) == "filtre") { ?>(rezultate gasite: <?php echo $totalResults; ?>)<?php } ?></h3>
        
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
         
            <div class="col-md-12">
                
                <div class="mb-lg clearfix">
                    <div class="pull-left">
                    </div>
                    <div class="pull-right">
                        <p class="mb0 mt-sm"></p>
                    </div>
                </div>
                <div class="panel b">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="datatable1">

                                <tbody>
                                    <?php $index = 1; ?>
                                    <?php if($results) { ?>
                                    <?php foreach($results as $row): ?>
                                        <?php if($index % 2 == 1) { ?>
                                            <?php $index++; ?>
                                            <tr>
                                            <td class="col-2"><img src="<?php echo base_url(); ?>/assets/img/profilepictures/<?php echo $row->picture_path; ?>" height="190"></td>
                                            <td><h3>Dr. <?php echo $row->nume; ?> <?php echo $row->prenume; ?></h3>
                                                <b><i class="fas fa-stethoscope"></i> Specializare:</b> 
                                                                                      <?php if($row->doctor_type1 > 0) { ?>
                                                                                          <?php echo doctor_type($row->doctor_type1); ?>
                                                                                      <?php } ?>
                                                                                      <?php if($row->doctor_type2 > 0) { ?>
                                                                                          <?php echo ", "; echo doctor_type($row->doctor_type2); ?>
                                                                                      <?php } ?>
                                                                                      <?php if($row->doctor_type3 > 0) { ?>
                                                                                          <?php echo ", "; echo doctor_type($row->doctor_type3); ?>
                                                                                      <?php } ?>
                                                                                      <?php if($row->doctor_type4 > 0) { ?>
                                                                                          <?php echo ", "; echo doctor_type($row->doctor_type4); ?>
                                                                                      <?php } ?>                                                                                      
                                                                                      <br>
                                                    <?php $languagesFormatter = expand_languages($row->languages); ?>
                                                    <?php if($languagesFormatter != "no_lang") { ?>
                                                        <b><i class="fas fa-language"></i> Limbi straine:</b> <?php echo expand_languages($row->languages); ?>
                                                    <?php } ?>
                                                    <?php if($row->rating_number > 0) { ?>
                                                      <i class="far fa-smile"></i> Rating:
                                                      <?php for($index3 = 0; $index3 < ((int)($row->rating_value/$row->rating_number)); $index3++) { ?>
                                                        <i class="fas fa-star" style="color: #FF9E00;"></i>
                                                      <?php } ?>
                                                    <?php } ?>
                                            </td>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>programare/new/<?php echo $row->id; ?>" class="btn btn-purple"><i class="fa fa-search-plus"></i> solicita programare</a>
                                            </td>                                  
                                        <?php } else { ?>      
                                        <?php $index++; ?>                                          
                                            <td class="col-2"><img src="<?php echo base_url(); ?>/assets/img/profilepictures/<?php echo $row->picture_path; ?>" height="190"></td>
                                            <td><h3>Dr. <?php echo $row->nume; ?> <?php echo $row->prenume; ?></h3>
                                                <b><i class="fas fa-stethoscope"></i> Specializare:</b> 
                                                                                      <?php if($row->doctor_type1 > 0) { ?>
                                                                                          <?php echo doctor_type($row->doctor_type1); ?>
                                                                                      <?php } ?>
                                                                                      <?php if($row->doctor_type2 > 0) { ?>
                                                                                          <?php echo ", "; echo doctor_type($row->doctor_type2); ?>
                                                                                      <?php } ?>
                                                                                      <?php if($row->doctor_type3 > 0) { ?>
                                                                                          <?php echo ", "; echo doctor_type($row->doctor_type3); ?>
                                                                                      <?php } ?>
                                                                                      <?php if($row->doctor_type4 > 0) { ?>
                                                                                          <?php echo ", "; echo doctor_type($row->doctor_type4); ?>
                                                                                      <?php } ?>                                                                                      
                                                                                      <br>
                                                    <?php $languagesFormatter = expand_languages($row->languages); ?>
                                                    <?php if($languagesFormatter != "no_lang") { ?>
                                                        <b><i class="fas fa-language"></i> Limbi straine:</b> <?php echo expand_languages($row->languages); ?>
                                                    <?php } ?>
                                                    <?php if($row->rating_number > 0) { ?>
                                                      <i class="far fa-smile"></i> Rating:
                                                      <?php for($index3 = 0; $index3 < ((int)($row->rating_value/$row->rating_number)); $index3++) { ?>
                                                        <i class="fas fa-star" style="color: #FF9E00;"></i>
                                                      <?php } ?>
                                                    <?php } ?>
                                            </td>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>programare/new/<?php echo $row->id; ?>" class="btn btn-purple"><i class="fa fa-search-plus"></i> solicita programare</a>
                                            </td>   
                                            </tr>                                    
                                        <?php } ?>
                                    <?php endforeach; ?>
                                <?php } else { ?>                                    
                                    <div align="center">
                                        <img src="<?php echo base_url(); ?>assets/img/notfound.png"><br>
                                        Nu a fost gasit niciun rezultat pentru filtrele alese.
                                    </div>
                                <?php } ?>
                                </tbody>
                            </table>
                            <?php if (isset($links)) { ?>
                                <?php echo $links ?>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <div class="container container-sm"><br>
                    <h3>Cauta doctor</h3>
                        <?php echo form_open("medici/filtre"); ?>
                                <div class="form-group">
                                    <input class="form-control input-lg radius-clear" type="text" name="doctorname" id="searchPlayer" placeholder="Introdu numele si prenumele doctorului cautat">
                                </div>                            
                                <div class="form-group">
                                    <label>Specializare</label>
                                    <select class="form-control m-b" name="specializare">
                                                   <option disabled selected value> -- alege specializare -- </option>
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
                                <input type="hidden" name="after" value="after">                            
                                <div class="text-center">
                                    <button class="btn btn-labeled btn-primary mb-2" id="searchButton" type="submit"><span class="btn-label"><i class="fa fa-times"></i></span> cauta doctor</button>
                                </div>
                        <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>