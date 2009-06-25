<?php
	$opt = file_get_contents ( "nacc.js" );
	$opt = preg_replace( "|/\*\s.*?\*/|s", "", $opt );
	$opt = preg_replace( "|\/\/.*|", "", $opt );
	$opt = preg_replace( "|\t+|", " ", $opt );
	$opt = preg_replace( "| +|", " ", $opt );
	$opt = preg_replace( "|\s*[\r\n]+\s*?|", "\n", $opt );
	$opt = preg_replace( "|[\n]+|", " ", $opt );
	$opt = preg_replace( "|[\n]+|", "\n", $opt );
	header ( "Content-type: text/javascript" );	
	echo $opt;
?>