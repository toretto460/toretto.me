<?php
/*
Plugin Name: Dropbox CDN
Plugin URI: http://www.chriskdesigns.com/plugins/dropbox-cdn
Description: Use your Dropbox 'Public' folder as a free Content Delivery Network (or CDN). Please note that, as of now, this plugin only supports themes who use the filters 'template_directory', 'template_directory_uri', 'stylesheet_directory', 'stylesheet_directory_uri', and 'stylesheet_url' to determine the paths to the theme's template and stylesheet files. I would only suggest this plugin for users who aren't afraid of getting their hands a little dirty.
Version: 1.1
Author: Chris Klosowski
Author URI: http://www.chriskdesigns.com/
License: GPL
*/

// Let's add a little action into the plug-in
if ( is_admin() ) { 
	//Adds admin verification
	add_action('admin_menu', 'dropbox_cdn_menu');
	add_action('admin_init', 'register_dropbox_cdn_settings');
	register_deactivation_hook('dropbox-cdn/dropbox-cdn.php', 'de_register_dropboxcdn_settings');
} else {
	// non-admin enqueues, actions, and filters
	if (get_option('dbcdn_enabled')) {
		add_filter( 'template_directory', 'dbcdn_pu_templatedir' , 10 );
		add_filter( 'template_directory_uri', 'dbcdn_pu_templatedir', 10 );
		add_filter( 'stylesheet_directory', 'dbcdn_pu_stylesheetdir', 10 );
		add_filter( 'stylesheet_directory_uri', 'dbcdn_pu_stylesheetdir', 10 );
		add_filter( 'stylesheet_url', 'dbcdn_pu_stylesheeturl', 10 );
	}
}

function dbcdn_pu_templatedir ($content)
{
	$congtent = get_option('dbcdn_url');
	return $content;
}

function dbcdn_pu_stylesheetdir($content) {
	$content = get_option('dbcdn_url');
	return $content;
}

function dbcdn_pu_stylesheeturl($content) {
	$content = trailingslashit(get_option('dbcdn_url')) . 'style.css';
	return $content;
}

// The Admin Area
function dropbox_cdn_menu() {
  add_options_page('Dropbox CDN', 'Dropbox CDN', 8, 'dropbox-cdn', 'dropbox_cdn_menu_options');
}

function dropbox_cdn_menu_options() {

    $yes_selected = '';
    $no_selected = 'selected';
    $wp_nonce_fields = wp_nonce_field('dbcdn-pu-options');
    $blog_url = get_bloginfo('url');
    $dbcdn_url = get_option('dbcdn_url') ? get_option('dbcdn_url') : '';

    if (!get_option('dbcdn_enabled') || get_option('dbcdn_enabled') == '1'){
        $yes_selected = 'selected';
        $no_selected = '';
    }
    $submit = 'Save Changes';

    $setting_fields = settings_fields( 'dbcdn-pu-options' );

echo <<<EOT

<div class="wrap">
<h2>Dropbox CDN</h2>
<em>Follow these steps to enable the Dropbox CDN features</em>

<form method="post" action="options.php">
$wp_nonce_fields

<table class="form-table">
<br />
<ul>
<li>Step 1: <a href="http://db.tt/uIVtsPL" target="_blank">Sign up</a> for a Dropbox Account (it's free for 2GB of storage).</li>
<li>Step 2: Install the Dropbox software to your computer. This will create a folder in your My Documents (Windows) or Home Folder (Mac/Linux) called 'Dropbox'. Within this there will be a few default folders and one named 'Public'.</li>
<li>Step 3: Create a folder within the 'Public' folder with a unique name, like your domain name (without the .com). As an example, if your domain was mywebsite.com, the folder name would be mywebsite.</li>
<li>Step 4: Upload all of the .js, .jpg, .gif, .png, and .css files from your theme (only files in wp-content/themes/yourtheme/), into this new folder. Be sure to preserve any folder structure.</li>
<li>Step 5: Login to your Dropbox account at dropbox.com, navigate to Public->mywebsite (or the name of your folder) and click on the arrow next to one of the files you uploaded to get the public link.</li>
<div style="text-align: center"><img src="$blog_url/wp-content/plugins/dropbox-cdn/images/dropdown.png" /></div>
<li>Step 6: Copy only the highlighted section of the Public URL (see the image below) into the option 'URL to public folder', including the string of numbers (this is your user folder). I've hidden mine in the image.</li>
<div style="text-align: center"><img src="$blog_url/wp-content/plugins/dropbox-cdn/images/copyurl.png" /></div>
<tr valign="top">
<th scope="row">URL to public folder<br /><span style="font-size: x-small;">The URL to your Dropbox Public folder</span></th>
<td>
<input type="text" name="dbcdn_url" value="$dbcdn_url" size="50" />
</td>
</tr>

<tr valign="top">
<th scope="row">Enable:<br /><span style="font-size: x-small;">Only do this once all files are in place.</span></th>
<td>
<select name="dbcdn_enabled">
	<option $yes_selected value="1">Yes</option>
	<option $no_selected  value="0">No</option>
</select>
</td>
</tr>
</ul>
</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="dbcdn_enabled, dbcdn_url," />

<p class="submit">
<input type="submit" class="button-primary" value="$submit" />
</p>
$setting_fields
</form>
</div>
EOT;

}

// Register those settings!
function register_dropbox_cdn_settings() { // whitelist options
	register_setting( 'dbcdn-pu-options', 'dbcdn_enabled' );
	register_setting( 'dbcdn-pu-options', 'dbcdn_url' );
}

// Unregister on deactivation
function de_register_dropboxcdn_settings () {
	delete_option( 'dbcdn_enabled' );
	delete_option( 'dbcdn_url' );
}
?>