<?php
  $location = '山形県長井市';
  if(is_front_page()){
    echo get_bloginfo('name').'｜'.$location;
  }else if(is_page('event_calendar')){
    $activeMonth = filter_input( INPUT_GET, 'month_select' );
    if(!$activeMonth) $activeMonth = date_i18n('n');
    echo $activeMonth.'月';
    echo get_the_title().'｜'.get_bloginfo('name');
  }else if(is_page()){
    echo get_the_title().'｜'.get_bloginfo('name');
  } else if(get_query_var('year')){
		echo single_cat_title( '', false ).'（'.get_query_var('year').'年）｜'.get_bloginfo('name');
	} else{
    wp_title( '｜', true, 'right' );
    bloginfo( 'name' );
  }
?>
