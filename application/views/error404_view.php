<section>
    <div class="content-wrapper">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-uppercase col-xs-12">
                        <h1>404</h1>
                        <h5>Page Not Found</h5>
                        <p>oops! pagina nu a fost gasita</p>
                        <div align="center">
                            <a href="<?php echo base_url(); ?>" class="btn btn-error btn-lg waves-effect">inapoi la pagina principala</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" language="JavaScript">
    setTimeout(function () {
   window.location.href= "<?php echo base_url(); ?>";
},4200);
</script>