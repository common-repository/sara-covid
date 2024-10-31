<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://khadkaravi.com.np/
 * @since      1.0.0
 *
 * @package    Dr_Sara_Covid
 * @subpackage Dr_Sara_Covid/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dr_Sara_Covid
 * @subpackage Dr_Sara_Covid/admin
 * @author     Developer Ravi <khadkaravi170@gmail.com>
 */
class Dr_Sara_Covid_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dr_Sara_Covid_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dr_Sara_Covid_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dr-sara-covid-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dr_Sara_Covid_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dr_Sara_Covid_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dr-sara-covid-admin.js', array( 'jquery' ), $this->version, false );

	}

	// add new new 
}

$dr_sara_covid_get_post_opt= get_option('dr_sara_covid_post_option');
// $dr_sara_covid_get_page_opt= get_option('dr_sara_covid_page_option');
if($dr_sara_covid_get_post_opt=="1"){
add_filter( 'the_content', 'drSaraCovidDisplay');
}


add_action("admin_menu", "dr_sara_covid_options");
function dr_sara_covid_options()
{
	add_menu_page(
		"Theme Options",
		"DR Sara Covid",
		"manage_options",
		"dr-sara-covid",
		"theme_options_page",
		"",
		50
	);
	add_action( 'admin_init', 'register_dr_sara_covid_settings' );
}


// register setting 
function register_dr_sara_covid_settings(){
	register_setting('dr-sara-covid-settings-group','dr_sara_covid_country');
	register_setting('dr-sara-covid-settings-group','dr_sara_covid_yesterday');
	register_setting('dr-sara-covid-settings-group','dr_sara_covid_flag');
	register_setting('dr-sara-covid-settings-group','dr_sara_covid_zero');
	register_setting('dr-sara-covid-settings-group','dr_sara_covid_post_option');
	register_setting('dr-sara-covid-settings-group','dr_sara_covid_page_option');
}

function theme_options_page()
{
	?>
		<div class="wrap">
		<div id="icon-options-general" class="icon32"></div>
		<h1>DR SARA COVID</h1>
	   

		<?php
			//we check if the page is visited by click on the tabs or on the menu button.
			//then we get the active tab.
			$active_tab = "dr-sara-dashboard";
			if(isset($_GET["tab"]))
			{
				if($_GET["tab"] == "dr-sara-dashboard")
				{
					$active_tab = "dr-sara-dashboard";
				}
				else
				{
					$active_tab = "dr-sara-covid-settings";
				}
			}
		?>
	   
		<!-- wordpress provides the styling for tabs. -->
		<h2 class="nav-tab-wrapper">
			<!-- when tab buttons are clicked we jump back to the same page but with a new parameter that represents the clicked tab. accordingly we make it active -->
			<a href="?page=dr-sara-covid&tab=dr-sara-dashboard" class="nav-tab <?php if($active_tab == 'dr-sara-dashboard'){echo 'nav-tab-active';} ?> "><?php _e('Dashboard', 'dr-sara-covid'); ?></a>
			<a href="?page=dr-sara-covid&tab=dr-sara-covid-settings" class="nav-tab <?php if($active_tab == 'dr-sara-covid-settings'){echo 'nav-tab-active';} ?>"><?php _e('Basic Options', 'dr-sara-covid'); ?></a>
		</h2>

		<form method="post" action="options.php">
			<?php
		   
				// settings_fields("dr_sara_covid_section");
			   
				do_settings_sections("dr-sara-covid");
				settings_fields( 'dr-sara-covid-settings-group' );
do_settings_sections('dr-sara-covid-settings-group');
if(isset($_GET['tab'])){
		   if($_GET['tab']=='dr-sara-covid-settings'){
				submit_button();
		   }
		}
			?>          
		<!-- </form> -->
	</div>
	<?php
}


