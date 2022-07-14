<?php

function doctor_type($value) {
  $name = array(
           1 => "Acupunctura",
           2 => "Alergologie pediatrica",
           3 => "Alergologie si imunologie clinica",
           4 => "Anestezie si terapie intensiva",
           5 => "Apifitoterapie",
           6 => "Boli infectioase",
           7 => "Cardiologie",
           8 => "Cardiologie pediatrica",
           9 => "Chirurgie cardiovasculara",
           10 => "Chirurgie generala",
           11 => "Chirurgie pediatrică",
           12 => "Chirurgie plastică",
           13 => "Chirurgie vasculara",
           14 => "Consiliere nutritie pediatrica",
           15 => "Dermatologie",
           16 => "Diabetologie",
           17 => "Ecografie",
           18 => "Endocrinologie",
           19 => "Epidemiologie",
           20 => "Gastroenterologie",
           21 => "Genetica medicala",
           22 => "Geriatrie - gerontologie",
           23 => "Ginecologie",
           24 => "Hematologie",
           25 => "Homeopatie",
           26 => "Medicină de familie",
           27 => "Medicină de urgență",
           28 => "Medicină fizică și de reabilitare",
           29 => "Medicină generală",
           30 => "Medicină internă",
           31 => "Medicină maritimă",
           32 => "Medicina muncii",
           33 => "Nefrologie",
           34 => "Neonatologie",
           35 => "Neurochirurgie",
           36 => "Neurologie",
           37 => "Neurologie pediatrica",
           38 => "Oftalmologie",
           39 => "Oncologie medicala",
           40 => "ORL",
           41 => "ORL pediatric",
           42 => "Ortopedie",
           43 => "Ortopedie pediatrica",
           44 => "Pediatrie",
           45 => "Pneumologie",
           46 => "Proctologie",
           47 => "Psihiatrie",
           48 => "Psihiatrie pediatrica",
           49 => "Psihologie",
           50 => "Psihoterapie",
           51 => "Reumatologie",
           52 => "Stomatologie",
           53 => "Urologie"
        );
          return $name[$value];
}

function get_mark($value, $numberof) {
  return number_format((float)($value/$numberof), 2, '.', '');
}

function interval_orar($value) {
    switch($value) {
        case "pana12": {
            return "pana in ora 12:00";
        }
        case "intre1417": {
            return "intre orele 14:00 si 17:00";
        }
        case "dupa17": {
            return "dupa ora 17:00";
        }
        default: {
            return "Error.";
        }
    }
}

function expand_languages($value) {
      $explodedLang = explode("|", $value);
      $langString = "";

      if($explodedLang[0] != "0") $langString = "engleza,";
      if($explodedLang[1] != "0") $langString = $langString." maghiara,";
      if($explodedLang[2] != "0") $langString = $langString." germana,";
      if($explodedLang[3] != "0") $langString = $langString." franceza.";

      if($langString == "") return "no_lang";

      return $langString;
}


function multiexplode($delimiters,$string) {
  $ready = str_replace($delimiters, $delimiters[0], $string);
  $launch = explode($delimiters[0], $ready);
  return  $launch;
}

function percentage_of($number1, $number2) {
    return ($number1 * 100) / $number2;
}

function format_timer_result($time_in_seconds){
    $time_in_seconds = ceil($time_in_seconds);

    // Check for 0
    if ($time_in_seconds == 0){
        return '0 seconds';
    }

   /* // Days
    $days = floor($time_in_seconds / (60 * 60 * 24));
    $time_in_seconds -= $days * (60 * 60 * 24); */

    // Hours
    $hours = floor($time_in_seconds / (60 * 60));
    $time_in_seconds -= $hours * (60 * 60);

    // Minutes
    $minutes = floor($time_in_seconds / 60);
    $time_in_seconds -= $minutes * 60;

    // Seconds
    $seconds = floor($time_in_seconds);

    // Format for return
    $return = '';
   /* if ($days > 0){
        $return .= $days . ' day' . ($days == 1 ? '' : 's'). ' ';
    }*/
    if ($hours > 0){
        $return .= $hours . ' hour' . ($hours == 1 ? '' : 's') . ' ';
    }
    if ($minutes > 0){
        $return .= $minutes . ' minute' . ($minutes == 1 ? '' : 's') . ' ';
    }
    if ($seconds > 0){
        $return .= $seconds . ' second' . ($seconds == 1 ? '' : 's') . ' ';
    }
    $return = trim($return);

    return $return;
}

