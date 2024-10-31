<?php 
add_shortcode('dr-sara-covid-display','drSaraCovidDisplay');


function drSaraCovidDisplay($content){
$dr_sara_covid_zero_data = get_option('dr_sara_covid_zero'); 
$dr_sara_covid_args = array(
    'method' => 'GET'
);
$dr_sara_covid_country = get_option('dr_sara_covid_country');
$dr_sara_covid_flag = get_option('dr_sara_covid_flag');
if( $dr_sara_covid_country!='all'){
    $dr_sara_covid_country= 'countries/'.$dr_sara_covid_country;
}
$dr_sara_covid_yesterday = get_option('dr_sara_covid_yesterday');
$dr_sara_covid_url ='https://disease.sh/v2/'.esc_attr($dr_sara_covid_country).'?yesterday='.esc_attr($dr_sara_covid_yesterday);

$dr_sara_covid_response = wp_remote_get($dr_sara_covid_url,$dr_sara_covid_args);
if(is_wp_error($dr_sara_covid_response)){
    $err= $dr_sara_covid_response->get_error_message();
    echo "something went wrong: $err";
}

$dr_sara_covid_result =json_decode(wp_remote_retrieve_body($dr_sara_covid_response),true);

    ?>
    <div class="dr-sara-covid-page">
    <h4> <?php 
        if($dr_sara_covid_yesterday=='0') {
             _e('Today Records','dr-sara-covid'); }
             else{ _e('Yestarday Records','dr-sara-covid');}
    ?> - <?php 
            _e(strtoupper(str_replace('countries/','',$dr_sara_covid_country)),'dr-sara-covid');
            if( $dr_sara_covid_country!='all' && $dr_sara_covid_flag=='1'){
                 _e(' <img src="'.esc_attr($dr_sara_covid_result['countryInfo']['flag']).'" height="15px" width="15px" />','dr-sara-covid');
            }
    ?> </h4>
    <?php 
  
  if($dr_sara_covid_result['todayCases']>0 && $dr_sara_covid_zero_data=='1'){
  ?>
    <div class="dr-sara-covid-box">
        <?php _e('Total Cases','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['cases'],'dr-sara-covid'); ?></span>
    </div>
    <?php 
  } else{
      ?>
          <div class="dr-sara-covid-box">
        <?php _e('Total Cases','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['cases'],'dr-sara-covid'); ?></span>
    </div>
      <?php

  }
    
  if($dr_sara_covid_result['todayCases']>0 && $dr_sara_covid_zero_data=='1'){
  ?>

    <div class="dr-sara-covid-box">
        <?php 
        if($dr_sara_covid_yesterday=='0') { _e('Today Cases','dr-sara-covid'); } else {  _e('Yestarday Cases','dr-sara-covid'); } ?>
        <span><?php 
        _e($dr_sara_covid_result['todayCases'],'dr-sara-covid'); ?></span>
    </div>
    <?php 
  } 
  if($dr_sara_covid_result['deaths']>0 && $dr_sara_covid_zero_data=='1'){
    ?>
    <div class="dr-sara-covid-box">
        <?php _e('Total Deaths','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['deaths'],'dr-sara-covid'); ?></span>
    </div>
    <?php
  } 
  if($dr_sara_covid_result['todayDeaths']>0 && $dr_sara_covid_zero_data=='1'){
    ?>
    <div class="dr-sara-covid-box">
        <?php _e('Today Deaths','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['todayDeaths'],'dr-sara-covid'); ?></span>
    </div>
    <?php 
  } 
  if($dr_sara_covid_result['active']>0 && $dr_sara_covid_zero_data=='1'){
    ?>
    <div class="dr-sara-covid-box">
        <?php _e('Active','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['active'],'dr-sara-covid'); ?></span>
    </div>
<?php 
  }

  if($dr_sara_covid_result['critical']>0 && $dr_sara_covid_zero_data=='1'){
?>
    <div class="dr-sara-covid-box">
        <?php _e('Critical','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['critical'],'dr-sara-covid'); ?></span>
    </div>
<?php 
  }
  if($dr_sara_covid_result['casesPerOneMillion']>0 && $dr_sara_covid_zero_data=='1'){ 
?>
    <div class="dr-sara-covid-box">
        <?php _e('Cases Per One Million','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['casesPerOneMillion'],'dr-sara-covid'); ?></span>
    </div>
    <?php 
  }
  if($dr_sara_covid_result['deathsPerOneMillion']>0 && $dr_sara_covid_zero_data=='1'){ 
    ?>

    <div class="dr-sara-covid-box">
        <?php _e('Deaths Per One Million','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['deathsPerOneMillion'],'dr-sara-covid'); ?></span>
    </div>
    <?php 
    }
    if($dr_sara_covid_result['tests']>0 && $dr_sara_covid_zero_data=='1'){ 
    ?>
    <div class="dr-sara-covid-box">
        <?php _e('Total Tests','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['tests'],'dr-sara-covid'); ?></span>
    </div>
    <?php 
    }
    if($dr_sara_covid_result['testsPerOneMillion']>0 && $dr_sara_covid_zero_data=='1'){ 
    ?>

    <div class="dr-sara-covid-box">
        <?php _e('Tests Per One Million','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['testsPerOneMillion'],'dr-sara-covid'); ?></span>
    </div>
    <?php 
    }
    if($dr_sara_covid_result['recovered']>0 && $dr_sara_covid_zero_data=='1'){ 
    ?>
     <div class="dr-sara-covid-box">
        <?php _e('Recovered','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['recovered'],'dr-sara-covid'); ?></span>
    </div>
    <?php 
    }
    ?>
<?php 
if($dr_sara_covid_country=='all'){
?>

    <div class="dr-sara-covid-box">
        <?php _e('Affected Countries','dr-sara-covid'); ?>
        <span><?php _e($dr_sara_covid_result['affectedCountries'],'dr-sara-covid'); ?></span>
    </div>
<?php  } ?>
   
    </div>



    
    <?php 
         
  return $content;    

}

