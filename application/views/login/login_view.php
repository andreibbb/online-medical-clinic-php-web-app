<section>
	<div class="block-center mt-xl wd-xxl">

    <?php if($this->session->flashdata('error') !== null || strlen(validation_errors())): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $this->session->flashdata('error'); ?>
        <?php echo validation_errors(); ?>
    </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('succes') !== null): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('succes'); ?>
    </div>
    <?php endif; ?>
			     <!-- START panel-->
			     <div class="panel panel-default">
			        <div class="panel-heading text-center" style="background-color: #23b7e5;">
			           <a href="#">
			              <img class="block-center img-rounded" src="<?php echo base_url("assets/img/logo.png"); ?>" alt="Image">
			           </a>
			        </div>
			        <div class="panel-body">

			           <p class="text-center pv">SIGN IN TO CONTINUE.</p>

			           <?php echo form_open("login/continueLogin/"); ?>
			              <div class="form-group has-feedback">
			                 <input class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Enter email" required>
			                 <span class="fa fa-user form-control-feedback text-muted"></span>
			              </div>
			              <div class="form-group has-feedback">
			                 <input class="form-control" id="exampleInputPassword1" name="password" type="password" value="<?php echo set_value('password'); ?>" placeholder="Password" required>
			                 <span class="fa fa-lock form-control-feedback text-muted"></span>
			              </div>
			              <div class="clearfix">
			                 <div class="checkbox c-checkbox pull-left mt0">
			                    <label>
			                       <input type="checkbox" value="" name="remember">
			                       <span class="fa fa-check"></span>Remember Me</label>
			                 </div>
			                 <div class="pull-right"><a class="text-muted" href="<?php echo base_url("login/recover"); ?>">Forgot your password?</a>
			                 </div>
			              </div>
			              <div align="center">
			                 <?php echo $widget;?>
			                 <?php echo $script;?>
			              </div>
			              <button class="btn btn-block btn-primary mt-lg" type="submit">Login</button>
			           <?php echo form_close(); ?>
			        </div>
			     </div>
			     <!-- END panel-->
	</div>
</section>