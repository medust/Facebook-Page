<?php
/*
Plugin Name: Facebook Page
Plugin URI: http://Medust.com/
Description: THE Simplest way to bring Facebook LikeBox + Facebook Recommendation Bar functionality to WordPress with lot more Options.
Version: 1.0
Author: Medust
Author URI: http://Medust.com
*/

/*
    Copyright (C) 2010- 2015 Medust.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Some default options
add_option('as_facebook_pg_page_name', 'wordpress');
add_option('as_facebook_pg_width', '282');
add_option('as_facebook_pg_broder_color', '');
add_option('as_facebook_pg_color_scheme', 'FFFFF');
add_option('as_facebook_pg_height', '255');
add_option('as_facebook_pg_stream', 'false');
add_option('as_facebook_pg_header', 'false');
add_option('as_facebook_pg_faces', 'true');

add_option('as_facebook_pg_widget_page_name', 'wordpress');
add_option('as_facebook_pg_widget_title', 'Like Box');
add_option('as_facebook_pg_widget_width', '282');
add_option('as_facebook_pg_widget_border_color', '');
add_option('as_facebook_pg_widget_color_scheme', 'FFFFFF');
add_option('as_facebook_pg_widget_height', '255');
add_option('as_facebook_pg_widget_stream', 'false');
add_option('as_facebook_pg_widget_header', 'false');
add_option('as_facebook_pg_widget_faces', 'true');
add_option('as_facebook_pg_widget_no_connection', '10');
add_option('as_fbpage_show_sponser_link', '-1');

add_option('as_facebook_pg_reco_appid', '');
add_option('as_facebook_pg_reco_readtime', '5');
add_option('as_facebook_pg_reco_verb', 'like');
add_option('as_facebook_pg_reco_side', 'left');
add_option('as_facebook_pg_reco_domain', 'http://Medust.com');

function filter_as_facebook_pg_likebox($content)
{
    if (strpos($content, "<!--facebook-page-->") !== FALSE) {
        $content = preg_replace('/<p>\s*<!--(.*)-->\s*<\/p>/i', "<!--$1-->", $content);
        $content = str_replace('<!--facebook-page-->', as_facebook_pg_likebox(), $content);
    }

    $fm_appid = get_option('as_facebook_pg_reco_appid');
    $fm_readtime = get_option('as_facebook_pg_reco_readtime');
    $fm_verb = get_option('as_facebook_pg_reco_verb');
    $fm_side = get_option('as_facebook_pg_reco_side');
    $fm_domain = get_option('as_facebook_pg_reco_domain');

    if (!($fm_appid == "")) {
        $content .= "<!-- Facebook Page Plugin by Medust: http://medust.com -->
		<div class=\"fb-recommendations-bar\" data-href=\"" . get_permalink() . "\" data-read-time=\"" . $fm_readtime . "\" data-side=\"" . $options['side'] . "\" data-action=\"" . $fm_verb . "\"></div>";
    }
    return $content;
}

function facebook_page_head()
{

    $fm_appid = get_option('as_facebook_pg_reco_appid');
    $fm_readtime = get_option('as_facebook_pg_reco_readtime');
    $fm_verb = get_option('as_facebook_pg_reco_verb');
    $fm_side = get_option('as_facebook_pg_reco_side');
    $fm_domain = get_option('as_facebook_pg_reco_domain');

    if (!($fm_appid == "")) {
        echo '<div id="fb-root"></div>' . "\n";
        echo '<script>(function(d, s, id) {' . "\n";
        echo 'var js, fjs = d.getElementsByTagName(s)[0];' . "\n";
        echo 'if (d.getElementById(id)) return;' . "\n";
        echo 'js = d.createElement(s); js.id = id;' . "\n";
        echo 'js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=' . $fm_appid . '&version=v2.3";' . "\n";
        echo 'fjs.parentNode.insertBefore(js, fjs);' . "\n";
        echo '}(document, \'script\', \'facebook-jssdk\'));</script>' . "\n";
    }
}

function as_facebook_pg_likebox()
{
	$fm_appid = get_option('as_facebook_pg_reco_appid');
    $fm_pagename = get_option('as_facebook_pg_page_name');
    $fm_width = get_option('as_facebook_pg_width');
    $fm_height = get_option('as_facebook_pg_height');
    $fm_broder_color = get_option('as_facebook_pg_broder_color');
    $fm_stream = get_option('as_facebook_pg_stream');
    $fm_color_scheme = get_option('as_facebook_pg_color_scheme');
    $fm_header = get_option('as_facebook_pg_header');
    $fm_faces = get_option('as_facebook_pg_faces');

    $fm_widget_title = get_option('as_facebook_pg_widget_title');
    $fm_widget_width = get_option('as_facebook_pg_widget_width');
    $fm_widget_height = get_option('as_facebook_pg_widget_height');

    $subtract1 = 2;
    $mywidth = $fm_width - $subtract1;
    $myheight = $fm_height - $subtract1;
    $border_start = '<div id="likeboxwrap" style="width:' . $mywidth . 'px; height:' . $myheight . 'px; background: #' . $fm_color_scheme . '; border:1px solid #' . $fm_broder_color . '; overflow:hidden; text-align:center; margin:0 auto;">';

    $show_sponser1 = get_option('as_fbpage_show_sponser_link');

    if ($show_sponser1 == 1) {
        $sponserlink_profile = "";
    } else {
        $sponserlink_profile = '<div align="center">- <a href="http://Medust.com/" title="Facebook Page WordPress Plugin" target="_blank"> <font size="1">' . 'Facebook Page WordPress Plugin' . '</font></a></div>';
    }


    //$T1 = '<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2F' . $fm_pagename . '&amp;width=' . $fm_width . '&amp;height=' . $fm_height . '&amp;colorscheme=light&amp;show_faces=' . $fm_faces . '&amp;stream=' . $fm_stream . '&amp;show_border=false&amp;header=' . $fm_header . '" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:' . $fm_width . 'px; height:' . $fm_height . 'px; margin:-1px;" allowTransparency="true"></iframe>';
	$T1 = '<div class="fb-page" data-href="https://www.facebook.com/' . $fm_pagename . '" data-width="' . $fm_width . '" data-height="' . $fm_height . '" data-hide-cover="' . $fm_header . '" data-show-facepile="' . $fm_faces . '" data-show-posts="' . $fm_stream . '"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/' . $fm_pagename . '"><a href="https://www.facebook.com/' . $fm_pagename . '">Facebook</a></blockquote></div></div>';
    $border_end = '</div>';

    $output = $border_start . $T1 . $border_end;
	
	if (!($fm_appid == ""))
    	return $output . $sponserlink_profile;
}


// Displays Wordpress Blog Facebook Page Options menu
function as_facebook_pg_add_option_page()
{
    if (function_exists('add_options_page')) {
        add_options_page('Facebook Page', 'Facebook Page', 8, __FILE__, 'as_facebook_pg_options_page');
    }
}

function as_facebook_pg_options_page()
{

    $as_facebook_pg_stream = $_POST['as_facebook_pg_stream'];
    $as_facebook_pg_header = $_POST['as_facebook_pg_header'];
    $as_facebook_pg_faces = $_POST['as_facebook_pg_faces'];
    $as_facebook_pg_widget_stream = $_POST['as_facebook_pg_widget_stream'];
	$as_facebook_pg_widget_header = $_POST['as_facebook_pg_widget_header'];
    $as_facebook_pg_widget_faces = $_POST['as_facebook_pg_widget_faces'];

    if (isset($_POST['info_update'])) {
    	
    	if (!isset($_POST['my_fmz_update_setting'])) die("<br><br>Hmm .. looks like you didn't send any credentials.. No CSRF for you! ");
    	if (!wp_verify_nonce($_POST['my_fmz_update_setting'],'fmz-update-setting')) die("<br><br>Hmm .. looks like you didn't send any credentials.. No CSRF for you!");
        
    	update_option('as_facebook_pg_reco_appid', (string)$_POST["as_facebook_pg_reco_appid"]);
        update_option('as_facebook_pg_reco_readtime', (string)$_POST["as_facebook_pg_reco_readtime"]);
        update_option('as_facebook_pg_reco_verb', (string)$_POST["as_facebook_pg_reco_verb"]);
        update_option('as_facebook_pg_reco_side', (string)$_POST["as_facebook_pg_reco_side"]);
        update_option('as_facebook_pg_reco_domain', (string)$_POST["as_facebook_pg_reco_domain"]);


        update_option('as_facebook_pg_page_name', (string)$_POST["as_facebook_pg_page_name"]);
        update_option('as_facebook_pg_width', (string)$_POST["as_facebook_pg_width"]);
        update_option('as_facebook_pg_height', (string)$_POST['as_facebook_pg_height']);
        update_option('as_facebook_pg_broder_color', (string)$_POST['as_facebook_pg_broder_color']);
        update_option('as_facebook_pg_widget_title', (string)$_POST['as_facebook_pg_widget_title']);

        update_option('as_fbpage_show_sponser_link', ($_POST['as_fbpage_show_sponser_link'] == '1') ? '1' : '-1');

        update_option('as_facebook_pg_widget_page_name', (string)$_POST['as_facebook_pg_widget_page_name']);
        update_option('as_facebook_pg_widget_title', (string)$_POST['as_facebook_pg_widget_title']);
        update_option('as_facebook_pg_widget_width', (string)$_POST['as_facebook_pg_widget_width']);
        update_option('as_facebook_pg_widget_height', (string)$_POST['as_facebook_pg_widget_height']);
        update_option('as_facebook_pg_widget_stream', (string)$_POST['as_facebook_pg_widget_stream']);
		update_option('as_facebook_pg_widget_header', (string)$_POST['as_facebook_pg_widget_header']);
        update_option('as_facebook_pg_widget_color_scheme', (string)$_POST['as_facebook_pg_widget_color_scheme']);
        update_option('as_facebook_pg_widget_faces', (string)$_POST['as_facebook_pg_widget_faces']);
        update_option('as_facebook_pg_widget_no_connection', (string)$_POST['as_facebook_pg_widget_no_connection']);
        update_option('as_facebook_pg_widget_border_color', (string)$_POST['as_facebook_pg_widget_border_color']);

        update_option('as_facebook_pg_stream', (string)$_POST['as_facebook_pg_stream']);
        update_option('as_facebook_pg_color_scheme', (string)$_POST['as_facebook_pg_color_scheme']);
        update_option('as_facebook_pg_header', (string)$_POST['as_facebook_pg_header']);
        update_option('as_facebook_pg_faces', (string)$_POST['as_facebook_pg_faces']);

        echo '<div id="message" class="updated fade"><p><strong>Settings saved.</strong></p></div>';
        echo '</strong>';
    } else {
        $as_facebook_pg_stream = get_option('as_facebook_pg_stream');
        $as_facebook_pg_header = get_option('as_facebook_pg_header');
        $as_facebook_pg_faces = get_option('as_facebook_pg_faces');
        $as_facebook_pg_widget_stream = get_option('as_facebook_pg_widget_stream');
		$as_facebook_pg_widget_header = get_option('as_facebook_pg_widget_header');
        $as_facebook_pg_widget_faces = get_option('as_facebook_pg_widget_faces');
    }
    $icon_url = get_bloginfo('wpurl');
    $help_icon = '<img border="0" src="' . $icon_url . '/wp-content/plugins/facebook-page/images/help.gif" /> ';
    $new_icon = '<img border="0" src="' . $icon_url . '/wp-content/plugins/facebook-page/images/new.gif" /> ';

    $fb_recco = '<img border="0" id="east" value="Tip" title="Leave Facebook ID field blank to disable Recommendatiaon Bar on your Blog." src="' . $icon_url . '/wp-content/plugins/facebook-page/images/tip.png" /> ';

    $fb_pagename = '<img border="0" id="east1" value="Tip" title="Facebook Page Name is not the title of your page. <br>It is the URL and you only include the portion that comes after <br>the http://www.facebook.com/ part of the URL." src="' . $icon_url . '/wp-content/plugins/facebook-page/images/tip.png" /> ';

    $fb_pagename1 = '<img border="0" id="east6" value="Tip" title="Facebook Page Name is not the title of your page. <br>It is the URL and you only include the portion that comes after <br>the http://www.facebook.com/ part of the URL." src="' . $icon_url . '/wp-content/plugins/facebook-page/images/tip.png" /> ';

    $fb_readtime = '<img border="0" id="east2" value="Tip" title="Number of seconds plugin will wait before expands. (1 to 30)." src="' . $icon_url . '/wp-content/plugins/facebook-page/images/tip.png" /> ';

    $fb_showstream = '<img border="0" id="east3" value="Tip" title="If the Show Stream radio button is clicked to No (the default setting), <br>then thumbnails of your fans will be displayed. <br>If it is set to Yes, a stream of your recent postings on Facebook will be displayed." src="' . $icon_url . '/wp-content/plugins/facebook-page/images/tip.png" /> ';

    $fb_showstream1 = '<img border="0" id="east7" value="Tip" title="If the Show Stream radio button is clicked to No (the default setting), <br>then thumbnails of your fans will be displayed. <br>If it is set to Yes, a stream of your recent postings on Facebook will be displayed." src="' . $icon_url . '/wp-content/plugins/facebook-page/images/tip.png" /> ';

    $fb_showheader = '<img border="0" id="east4" value="Tip" title="If the Hide Cover radio button is set to No (the default), <br>Cover photo of Facebook Page will be displayed on the box." src="' . $icon_url . '/wp-content/plugins/facebook-page/images/tip.png" /> ';
	
	$fb_showheader1 = '<img border="0" id="east9" value="Tip" title="If the Hide Cover radio button is set to No (the default), <br>Cover photo of Facebook Page will be displayed on the box." src="' . $icon_url . '/wp-content/plugins/facebook-page/images/tip.png" /> ';
    ?>

<?php
    require_once (dirname(__FILE__) . '/includes/settings-page.php');
    ?>

<?php
}

function show_as_facebook_pg_likebox_widget($args)
{
    extract($args);
	
	$fm_appid = get_option('as_facebook_pg_reco_appid');
    $fm_pagename = get_option('as_facebook_pg_page_name');
    $fm_header = get_option('as_facebook_pg_header');

    $fm_widget_page_name = get_option('as_facebook_pg_widget_page_name');
    $fm_widget_stream = get_option('as_facebook_pg_widget_stream');
	$fm_widget_header = get_option('as_facebook_pg_widget_header');
    $fm_widget_color_scheme = get_option('as_facebook_pg_widget_color_scheme');
    $fm_widget_faces = get_option('as_facebook_pg_widget_faces');
    $fm_widget_title = get_option('as_facebook_pg_widget_title');
    $fm_widget_width = get_option('as_facebook_pg_widget_width');
    $fm_widget_height = get_option('as_facebook_pg_widget_height');
    $fm_widget_no_connection = get_option('as_facebook_pg_widget_no_connection');
    $fm_widget_border_color = get_option('as_facebook_pg_widget_border_color');

    $subtract1 = 2;
    $mywidth = $fm_widget_width - $subtract1;
    $myheight = $fm_widget_height - $subtract1;
    $border_start = '<div id="likeboxwrap" style="width:' . $mywidth . 'px; height:' . $myheight . 'px; background: #' . $fm_widget_color_scheme . '; border:1px solid #' . $fm_widget_border_color . '; overflow:hidden; text-align:center; margin:0 auto;">';

    $show_sponser1 = get_option('as_fbpage_show_sponser_link');

    if ($show_sponser1 == 1) {
        $sponserlink_profile = "";
    } else {
        $sponserlink_profile = '<div align="center">- <a href="http://Medust.com/" title="Facebook Page WordPress Plugin" target="_blank"> <font size="1">' . 'Facebook Page WordPress Plugin' . '</font></a></div>';
    }

    //$T2 = '<div id="likebox-frame"><iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2F' . $fm_widget_page_name . '&amp;width=' . $fm_widget_width . '&amp;height=' . $fm_widget_height . '&amp;colorscheme=light&amp;show_faces=' . $fm_widget_faces . '&amp;stream=' . $fm_widget_stream . '&amp;show_border=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:' . $fm_widget_width . 'px; height:' . $fm_widget_height . 'px; margin:-1px;" allowTransparency="true"></iframe></div>';
	$T2 = '<div class="fb-page" data-href="https://www.facebook.com/' . $fm_widget_page_name . '" data-width="' . $fm_widget_width . '" data-height="' . $fm_widget_height . '" data-hide-cover="' . $fm_widget_header . '" data-show-facepile="' . $fm_widget_faces . '" data-show-posts="' . $fm_widget_stream . '"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/' . $fm_widget_page_name . '"><a href="https://www.facebook.com/' . $fm_widget_page_name . '">Facebook</a></blockquote></div></div>';

    $border_end = '</div>';

	if (!($fm_appid == "")) {
		echo $before_widget;
		echo $before_title . $fm_widget_title . $after_title;
		echo $border_start . $T2 . $border_end . $sponserlink_profile;
		echo $after_widget;
	}
}


function as_facebook_pg_likebox_widget_control()
{
    ?>
<p>
    <? _e("Please go to <b>Settings -> Facebook Page</b> for all required options. "); ?>
</p>
<?php
}

function widget_as_facebook_pg_likebox_init()
{
    $widget_options = array('classname' => 'widget_as_facebook_pg_likebox', 'description' => __("Display Facebook Page"));
    wp_register_sidebar_widget('as_facebook_pg_likebox_widgets', __('Facebook Page'), 'show_as_facebook_pg_likebox_widget', $widget_options);
    wp_register_widget_control('as_facebook_pg_likebox_widgets', __('Facebook Page'), 'as_facebook_pg_likebox_widget_control');
}

function facebook_plugin_admin_init()
{
	wp_enqueue_script('jquery');                    // Enque Default jQuery
	wp_enqueue_script('jquery-ui-core');            // Enque Default jQuery UI Core
	wp_enqueue_script('jquery-ui-tabs');            // Enque Default jQuery UI Tabs
	
    wp_register_script('facebook-plugin-script3', plugins_url('/js/myscript.js', __FILE__));
    wp_enqueue_script('facebook-plugin-script3');

    wp_register_script('facebook-plugin-script4', plugins_url('/js/jquery.powertip.js', __FILE__));
    wp_enqueue_script('facebook-plugin-script4');

    wp_register_style('facebook-plugin-css', plugins_url('/css/jquery-ui.css', __FILE__));
    wp_enqueue_style('facebook-plugin-css');

    wp_register_style('facebook-tip-plugin-css', plugins_url('/css/jquery.powertip.css', __FILE__));
    wp_enqueue_style('facebook-tip-plugin-css');

    wp_register_style('facebook-page-plugin-css', plugins_url('/css/facebook-page.css', __FILE__));
    wp_enqueue_style('facebook-page-plugin-css');
}

add_action('admin_menu', 'facebook_plugin_admin_init');

add_filter('the_content', 'filter_as_facebook_pg_likebox');
add_action('init', 'widget_as_facebook_pg_likebox_init');
add_action('admin_menu', 'as_facebook_pg_add_option_page');
add_action('wp_head', 'facebook_page_head');
?>