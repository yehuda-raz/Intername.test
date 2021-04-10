<?php
function intername_setCookie($name, $value, $days = 30) {
	if ($days <= 0) {        // basically unsetting the cookie so it will be deleted
		unset( $_COOKIE['intername_'.$name] );
		setcookie( 'intername_'.$name, "", time()-3600,"/");
	}
	else {
		setcookie( 'intername_'.$name, base64_encode(serialize($value)), time() + $days * 86400 , "/" );
	}
}
function intername_getCookie($name) {
	return (isset($_COOKIE['intername_'.$name])) ? unserialize(base64_decode($_COOKIE['intername_'.$name])) : null;
}



 
