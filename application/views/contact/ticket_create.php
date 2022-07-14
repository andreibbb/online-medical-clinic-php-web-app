<section>
    <!-- Page content-->
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
        
        <div class="col-lg-12">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="unwrap">
                                <div class="bg-cover">
                                    <div class="container container-md pv-lg">
                                        <div class="text-center mb-lg pb-lg">
                                            <div class="h1 text-bold">Contactează-ne!</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_open("contact/createticket"); ?>
                                                      
                                <div class="form-group row">
                                    <label class="col-sm-2">Categorie ticket</label>
                                    <div class="col-sm-10">
                                    <select class="form-control form-control-rounded" name="reason" required>
                                    <option disabled selected value> -- alege categorie -- </option>
                                      <option value="suportclienti">Suport clienti</option>
                                      <option value="tehnic">Tehnic</option>
                                      <option value="financiar">Financiar</option>
                                      <option value="sesizari">Sesizari / reclamatii</option>
                                      <option value="feedback">Feedback website</option>
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-2">Mesajul dvs.:</label>
                                    <div class="col-sm-10">
                                    <textarea class="form-control" name="currentDescription" rows="3" style="height: 200px;" required></textarea>
                                    </div>
                                </div>
                              <button type="submit" class="btn btn-purple pull-right"><i class="fa fa-paper-plane"></i> submit ticket</button>

                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                        <div class="panel panel-default">
                        <div class="panel-body">
                            <h4><em class="fa-1x mr-2 fa fa-check-circle"></em> Informatii deschidere ticket</h4>
                        <br>
                            <div class="md-input-wrapper">
                                Recomandarea noastră este să scrieți cât mai clar problema sau motivul pentru care creați ticket-ul astfel încât să va putem ajuta ușor fara să mai fie nevoie de întrebari suplimentare din partea noastră.<br><br>
                                Nu există un termen prestabilit în care primești un răspuns la ticket, dar deobicei primești un răspuns în mai puțin de <b>24 de ore</b>.<br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>
