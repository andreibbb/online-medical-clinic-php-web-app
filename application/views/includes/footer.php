<footer>

    <span>&copy; copyright 2020</span> 

    <span class="pull-right">render time: <?php echo $this->benchmark->elapsed_time(); ?> / memory usage: <?php echo $this->benchmark->memory_usage();?> - based on <a href="https://codeigniter.com/">codeigniter</a> framework</span>

        </footer>

    </div>
<div class="modal fade" id="modalshow" tabindex="-1" role="dialog" aria-labelledby="modalshow" aria-hidden="true"  style="color:black;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalshow_title">Modal title</h5>
      </div>
      <div class="modal-body" id="modalshow_body">
      </div>
    </div>
  </div>
</div>

<!-- =============== VENDOR SCRIPTS ===============-->

<!-- MODERNIZR-->

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/modernizr/modernizr.custom.js"></script>

<!-- MATCHMEDIA POLYFILL-->

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/matchMedia/matchMedia.js"></script>

<!-- JQUERY-->

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>

<!-- BOOTSTRAP-->

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/bootstrap/dist/js/bootstrap.js"></script>

<!-- STORAGE API-->

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jQuery-Storage-API/jquery.storageapi.js"></script>

<!-- JQUERY EASING-->

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery.easing/js/jquery.easing.js"></script>

<!-- ANIMO-->

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/animo.js/animo.js"></script>

<!-- SLIMSCROLL-->

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/slimScroll/jquery.slimscroll.min.js"></script>

<!-- SPARKLINE-->

<script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/sparkline/index.js"></script>
  
<!-- =============== APP SCRIPTS ===============-->

<script src="<?php echo $this->config->config['base_url']; ?>assets/js/app.js"></script>

<script src="https://panel.eclipsed.ro/assets/js/jquery.knob.min.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script>
      $( function() {
        $( "#datepicker" ).datepicker();
      } );
      </script>

<?php if($this->uri->segment(1) == "admin"): ?>

<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-wysiwyg/bootstrap-wysiwyg.js"></script>

<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-wysiwyg/external/jquery.hotkeys.js"></script>

<script>$('.wysiwyg').wysiwyg(); </script>

<?php endif; ?>

</body>
</html>