<section>
    <div class="content-wrapper">
        <h3>Știri din domeniul medical</h3>

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
                <?php if(getUserData($this->session->userdata("logged_in")["id"], "devowner") > 0) { ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4>Insereaza actualizare</h4><br>
                                <?php echo form_open_multipart("news/insertNews"); ?>
                                    <div class="form-group">
                                        <label>Titlu</label>
                                        <input type="text" class="form-control" placeholder="titlu stire" name="titlu" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Continut stire</label>
                                        <textarea id="update" name="text" class="form-control"></textarea>
                                    </div>
                                        
                                    <div class="form-group">
                                        <label>News photo</label>
                                        <input class="form-control" name="profilepicture" accept="image/*" type="file" enctype='multipart/form-data'>
                                    </div>
                                        
                                    <button type="submit" class="form-control btn-primary">Submit</button>
                                <?php echo form_close(); ?>
                        </div>
                    </div>
                <?php } ?>
                
                    <div class="panel panel-default">
                        <div class="panel-body">                        
                            <?php if($news) { ?>
                                <?php foreach($news as $row) { ?>
                                    <div class="media">         
                                        <table class="table table-responsive">
                                            <tr>
                                                <td>
                                                    <div class="media-left media-middle photo-table">
                                                        <img src="<?php echo base_url(); ?>assets/img/newsphoto/<?php echo $row->photo_path; ?>" alt="Avatar" class="media-object img-thumbnail thumb62"> 
                                                    </div>           
                                                </td>                                               
                                                <td>
                                                    <div class="media-body">
                                                        <a href="#" style="font-size: 14px;"><b><?php echo $row->title; ?></b></a><br>
                                                        <p>data postarii: <?php echo $row->dateadd; ?></p>                                         
                                                    </div><br>
                                                    <?php echo substr(htmlentities(str_replace("<p>", "", $row->text)), 0, 500); ?>... <a href="<?php echo base_url(); ?>/news/view/<?php echo $row->id; ?>"><b><i>citeste tot</i></b></a>
                                                
                                                </td>
                                            </tr>
                                        </table>
                                        <hr>
                                    </div>                                     
                                </li>
                            <?php } } else { ?>
                                Nu a fost gasita nicio stire in baza de date.
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if(getUserData($this->session->userdata("logged_in")["id"], "devowner") > 0): ?>
<script src="//cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
<script>
CKEDITOR.replace("update");
</script>
<?php endif; ?>