#This is a AssetLoader Library for loading the Css, JS amd Images on your WEB page.


##Advantages:
1)Simple Syntax for loading the css and Js. 
	load_css($css);   //Css aan be single file name or array of files. No need to append .css and .js IN Files.

	load_css('abc')  will load {Path to Css Folder as defined}.'abc'.css
	load_js('abc')  will load {Path to Css Folder as defined}.'abc'.js
2)If you load same file more than once, then it won't get loaded again making your code Conflick free.
	load_js('abc');   //will load the abc.js file
	load_js('abc');   //won't load the js as its already loaded above.
	
3)Provides Cache Bursting i.e If you changed single line in css/js file, then you don't have to press ctrl+f5 to burst the cache , this will be take care by Loader.
	The jss/Css url is made by taking the MD5 of the file and appending it to the Url and hence making it cacheBurstabvle by default.

4)If you want to move your assets to CDN in future, then this can be handled by this by changing the One line for each Asset( Basically you have to change the base url for each js,css and . Image) 















Setup For CodeIgnitor:
1)Add the helper file custom_url_helper.php and asset_loader_helper.php in autoload.
2)Add configurations
3)Default folder structure is : 
{web_root}/assets/css/*.css for css
{web_root}/assets/js/*.js for JS
{web_root}/assets/images/* for images

PS: You can add your folder structure inside the css/js/images folders 
	and load it like load_js('{folder_name}/abc') for file residing inside {web_root}/assets/js/{folder_name}/abc.js

