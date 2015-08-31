<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$configurations = array();

$configurations['js_folder_path'] = './assets/images/';
/**
 * Custom url helper file stores the custom functions (which returns url ) of some basic assests  like js, css, images
 */


/**
 * This function returns the path of images
 * 
 */
function image_base_url()
{
    /**
     * Change the base url to your Suitable Domain from where Images can be lOaded.
     *	Default is Current Domain
     **/
    return base_url().'assets/images/';
}


/**
 * This function returns the base url of js
 * 
 */
function js_base_url()
{
    /**
     * Change the base url to your Suitable Domain from where Js can be lOaded.
     *	Default is Current Domain
     **	Can be changed to CDN
    **/
	return base_url().'assets/js/';
}


/**
 * This function returns the base url of css
 *
 */
function css_base_url()
{
    /**
     * Change the base url to your Suitable Domain from where Css can be lOaded.
     *	Default is Current Domain
     *	Can be changed to CDN
    **/
	return base_url().'assets/css/';
}


/**
 * THis fucntion returns the base path for the images which is used while uploading the image.
 * PS: This is the server's directory path not the Domain url.
 * 
 * @return string
 */
function image_base_path()
{
	global $configurations;
	return $configurations['image_folder_path'];
}


