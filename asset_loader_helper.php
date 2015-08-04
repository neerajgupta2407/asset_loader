<?php

/**
 * This file contains function which is used to load various asests.
 * Enter description here ...
 */



//this function is used to load the css file
function load_css($css)
{
		
	$CI = &get_instance();
	$CI->asset->load_css($css);
	
}


//this function is used to load the js file
function load_js($js)
{

	$CI = &get_instance();
	$CI->asset->load_js($js);

}