function get_time_difference($date) 
 {
    if(empty($date)) {
        return "No date provided";
    }
    $periods         = array("seconds", "minutes", "hours", "days", "weeks", "months", "years", "decades");
    $lengths         = array("60","60","24","7","4.35","12","10");
    $now             = strtotime("-0 minutes");
    $unix_date       = strtotime($date);

    if(empty($unix_date)) {   
        return "Bad date";
    }

    if($now > $unix_date) {   
        $difference     = $now - $unix_date;
        $tense = "ago";

    } else {
        $difference     = $unix_date - $now;
        $tense = "in";
    }

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    return (($now > $unix_date) ? ("$difference $periods[$j] {$tense}") : ("{$tense} $difference $periods[$j]"));
}

function get_time_difference_timestamp($date) 
 {
    if(empty($date)) {
        return "No date provided";
    }
    $periods         = array("seconds", "minutes", "hours", "days", "weeks", "months", "years", "decades");
    $lengths         = array("60","60","24","7","4.35","12","10");
    $now             = strtotime("-0 minutes");
    $unix_date       = ($date);

    if(empty($unix_date)) {   
        return "Bad date";
    }

    if($now > $unix_date) {   
        $difference     = $now - $unix_date;

    } else {
        $difference     = $unix_date - $now;
    }

    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    return "$difference $periods[$j]";
}

function get_info_name($name, $selector = '*') { 
    $ci =& get_instance();
    $ci->db->select($selector); 
    $ci->db->from('users'); 
    $ci->db->where('name', $name);
    $query = $ci->db->get(); 
    $data=array();
    if($query->num_rows() > 0) return $data->result(); 
}

function get_info($selector, $table, $firstkey, $key, $aditional = "") {
    $ci =& get_instance();
    $query = $ci->db->query("SELECT `".$selector."` FROM `".$table."` WHERE `".$firstkey."` = '".$key."' '".$aditional."'");
    return (isset($query->result()[0]->$selector) ? $query->result()[0]->$selector : "unknown");
}

function getUserData($name, $data = "name") {
    $ci =& get_instance();
    if(is_numeric($name))
        $query = $ci->db->query("SELECT `".$data."` FROM `users` WHERE `id` = ? LIMIT 1", array($name));
    else
        $query = $ci->db->query("SELECT `".$data."` FROM `users` WHERE `email` = ? LIMIT 1", array($name));
    return (isset($query->result()[0]->$data) ? $query->result()[0]->$data : "unknown");
}

function getUserFullName($id) {
    $ci =& get_instance();
    if(is_numeric($id))
        $query = $ci->db->query("SELECT `nume`, `prenume` FROM `users` WHERE `id` = ? LIMIT 1", array($id));
    return (isset($query->result()[0]->nume) ? "".$query->result()[0]->nume." ".$query->result()[0]->prenume."" : "db_error!");
}

function countTable($table, $extra = "") {
    $ci =& get_instance();
    $query = $ci->db->query("SELECT * FROM `" . $table . "` " . $extra);
    return $query->num_rows();
}


function countMember($table) {
    $ci =& get_instance();
    $query = $ci->db->query("SELECT name FROM `users` WHERE `Member` = ".$table."");
    return $query->num_rows();
}