add_action("admin_init", "dr_sara_covid_display_options");
function dr_sara_covid_display_options()
{
	add_settings_section("dr_sara_covid_section","", "dr_sara_covid_option_output", "dr-sara-covid");

}
function dr_sara_covid_option_output()
{
	if(isset($_GET['tab'])){
	if($_GET['tab']=="dr-sara-dashboard"){
		_e('<div class="dr-sara-dashboard">
		<h3> Welcome To DR SARA Covid Records.</h3>
		<p>Note: If you are using this plugin for first time, Please Go To <b><i>DR SARA Covid > Settings</i></b> and click on Save Changes button.</p>
		</div>','dr-sara-covid');

	}

elseif($_GET['tab']=="dr-sara-covid-settings"){

// echo '<form method="post" action="options.php">';

$dr_sara_covid_country = get_option('dr_sara_covid_country');
$dr_sara_covid_yesterday = get_option('dr_sara_covid_yesterday');
$dr_sara_covid_flag = get_option('dr_sara_covid_flag');
$dr_sara_covid_zero = get_option('dr_sara_covid_zero');
$dr_sara_covid_post_option = get_option('dr_sara_covid_post_option');
$dr_sara_covid_page_option = get_option('dr_sara_covid_page_option');

// settings_fields( 'dr-sara-covid-settings-group' );
// do_settings_sections('dr-sara-covid-settings-group');
?>
<h3>Manage Display DR SARA COVID Settings</h3>
<i>Use shortcode anywhere you want to display records: <b>[dr-sara-covid-display]</b></i>
<input type="text" value="[dr-sara-covid-display]" id="drSaraAll" readonly>
<hr>
<table>
<tr valign="top">
<th scope="row"><label for="myplugin_option_name">Select Country</label></th>
<td>
<select name="dr_sara_covid_country">
<?php 
if(!empty($dr_sara_covid_country)){
	?>
<option value="<?php echo esc_attr($dr_sara_covid_country);  ?>"><?php echo esc_attr($dr_sara_covid_country);  ?></option>
	<?php
}

require 'country-name.php';
?>
</select>
</td>
</tr>

<tr valign="top">
<th scope="row"><label for="dr_sara_covid_yesterday">Display  Records</label></th>
<td>
<select name="dr_sara_covid_yesterday">
<?php 
if(!empty($dr_sara_covid_yesterday)){
	?>
<option value="<?php echo esc_attr($dr_sara_covid_yesterday);  ?>"><?php if(esc_attr($dr_sara_covid_yesterday)=='1'){ echo esc_attr('Yesterday Records'); } else { echo esc_attr('Today Records'); }  ?></option>
	<?php
} 
?>
<option value="0">Todays Records</option>
<option value="1">Yesterday Records</option>
</select>
</td>
</tr>



<tr valign="top">
<th scope="row"><label for="dr_sara_covid_flag"><?php _e('Hide/Show','dr-sara-covid'); ?></label></th>
<td>
<select name="dr_sara_covid_flag">
<?php 
if(!empty($dr_sara_covid_flag)){
	?>
<option value="<?php echo esc_attr($dr_sara_covid_flag);  ?>"><?php if(esc_attr($dr_sara_covid_flag)=='1'){ echo esc_attr('Show Country Flag'); } else { echo esc_attr('Hide Country Flag'); }  ?></option>
	<?php
} 
?>
<option value="0"><?php _e('Hide Country Flag','dr-sara-covid'); ?></option>
<option value="1"><?php _e('Show Country Flag','dr-sara-covid'); ?></option>
</select>

<select name="dr_sara_covid_zero">
<?php 
if(!empty($dr_sara_covid_zero)){
	?>
<option value="<?php echo esc_attr($dr_sara_covid_zero);  ?>"><?php if(esc_attr($dr_sara_covid_zero)=='1'){ echo esc_attr('Show Zero Value Data'); } else { echo esc_attr('Hide Zero Value Data'); }  ?></option>
	<?php
} 
?>
 <option value="0"><?php _e('Hide Zero Value Data','dr-sara-covid'); ?></option>
<option value="1"><?php _e('Show Zero Value Data','dr-sara-covid'); ?></option> 
</select>

</td>
</tr>



<tr valign="top">
<th scope="row"><label for="dr_sara_covid_post_page"><?php _e('Post/Page','dr-sara-covid'); ?></label></th>
<td>
<select name="dr_sara_covid_post_option">
<?php 
if(!empty($dr_sara_covid_post_option)){
	?>
<option value="<?php echo esc_attr($dr_sara_covid_post_option);  ?>"><?php if(esc_attr($dr_sara_covid_post_option)=='1'){ echo esc_attr('Show On Post'); } else { echo esc_attr('Hide On Post'); }  ?></option>
	<?php
} 
?>
<option value="0"><?php _e('Hide On Post and Page','dr-sara-covid'); ?></option>
<option value="1"><?php _e('Show On Post and Page','dr-sara-covid'); ?></option>
</select>

<!-- <select name="dr_sara_covid_page_option">
<?php 
// if(!empty($dr_sara_covid_page_option)){
	?>
<option value="<?php 
// echo esc_attr($dr_sara_covid_page_option);  ?>"><?php 
// if(esc_attr($dr_sara_covid_page_option)=='1'){ echo esc_attr('Show On Page Footer'); } else { echo esc_attr('Hide On Page Footer'); }  ?></option>
	<?php
} 
?>
 <option value="0"><?php
//   _e('Hide On Page Footer','dr-sara-covid'); ?></option>
<option value="1"><?php
//  _e('Show On Page Footer','dr-sara-covid'); ?></option> 
</select> -->

</td>
</tr>





</table>
<?php
// }

	}
	else{
		_e('<div class="dr-sara-dashboard">
		<h3> Welcome To DR SARA Covid Records.</h3>
		<p>Note: If you are using this plugin for first time, Please Go To <b><i>DR SARA Covid > Settings</i></b> and click on Save Changes button.</p>
		</div>','dr_sara_covid_flag');
	
	}

	?>
		
	<?php
}


