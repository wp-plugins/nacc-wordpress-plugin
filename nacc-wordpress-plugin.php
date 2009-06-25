<?php
/*
Plugin Name: NACC
Plugin URI: http://magshare.org/nacc
Description: This is a WordPress plugin implementation of the N.A. Cleantime Calculator. To use this, specify &lt;!&#45;&#45; NACC &#45;&#45;&gt; in your text code. That text will be replaced with this cleantime calculator.
Version: 2.0.9
Install: Drop this directory in the "wp-content/plugins/" directory and activate it. You need to specify "<!-- NACC -->" in the code section of a page or a post.
*/ 

function nacc_head ( )
	{
	global $wp_query;
	$page_obj_id = $wp_query->get_queried_object_id();
	if ( $page_obj_id )
		{
		$page_obj = get_page ( $page_obj_id );
		if ( preg_match ( "/<!-- ?NACC ?-->/", $page_obj->post_content ) )
			{
			echo "<!-- Added by the NACC plugin. -->\n";
			echo '<link rel="stylesheet" href="'.get_option('siteurl').'/wp-content/plugins/nacc-wordpress-plugin/nacc.css" type="text/css" />'."\n";
			echo '<script type="text/javascript" src="'.get_option('siteurl').'/wp-content/plugins/nacc-wordpress-plugin/nacc.js"></script>';
			// Change this to whichever one you want to add.
			echo '<link rel="stylesheet" href="'.get_option('siteurl').'/wp-content/plugins/nacc-wordpress-plugin/nacc_theme_jft.css" type="text/css" />'."\n";
			}
		}
	}

function nacc_content ( $the_content )
	{
	if ( preg_match ( "/<!-- ?NACC ?-->/", $the_content) )
		{
		$cc_text = '<div id = "nacc_container"></div>'."\n";
		$cc_text .= '<noscript>';
		$cc_text .= '<h1 style="text-align:center">JavaScript Required</h1>';
		$cc_text .= '<h2 style="text-align:center">Sadly, you must enable JavaScript on your browser in order to use this cleantime calculator.</h2>';
		$cc_text .= '</noscript>';
		$cc_text .= '<script type="text/javascript">NACC_CleanTime("nacc_container", "'.get_option('siteurl').'/wp-content/plugins/nacc-wordpress-plugin/", true, true, false);</script>'."\n";
		$the_content = preg_replace ( "/(<p.*?>)?<!-- ?NACC ?-->(<\/p>)?/", $cc_text, $the_content);
		}
	return $the_content;
	}

add_filter ( 'the_content', nacc_content );
add_action ( 'wp_head', 'nacc_head' );
?>