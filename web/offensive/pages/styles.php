<?php 
set_include_path("../..");
require_once( 'offensive/assets/header.inc' );

header( "Content-type: text/css" );
?>

#comments_link {
	padding-left:24px;
}

#content {
	margin:8px;
}

body {
	padding:0px;
	margin:0px;
	font-family:verdana;
	font-size:11px;

}

#votelinks.off, #votelinks.off a {
	color:#ccc;
	text-decoration:none;
}

.nsfw {

	<?php
		if( array_key_exists("prefs", $_SESSION) &&
		    is_array($_SESSION['prefs']) &&
		    array_key_exists("hide nsfw", $_SESSION["prefs"]) &&
		    $_SESSION['prefs']['hide nsfw'] == 1 ) {
	?>		display:none; <?php
		}
	?>
}

.jqmWindow {
    display: none;
    position: fixed;
    top: 50px;
    left: 0px;
    margin-left: 250px;
    width: 600px;
    background: #ccccff none repeat scroll 0 0;
    color: #000033;
    border: 2px solid black;
}

.jqmOverlay { background-color: #000; }

/* Fixed posistioning emulation for IE6
     Star selector used to hide definition from browsers other than IE6
     For valid CSS, use a conditional include instead */
/*
* html .jqmWindow {
     position: absolute;
     top: expression((document.documentElement.scrollTop || document.body.scrollTop) + Math.round(17 * (document.documentElement.offsetHeight || document.body.clientHeight) / 100) + 'px');
}
*/

.blackbar {
        background: #000000;
        height: 11px;
        border-top: 1px solid #666699;
        border-left: 1px solid #333333;
}

.heading {
        background: #000033;
        padding: 5px;
        font-family: verdana;
        font-size: 10px;
        font-weight: bold;
        color: #ccccff;
}

.qc_close a:link, qc_close a:visited, qc_close a:active, .qc_close a {
	color: #ccccff;
}

#qc_comments {
	text-align: left;
	margin: 25px 45px 25px 45px;
}

#qc_commentrows {
	margin-top: 10px;
	height: 250px;
	overflow: auto;
}

.qc_comment {
	background: #ccccff;
	padding: 10px;
	font-size: 10px;
	line-height:15px;
}

#qc_vote {
}

#qc_vote ul li {
}

.timestamp {
	float: right;
	padding-left: 8px;
	font-size: 9px;
	color: #9999cc;
}
