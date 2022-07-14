<section>
    <div class="content-wrapper">

            <div class="unwrap">
                <div class="container container-md pv-lg">
                    <div class="text-center mb-lg pb-lg">
                        <div class="h2 text-bold">Cauta un doctor</div>
                        <p>Introdu numele si prenumele doctorului sau specializare pentru docotrul pe care vrei sa il cauti. Daca se vor gasi foarte multe rezultate acestea se vor imparti pe mai multe pagini.</p>
                    </div>
                </div>
        </div>

        <div class="container container-md">
            <div id="step1">
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
                <div class="container container-sm"><br>
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

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>
