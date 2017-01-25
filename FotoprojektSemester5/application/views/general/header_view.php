<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="description" content="">
<meta name="author" content="">

<title>SnapUp
<?php
if (lh_isUserLoggedin ()) {
	$userrolle = $this->session->user_role;
	// TODO: Benutzerrollenspezifische Titel
	switch ($userrolle) {
		default :
		case 0 :
			break;
		case 1 :
			echo "- Admin";
			break;
		case 2 :
			echo "- Benutzer";
			break;
		case 3 :
			echo "- Fotograf";
			break;
		case 4 :
			echo "- Anonymer Besteller";
			break;
	}
}
?>
</title>

<!-- Required meta tags always come first -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?php
echo base_url ();
?>css/bootstrap.min.css">

<link rel="stylesheet" href="<?php

echo base_url ();
?>css/fps5.css">
<link rel="stylesheet" href="<?php

echo base_url ();
?>_sonstiges/bootstrap-4.0.0-alpha.5/dist/font-awesome-4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="<?php

echo base_url ();
?>css/cookieconsent.min.css" />

<link rel="stylesheet" type="text/css" href="<?php

echo base_url ();
?>css/toggle.css" />

<script src="<?php

echo base_url ();
?>js/jquery-3.1.1.min.js"></script>
<script src="<?php

echo base_url ();
?>js/lazyload-any.js"></script>

<script src="<?php

echo base_url ();
?>js/cookie.js"></script>
<script>
// Link zur Anleitung für Cookie: https://cookieconsent.insites.com/download/#
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
    	"background": "#14a7d0"
    }
  },
  "content": {
    "message": "Diese Webseite verwendet Cookies, um die Benutzerfreundlichkeit zu erhöhen.",
    "dismiss": "Habs verstanden",
    "link": "Weitere Informationen"
        //"href": "http://"
  }
})});
</script>

</head>
<body>