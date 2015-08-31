<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This file loads the css/js file in views
 * Importance: 
 * js and css Once loaded,  if you try to load them again, then they wont get load as you have already loaded it..:P
 * 
 * This file supports cdn as well. If it encounters any file which is getting loaded from CDN servers or any other server, then it will load the path as is, 
 * else this file load the file from own server with config paths.
 * Enter description here ...
 * @author neeraj
 * neerjgupta2407@gmail.com
 *
 */

class Asset
{
	
	/**
	 * $js array Stores all the js files which has been loaded by assest loader class.. 
	 * Also, default value signifies that if we receive file name as '' or null, then they should not get loaded
	 * Enter description here ...
	 * @var unknown_type
	 */
	public $js = array('',null);

	
	/**
	* $css array Stores all the css files which has been loaded by assest loader class..
	* Also, default value signifies that if we receive file name as '' or null, then they should not get loaded
	* Enter description here ...
	* @var unknown_type
	*/
	
	
	public $css = array('',null);  //stores all the css files which has been loaded by assest loader class
	
	
	
	/**
	 * $domains array stores the domains type which wil be trated as CDN servers/path
	 * Enter description here ...
	 * @var unknown_type
	 */
	public $domains =  array('.in','.co','.com','.net','http','https','//');   //valid domains which will be trated as CDN path
	
	
	/**
	 * This function is used to load the js files from the asset folder
	 * Enter description here ...
	 */
	function load_js($files)
	{
		if(is_array($files))
		{
			foreach($files as $file)
			{
				$this->load_js($file);
				continue;
			}
			return;
		}
		
		/**
		* Checking if the js is already loaded, then we will not load it again,
		* ALso if the file  is null string or empty ,  
		*/
		
		
		if(!in_array($files,$this->js) )
		{
			//loading the css file in view
			echo $this->_get_js_script_string($this->_get_js_base_url($files));
			$this->js[] = $files;  //adding the css file in stack so that the same js cannot be loaded again
		}
		
		
	}
	
	
	/**
	* This function is used to load the css files from the asset folder
	* Enter description here ...
	*/
	function load_css($files)
	{
		if(is_array($files))
		{
			foreach($files as $file)
			{
				$this->load_css($file);
				continue;
			}
			return;
		}
	
		
	/**
	 * Checking if the css is already loaded, then we will not load it again
	 */
		if(!in_array($files,$this->css) && $files != '')
		{
			//loading the css file in view
			echo $this->_get_css_script_string($this->_get_css_base_url($files));
			$this->css[] = $files;   //adding the css file in stack so that the same css cannot be loaded again
		}
	
	
	}
	
	
	
	
	
	
	/**
	 * This function returns the js file src path to be loaded
	 */
	function _get_js_base_url($js_file)
	{
		//need to put the check of the Domain
		//If js file containg any domain name, I.e if we want to load file from cdn, then we should not chenge the file name and return it as is.
		if($this->_is_cdn_path($js_file))
		{
			//yes..it is cdn path...So we will return the path asis.
			return $js_file;
		}
		else
		{
			//since it is not the cdn path...hence we will return the new file name
			$name = $this->prep_filename($js_file,'js'); //filtering the name of the file
			$md5 = md5_file(js_base_url().$name.'.js');  //genrating the md5 of the file so that no need to change the version and automatically new file will be uploaded..
			return js_base_url().$name.'.js?v='.$md5;
		}
		
	}
	
	
	
	/**
	* This function returns the js file src path to be loaded
	*/
	
	function _get_css_base_url($css_file)
	{
		
		//need to put the check of the Domain
		//If css file containg any domain name, I.e if we want to load file from cdn, then we should not chenge the file name and return it as is.
		
		if($this->_is_cdn_path($css_file))
		{
			//yes..it is cdn path...So we will return the path asis.
			return $css_file;
		}
		else
		{
			//since it is not the cdn path...hence we will return the new file name
			
			$md5 = md5_file(css_base_url().$css_file.'.css');  //genrating the md5 of the file so that no need to change the version and automatically new file will be uploaded..
			
			return css_base_url().$css_file.'.css?v='.$md5;
		}
		
	}
	
	
	
	
	
	
	/**
	* This function returns the Js script string, which will get loaded on views
	* eg: <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.1.min.js"></script>
	* Enter description here ...
	* @param unknown_type $src
	* @return string
	*/
	
	
	function _get_js_script_string($src)
	{

		$str = '<script type="text/javascript"  src="'.$src.'"></script>';

		return $str;
	}
	
	
	/**
	 * This function returns the css script string, which will get loaded on views
	 * eg: <link rel="stylesheet" type="text/css" media="screen" href="http://www.xyz.com/css/style.css?v=1381236134">
	 * Enter description here ...
	 * @param unknown_type $src
	 * @return string
	 */
	function _get_css_script_string($src)
	{
		$str = '<link rel="stylesheet" type="text/css" media="screen" href="'.$src.'">';
		return $str;
	}
	
	
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $filename
	 * @param unknown_type $extension
	 * @return multitype:NULL |unknown
	 */
	function prep_filename($filename, $type , $extension = '')
	{
		if ( ! is_array($filename))
		{
			return (str_replace('.'.$type, '', str_replace($extension, '', $filename)).$extension);
		}
		
	}
	
	
	/**
	 * This function checks if the file name is actually a CDN path,
	 * If yes, then we will return true else false.
	 * Enter description here ...
	 * @param unknown_type $file
	 */
	
	function _is_cdn_path($file)
	{
		foreach($this->domains as $dom)
		{
			if( strpos($file,$dom) === false)
			{
				continue;
			}
			else
			{
				//cdn found..hence returning
				return true;
			}

		}
		
		//no match found...Hence returning false
		return false;
	}
	
}
