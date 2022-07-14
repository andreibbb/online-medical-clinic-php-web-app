<?php if(get_info("Value", "panel_assets", "Name", "Maintenance") == 1 && $this->uri->segment(1) !== "adminpanel") {  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>MediCare - Mentenanta</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>assets/vendor/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>assets/css/bootstrap.css" id="bscss">
        <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>assets/css/app.css" id="maincss">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" id="treeview">
    </head>
    <body>
        <div class="wrapper">
            <div class="abs-center">
                <div class="text-center mv-lg">
                    <h1 class="mb-lg"><sup><em class="fa fa-cog fa-2x text-muted fa-spin text-info"></em></sup>
                        <em class="fa fa-cog fa-5x text-muted fa-spin text-purple"></em>
                        <em class="fa fa-cog fa-lg text-muted fa-spin text-success"></em>
                    </h1>
                    <div class="text-bold text-lg mb-lg">WEBSITE-UL SE AFLĂ ÎN MENTENANȚĂ</div>
                    <p class="lead m0">Revenim online imediat!</p>
                </div>
            </div>
        </div>

        <script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/modernizr/modernizr.custom.js"></script>
        <script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jquery/dist/jquery.js"></script>
        <script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/bootstrap/dist/js/bootstrap.js"></script>
        <script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/jQuery-Storage-API/jquery.storageapi.js"></script>
        <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>assets/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
        <script type="text/javascript" src="<?php echo $this->config->config['base_url']; ?>assets/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo $this->config->config['base_url']; ?>assets/vendor/parsleyjs/dist/parsley.min.js"></script>
        <script src="<?php echo $this->config->config['base_url']; ?>assets/js/app.js"></script>
        
        
    </body>
</html>
<?php die();} ?>
<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
    <head>
        <meta name content="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Medicare.ro este website-ul clinicii cu sediul in Brasov.">
        <meta name="keywords" content="medicare, clinica privata, clinica, medic, doctor, clinica brasov">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#167ed5">
        <meta name="application-name" content="MediCare" />
        <meta name="msapplication-TileColor" content="#167ed5" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?php echo $this->config->item('site_name'); ?>" />
        <meta property="og:description" content="MediCare este clinica ta medicala online!" />
        <meta property="og:url" content="<?php echo base_url(); ?>" />
        <meta property="og:site_name" content="<?php echo $this->config->item('site_name'); ?>" />

        <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>favicon.png"/>

        <meta property="og:locale" content="ro_RO" />      
        <meta property="og:updated_time" content="<?php echo time(); ?>" />

        <title><?php echo $this->config->config['site_name']; ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.css">        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>assets/vendor/animate.css/animate.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>assets/vendor/whirl/dist/whirl.css">
        <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>assets/css/bootstrap.css" id="bscss">
        <link rel="stylesheet" href="<?php echo $this->config->config['base_url']; ?>assets/css/app.css" id="maincss">
        
             
    </head>
    <body>
        <!--[if lt IE 11]>
		<div class="chromeframe" style=""background: white;z-index: 999;color: #000;height: 100%;width: 100%;position: absolute;position:fixed">
			<p class="wrap" style="display: block;margin: auto;margin-top: auto;text-align: center;font-size: 24px;margin-top: 200px;">
			Browserul utilizat este <em>foarte vechi!</em> <a href="http://browsehappy.com/">Actualizati cu un alt browser</a> sau <a href="http://www.google.com/chromeframe/?redirect=true">instalati Google Chrome Frame</a> pentru a vedea site-ul corect si complet.
			</p>
		</div>
		<![endif]-->
        
        <div class="wrapper">
            <header class="topnavbar-wrapper">
                <nav class="navbar topnavbar" role="navigation">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo base_url(); ?>">
                            <div class="brand-logo">
                                <img class="img-responsive" width="234" src="<?php echo $this->config->config['base_url']; ?>assets/img/logo.png" alt="Eclipsed Logo">
                            </div>
                            <div class="brand-logo-collapsed">
                                <img class="img-responsive" src="<?php echo $this->config->config['base_url']; ?>assets/img/logo_small.png" alt="Eclipsed Logo">
                            </div>
                        </a>
                    </div>

                    <div class="nav-wrapper">
                        <ul class="nav navbar-nav">
                            <li>
                                <a class="hidden-xs nav-link collapsed" href="#" data-trigger-resize="" data-toggle-state="aside-collapsed">
                                    <i class="fas fa-location-arrow"></i>
                                </a>
                                <a class="visible-xs sidebar-toggle" href="#" data-toggle-state="aside-toggled" data-no-persist="true">
                                   <i class="fas fa-location-arrow"></i>
                                </a>
                            </li>
                            <?php if($this->session->userdata("logged_in") !== null) { ?>
                            <li>
                            	<a class="hidden-xs nav-link" id="user-block-toggle" href="#user-block" data-toggle="collapse" aria-expanded="true">
			                     <i class="far fa-user"></i>
			                  	</a>
			                 </li>
                            <?php } ?>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="<?php echo base_url("cauta"); ?>">
                                    <em class="icon-magnifier"></em>
                                </a>
                            </li>
                            
                            <?php if($this->session->userdata("logged_in") !== null) { ?>
                            <li>
                                <a href="<?php echo base_url("notification"); ?>">
                                    <em class="icon-bell"></em>
                                    <div class="label label-danger"><?php echo notifications("count", $this->session->userdata("logged_in")["id"]); ?></div>
                                </a>
                            </li>
                            <?php } ?>

                            <?php if($this->session->userdata("logged_in") !== null) { ?>
                            <li class="dropdown dropdown-list">
                                <a href="#" data-toggle="dropdown">
                                    <em class="icon-people"></em>
                                    <?php echo getUserData($this->session->userdata("logged_in")["id"], "nume"); ?> <?php echo getUserData($this->session->userdata("logged_in")["id"], "prenume"); ?>
                                </a>
                                <ul class="dropdown-menu animated flipInX">
                                    <li>
                                        <div class="list-group">
                                            <a class="list-group-item" href="<?php echo base_url(); ?>profile/<?php echo $this->session->userdata("logged_in")["id"]; ?>">
                                                <div class="media-box">
                                                    Profil
                                                </div>
                                            </a>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="list-group">
                                            <a class="list-group-item" href="<?php echo base_url(); ?>changeemail">
                                                <div class="media-box">
                                                    Schimba email
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="list-group">
                                        	<a class="list-group-item" href="<?php echo base_url(); ?>logout">
                                                <div class="media-box">
                                                    Deconectare
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <?php } else { ?>
                            <li>
                                <a href="<?php echo base_url(); ?>register">
                                    <i class="fas fa-key"></i> Creaza cont
                                </a>
                            <li>
                                <a href="<?php echo base_url(); ?>login">
                                    <em class="icon-people"></em> Login
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </header>

            <aside class="aside">
                <div class="aside-inner">
                    <nav class="sidebar" data-sidebar-anyclick-close="">
                        <ul class="nav">
                            <?php if($this->session->userdata("logged_in") !== null) { ?>
                            <li class="has-user-block">
                                <div id="user-block">
                                    <div class="item user-block">
                                        <div class="user-block-picture">
                                            <div class="user-block-status">
                                                <img class="img-thumbnail img-circle" style="width:60px; height:60px;" src="<?php echo base_url(); ?>assets/img/profilepictures/<?php echo getUserData($this->session->userdata('logged_in')["id"], "picture_path"); ?>" alt="Your avatar">
                                                <div class="circle circle-success circle-lg"></div>
                                            </div>
                                         </div>
                                        <div class="user-block-info">
                                            <span class="user-block-name"><b><a href="<?php echo base_url(); ?>profile/<?php echo $this->session->userdata('logged_in')["id"]; ?>">Bun venit, <?php echo getUserData($this->session->userdata('logged_in')["id"], "nume"); ?> <?php echo getUserData($this->session->userdata('logged_in')["id"], "prenume"); ?>!</a></b></span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>

                            <li class="<?php if($this->uri->segment(1) == "") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>" title="Dashboard">
                                    <i class="fas fa-home fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Acasă</span>
                                </a>
                            </li>

                            <?php if($this->session->userdata("logged_in") !== null && getUserData($this->session->userdata("logged_in")["id"], "devowner") > 0) { ?>
                                <li class="<?php if($this->uri->segment(1) == "adminpanel") echo 'active'; ?>">
                                    <a href="<?php echo base_url(); ?>adminpanel" title="Administrare">
                                        <i class="fas fa-puzzle-piece fa-fw"></i>
                                        <span data-localize="sidebar.nav.DASHBOARD">Administrare</span>
                                    </a>
                                </li>
                            <?php } ?>
                            
                            <li class="<?php if($this->uri->segment(1) == "cauta") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>cauta" title="Cauta">
                                    <i class="fas fa-search fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Cauta doctor</span>
                                </a>
                            </li>

                            <?php if($this->session->userdata("logged_in") !== null && getUserData($this->session->userdata("logged_in")["id"], "doctor") > 0) { ?>
                                <li class="<?php if($this->uri->segment(1) == "programaridoctor") echo 'active'; ?>">
                                    <a href="<?php echo base_url(); ?>programaridoctor" title="Programarile mele">
                                        <i class="fas fa-puzzle-piece fa-fw"></i>
                                        <span data-localize="sidebar.nav.DASHBOARD">Programarile mele</span>
                                    </a>
                                </li>
                            <?php } ?>

                            <li class="<?php if($this->uri->segment(1) == "medici") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>medici" title="Medici">
                                    <i class="fas fa-user-nurse fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Medici</span>
                                </a>
                            </li>

                            <li class="<?php if($this->uri->segment(1) == "tarife") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>tarife" title="Tarife">
                                    <i class="fas fa-tags fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Tarife</span>
                                </a>
                            </li>

                            <?php if(getUserData($this->session->userdata("logged_in")["id"], "doctor") == 0) { ?>
                            <li class="<?php if($this->uri->segment(1) == "programari") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>programari" title="Programari">
                                    <i class="fas fa-file-medical fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Programări</span>
                                </a>
                            </li>
                            <?php } ?>

                            <li class="<?php if($this->uri->segment(1) == "asigurari") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>asigurari" title="Asigurari">
                                    <i class="fas fa-file-medical-alt fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Asigurări de viață</span>
                                </a>
                            </li>

                            <li class="<?php if($this->uri->segment(1) == "stiri") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>news" title="News">
                                    <i class="fas fa-newspaper fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Știri medicale</span>
                                </a>
                            </li>

                            <li class="<?php if($this->uri->segment(1) == "locations") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>locations" title="Clinici">
                                    <i class="fas fa-vial fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Clinici</span>
                                </a>
                            </li>

                            <li class="<?php if($this->uri->segment(1) == "recenzii") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>reviews" title="Recenzii">
                                    <i class="fas fa-users fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Recenzii pacienti</span>
                                </a>
                            </li>

                            <li class="<?php if($this->uri->segment(1) == "cariere") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>cariere" title="Cariere">
                                    <i class="fas fa-briefcase fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Cariere</span>
                                </a>
                            </li>

                            <li class="<?php if($this->uri->segment(1) == "desprenoi") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>desprenoi" title="Despre noi">
                                    <i class="far fa-address-card fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Despre noi</span>
                                </a>
                            </li>

                            <li class="<?php if($this->uri->segment(1) == "contact") echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>contact" title="Contact">
                                    <i class="fas fa-file-signature fa-fw"></i>
                                    <span data-localize="sidebar.nav.DASHBOARD">Contact</span>
                                </a>
                            </li>

                        	                       
                        </ul>
                    </nav>
                </div>
            </aside>