function getUserLink($name=""){
    $ci =& get_instance();
    if($name != "N/A" || $name != "") {
        $online = "online";
        $offline = "offline";
        $nameplayer = getUserData($name, "name");
        return '<a data-toggle="tooltip" title="'.$nameplayer.', level '.getUserData($name, "Level").', '.(getUserData($name, "Status") ? $online : $offline).'" href="' . base_url() . 'profile/' . getUserData($name, "name") . '">' . $nameplayer . '</a>';
    }
    else return "N/A";
}

function getBestUserLink($name=""){
    $ci =& get_instance();
    if($name != "N/A" || $name != "") {
        $nameplayer = getUserData($name, "name");
        return '<a href="' . base_url() . 'profile/' . $nameplayer . '">' . $nameplayer . '</a>';
    }
    else return "N/A";
}

function getBestenUserLink($nameplayer=""){
    $ci =& get_instance();
    if($nameplayer != "N/A" || $nameplayer != "") {
        return '<a href="' . base_url() . 'profile/' . $nameplayer . '">' . $nameplayer . '</a>';
    }
    else return "N/A";
}

function base64Encoded($data)
{
    if (preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $data)) {
       return TRUE;
    } else {
       return FALSE;
    }
};

function playerStatus($player) {
    if(getUserData($player, "Status") > 0) {
        return "success";
    } else return "danger";
    
}

function getContactReason($reason) {
    switch($reason) {
        case 1: {
            return "Suport clienti";
        }
        case 2: {
            return "Tehnic";
        }
        case 3: {
            return "Financiar";
        }
        case 4: {
            return "Sesizari";
        }
        case 5: {
            return "Feedback website";
        }
        default: {
            return "?";
        }
    }
}

function getTicketStatus($status) {
    return $status ? "INCHIS" : "DESCHIS";
}


function getTicketType($type) {
    switch($type) {
        case 1: {
            return "suportclienti";
            break;
        }
        case 2: {
            return "tehnic";
            break;
        }
        case 3: {
            return "financiar";
            break;
        }
        case 4: {
            return "sesizari";
            break;
        }
        case 5: {
            return "feedback";
        }
        default: {
            return "unknown";
            break;
        }
    }
}

function getTicketColor($type) {
    switch($type) {
        case 1: {
            return "info";
            break;
        }
        case 2: {
            return "success";
            break;
        }
        case 3: {
            return "danger";
            break;
        }
        case 3: {
            return "warning";
            break;
        }
        case 4: {
            return "inverse";
            break;
        }
        case 5: {
            return "green";
            break;
        }
        default: {
            return "primary";
            break;
        }
    }
}


function panel_log($log, $user) {
    $CI =& get_instance();
    $CI->db->query("INSERT INTO panel_logs (`log`, `time`, `user`) VALUES (?, ?, ?)", array($log, date("Y-m-d H:i:s", time()), $user));
}


function notifications($method, $user) {
    if($method == "count") {
        $CI =& get_instance();
        $CI->db->cache_on();

        $query = $CI->db->query("SELECT COUNT(ID) AS TOTAL FROM `notifications` WHERE `readed_notification` = 0 AND `userid` = ?", array($user));
        
        if($query->num_rows()) return $query->result()[0]->TOTAL;
        else return array();
    }
}

function insertNotification($userid, $message, $link = "") {
    $CI =& get_instance();

    $CI->db->query("INSERT INTO `notifications` (`userid`, `message`, `link`) VALUES (?, ?, ?)", array($userid, $message, $link));
}


function strip_non_utf($str){
  return preg_replace('/[^\pL\pM[:ascii:]]+/', '', $str);
}

function readable_encrypted_ip($ip)
{
    $s = explode('.', $ip);
    $encrypt = hash('md5', $s[2] . time() . $s[1]);
    $result = $s[0] . "." . $encrypt . "." . $s[3];
    return $result;
}

function encrypt_email($email)
{
    return $email[0] . $email[1] . $email[2] . $email[3] . $email[4] . $email[5] . "*******" . "**";
}