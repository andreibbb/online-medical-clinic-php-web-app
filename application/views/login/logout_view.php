<?php
$this -> session -> sess_destroy();
$this -> session -> set_userdata("language", 1);
header("Location: ".($this -> config -> config['base_url']));
?>