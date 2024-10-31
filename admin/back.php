<?php
add_action('admin_menu', 'my_menu_pages');
function my_menu_pages(){
    add_menu_page('DR SARA COVID Dashboard', 'DR SARA COVID', 'manage_options', 'dr-sara-covid', 'dr_sara_covid_dashboard','dashicons-welcome-widgets-menus', 3);
	add_submenu_page('dr-sara-covid', 'DR SARA COVID Settings', 'Settings', 'manage_options','dr-sara-covid-settings','dr_sara_covid_settings',10);
	//call register settings function
	add_action( 'admin_init', 'register_dr_sara_covid_settings' );
}

// register setting 
function register_dr_sara_covid_settings(){
	register_setting('dr-sara-covid-settings-group','dr_sara_covid_country');
	register_setting('dr-sara-covid-settings-group','dr_sara_covid_yesterday');
	register_setting('dr-sara-covid-settings-group','dr_sara_covid_flag');
}

function dr_sara_covid_dashboard(){
	 _e('<div class="dr-sara-dashboard">
	<h3> Welcome To DR SARA Covid Records.</h3>
	<p>Note: If you are using this plugin for first time, Please Go To <b><i>DR SARA Covid > Settings</i></b> and click on Save Changes button.</p>
	</div>','dr_sara_covid_flag');
}

function dr_sara_covid_settings(){


	?>


  <form method="post" action="options.php">
  
  <?php 
  $dr_sara_covid_country = get_option('dr_sara_covid_country');
  $dr_sara_covid_yesterday = get_option('dr_sara_covid_yesterday');
  $dr_sara_covid_flag = get_option('dr_sara_covid_flag');
  settings_fields( 'dr-sara-covid-settings-group' );
  do_settings_sections('dr-sara-covid-settings-group');
  ?>
  <h3>Manage Display DR SARA COVID Settings</h3>
  <i>Use shortcode anywhere you want to display records: <b>[dr-sara-covid-display]</b></i>
  <input type="text" value="[dr-sara-covid-display]" id="drSaraAll">
  <button onclick="drsaraAllCopy()">Copy Shortcode</button>
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
  <option value="0">Today Records</option>
  <option value="1">Yesterday Records</option>
  </select>
  </td>
  </tr>



  <tr valign="top">
  <th scope="row"><label for="dr_sara_covid_flag">Country Flag</label></th>
  <td>
  <select name="dr_sara_covid_flag">
  <?php 
  if(!empty($dr_sara_covid_flag)){
	  ?>
<option value="<?php echo esc_attr($dr_sara_covid_flag);  ?>"><?php if(esc_attr($dr_sara_covid_flag)=='1'){ echo esc_attr('Show Country Flag'); } else { echo esc_attr('Hide Country Flag'); }  ?></option>
	  <?php
  } 
  ?>
  <option value="0">Hide Country Flag</option>
  <option value="1">Show Country Flag</option>
  </select>
  </td>
  </tr>

  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
	<?php
}