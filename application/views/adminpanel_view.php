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
        <h3>Admin panel</h3>
        <div class="row">
        <div class="col-md-12">                      
	        <div class="panel widget">
	            <div class="panel-body">
	                <div class="row">
	                    <div class="col-xs-8">
	                        <div class="panel-heading"><h3 class="m0">Admin view</h3></div>
	                        <div class="panel-body">
		                        Programari fara raspuns (in asteptare): <?php echo $waitingAppointments; ?>
		                        <br><br>
		                        <a href="<?php echo base_url(); ?>programari/admin" class="btn btn-purple btn-xs"><i class="fa fa-search-plus"></i> vezi lista programari in asteptare</a><br>		                        
                         	</div>
                         </div>
					                <div class="panel widget">
					                    <div class="panel-body">
					                        <div class="row row-table">
					                            <div class="col-xs-6 pull-left">
					                                <h3 class="m0">Sterge cache</h3>
					                            </div>
					                            <div class="col-xs-6 pull-right">
					                                <a class="btn btn-purple pull-right" href="<?php echo base_url("adminpanel/flushcache/"); ?>">
					                                    <i class="fas fa-trash-alt"></i> 
					                                    <span>Go!</span>
					                                </a>
					                            </div>
					                        </div>
					                    </div>
					                </div>
                         
                        <div class="col-xs-4 pull-right">
	                            <h4>Cauta utilizator</h4>
	                            <?php if(strlen(validation_errors())): ?>
								    <div class="alert alert-danger" role="alert">
								        <?php echo $this->session->flashdata('error'); ?>
								        <?php echo validation_errors(); ?>
								    </div>
							    <?php endif; ?>

	                            <?php echo form_open("adminpanel"); ?>
			                        <div class="form-group">
			                        	<input type="hidden" name="checker" value="yes">
			                        	<label>Cautare dupa email:</label>
			                        	<input type="text" name="email" class="form-control" placeholder="introdu emailul utilizatorului cautat">
			                        </div>
			                        <div class="form-group">
			                        	<label>Cautare dupa nume prenume:</label>
			                        	<input type="text" name="nume" class="form-control" placeholder="introdu numele utilizatorului cautat">
			                        		<br>
			                        	<input type="text" name="prenume" class="form-control" placeholder="introdu prenumele utilizatorului cautat">
			                        </div>
			                        <div class="form-group">
			                        	<label>Cautare dupa numarul de telefon:</label>
			                        	<input type="text" name="phone" class="form-control" placeholder="introdu emailul utilizatorului cautat">
			                        </div>
			                        <div class="form-group">
			                        	<button class="btn btn-purple pull-right" style="display: inline-block;" type="submit">
			                            	<em class="fa fa-hand-o-right"></em>
			                            	<span>Search</span>
			                        	</button>
			                        </div>
			                    <?php echo form_close(); ?>
			                </div>
	                    </div>	               
	                	
	                	<?php if($searched != NULL) { ?>		                	
		                		<div align="center"><h4>Rezultate (<?php echo $numberOfUsersFound; ?> utilizatori gasiti)</h4><br>
						            <div class="panel-body">
						            	<table style="width: 75%" class="table table-hover">
						                                        <thead>
						                                            <tr>
						                                                <th>#ID</th>
						                                                <th>Nume Prenume</th>
						                                                <th>Email</th>
						                                                <th>Telefon</th>
						                                                <th>Locatie</th>
						                                            </tr>
						                                        </thead>
						                                        <tbody>
						                                            <?php $count = 0; ?>
						                                            <?php foreach($searched as $row) { ?>
						                                            <tr>
						                                                <?php $count++; ?>
						                                                <td><?php echo $count; ?></td>
						                                                <td>
						                                                    <a data-toggle="tooltip" title="" href="<?php echo base_url(); ?>profile/<?php echo $row->id; ?>"><?php echo $row->nume; ?> <?php echo $row->prenume; ?></a>
						                                                </td>
						                                                <td><?php echo $row->email; ?></td>
						                                                <td><?php echo $row->phone; ?></td>
						                                                <td><?php echo $row->location; ?></td>						                                                
						                                            </tr>
						                                            <?php } ?>
						                                        </tbody>
						                </table>
						            </div>
				            </div>
	                	<?php } elseif($numberOfUsersFound == 0) { ?>
	                		<div align="center">
	                			Nu a fost gasit niciun utilizator pentru filtrele alese.
	                		</div>
	                	<?php } ?>
	            </div>
	        </div>       
	    
	        </div>
   		</div>
   	</div>
</section>
