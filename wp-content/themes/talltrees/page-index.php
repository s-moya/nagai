<?php
/**
Template Name: 総合TOP
*/

$theme_path 	= get_stylesheet_directory_uri(); //テーマパス
$blog_path		= get_bloginfo("url"); //ブログURL
$post_type    = get_post_type_object(get_post_type())->name; //ポストタイプ
$page_url     = (empty($_SERVER["HTTPS"]) ? "http://" : "https://").$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];  // 現在のページのURL

get_header();

$settingPageID = get_id_by_slug('setting');
$mark_days = get_field('mark_days', $settingPageID);
$mainVisualObj = cfs()->get('mainVisual');

$sitename_en = 'Tsuruga Citizen Culture Center';

?>

<?php
// お知らせモーダルのパーツ
get_template_part( 'content-home-news-modal' );?>

<div class="indexKeyImage" id="keyImage">
	<div class="juicyslider keyImageSlider">
		<ul>
			<?php
	    if(!empty($mainVisualObj)){
	      foreach($mainVisualObj as $mainVisual){
	        $slide_image = $mainVisual['image'];
	        ?>
					<!--
					<li><img src="<?php echo $slide_image;?>" alt=""></li>
					-->
					<li><img src="../../../src/images/main/main-image01.jpg" class="pc-only" alt=""><img src="../../../src/images/main/main-image01_sp.jpg" class="sp-only" alt=""></li>
					<li><img src="../../../src/images/main/main-image02.jpg" class="pc-only" alt=""><img src="../../../src/images/main/main-image02_sp.jpg" class="sp-only" alt=""></li>
					<li><img src="../../../src/images/main/main-image04.jpg" class="pc-only" alt=""><img src="../../../src/images/main/main-image04_sp.jpg" class="sp-only" alt=""></li>
					<li><img src="../../../src/images/main/main-image03.jpg" class="pc-only" alt=""><img src="../../../src/images/main/main-image03_sp.jpg" class="sp-only" alt=""></li>
					<li><img src="../../../src/images/main/main-image07.jpg" class="pc-only" alt=""><img src="../../../src/images/main/main-image07_sp.jpg" class="sp-only" alt=""></li>
					<li><img src="../../../src/images/main/main-image05.jpg" class="pc-only" alt=""><img src="../../../src/images/main/main-image05_sp.jpg" class="sp-only" alt=""></li>
					<li><img src="../../../src/images/main/main-image06.jpg" class="pc-only" alt=""><img src="../../../src/images/main/main-image06_sp.jpg" class="sp-only" alt=""></li>
					<?php
	      }
	    }
		  ?>
		</ul>
	</div>
	<img src="<?php echo $theme_path;?>/images/common/shadow.png" alt="" class="shadow">
	<!-- /.keyImageSlider -->

	<div class="content_inner">
		<div class="hallName"><?php echo $sitename_en;?></div>
		<?php
		$pickup_set = array();
		$pickup_in_list = array();
		$pickup_status = array();
		$pickup_terms = array();
		$pickup_set = get_field('pickup_set');
		if(!empty($pickup_set)){
		  foreach($pickup_set as $pickup_check){
		    $pickupKiji = $pickup_check['kiji'];
		    $pickup_in_list[] = get_field('in_list', $pickupKiji->ID); // 一覧に表示するか
		    $pickup_status[] = get_post_status($pickupKiji->ID); // 公開ステータス
		    $pickup_terms[] = wp_get_object_terms($pickupKiji->ID, 'expire_category');
		  }
		}
		if(!empty($pickup_set)){
		?>
		<div class="pickupArea">
		  <ul class="pickupSlider fixHeight">
		  <?php include( 'block-home_pickup_panel.php'); ?>
		  </ul>
		</div><!-- /.pickupArea -->
		<?php
		}
		?>
	</div><!-- /.content_inner -->

	<div class="gNav gNavArea">
		<div class="content_inner">
		<?php get_template_part( 'block-gnav', get_post_format() );?>
		</div>
	</div><!-- /.gNav -->
</div><!-- /.indexKeyImage -->

<div class="homeMenu">
	<div class="menuPanels">
		<div class="content_inner"><h2><span>初めてご来館される方へ</span></h2></div>
		<div class="menuSlider">
		<div class="owl-carousel owl-theme">
		<?php
		$menus = get_field('menus');
		foreach($menus as $menu){
			$thumb = $menu['thumb']['url'];
			$url = $menu['url'];
			$toBlank = $menu['toBlank'];
			$name = $menu['name'];
			?>
			<div class="item">
			<div class="thumb">
			<a href="<?php echo $url;?>"<?php if($toBlank) echo 'target="_blank"';?>><img src="<?php echo $thumb;?>" alt="<?php echo $name;?>"></a>
			</div>
			<a href="<?php echo $url;?>"<?php if($toBlank) echo 'target="_blank"';?> class="arrow">
				<?php echo $name;?></a>
			</div>
			<?php
		}
		?>
		</div>
		</div>
		<!-- /.menuSlider -->

	</div><!-- /.menuPanels -->
</div><!-- /.homeMenu -->

<?php
$home_id = get_id_by_slug('home');
$special_visiblity = get_field('special_visiblity', $home_id);
if($special_visiblity != 'hidden'){
	?>
	<div class="for-sp specialNews__outer">
	<?php
	// [臨時枠] お知らせのパーツ
	get_template_part( 'content-home-news-special' );
	?>
	</div>
<?php } ?>

<?php
$pickup_set = array();
$pickup_in_list = array();
$pickup_status = array();
$pickup_terms = array();
$pickup_set = get_field('pickup_set');
if(!empty($pickup_set)){
	foreach($pickup_set as $pickup_check){
		$pickupKiji = $pickup_check['kiji'];
		$pickup_in_list[] = get_field('in_list', $pickupKiji->ID); // 一覧に表示するか
		$pickup_status[] = get_post_status($pickupKiji->ID); // 公開ステータス
		$pickup_terms[] = wp_get_object_terms($pickupKiji->ID, 'expire_category');
	}
}
if(!empty($pickup_set)){
?>
<div class="indexPickup">
	<div class="pickupArea">
		<ul class="indexPickupSlider fixHeight">
			<?php include( 'block-home_pickup_panel.php'); ?>
		</ul>
	</div><!-- /.pickupArea -->
</div>
<?php
}
?>

<div class="sideHallInfo">
<?php
	// 開館情報・今月の休館日 （スマホのみ表示）
	get_template_part( 'block-hallinfo', get_post_format() );
?>
</div><!-- /.hallInfo -->

<div class="contentWrapper">
	<div class="container clearfix">
	<div class="primary">
	<div class="right_column">


<?php if($special_visiblity != 'hidden'){ ?>
	<div class="for-pc">
	<?php
	// [臨時枠] お知らせのパーツ
	get_template_part( 'content-home-news-special' );
	?>
	</div>
<?php } ?>


		<?php
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 10
		);
		$infoPosts = get_posts($args);
		if(!empty($infoPosts)){
		?>
		<section class="notice info_list">
			<h2>お知らせ<span class="more"><a href="/info/" class="arrow">一覧を見る</a></span></h2>
			<div class="info_wall">
				<ul>
					<?php
					foreach($infoPosts as $infoPost){
						$infoID = $infoPost->ID;

						$newsLink = get_field('url', $infoID) ? : get_permalink($infoID);
						$newsTitle = get_the_title($infoID);
						$tab_target = get_field('tab_target', $infoID);

						$date = get_the_date('Ymd', $infoID);
						$date = tt_format_date($date, 'Y/m/d', '');

						//カテゴリ
						$sort_slug = '';
						$cat_tags = '';
						$cat_args = array('orderby' => 'order');
						$cat_terms = wp_get_post_terms($infoID, 'category', $cat_args);
						foreach($cat_terms as $cat_term){
						  $cat_slug = $cat_term->slug;
						  $cat_name = $cat_term->name;

							$sort_slug .= ' hall_'.$cat_slug;
						  if($cat_slug == 'all'){
						    $cat_name = $cat_all;
						  }
						  // $cat_tags .= '<span class="tag tag-'.$cat_slug.'">'.$cat_name.'</span>';
						  if($cat_term === end($cat_terms)){
						    $cat_tags .= '<span class="tag tag-'.$cat_slug.'">'.$cat_name.'</span>'."\n";
						  }else{
						    $cat_tags .= '<span class="tag tag-'.$cat_slug.'">'.$cat_name.'</span>';
						  }
						}
					?>
					<li class="clearfix">
						<div class="meta_block"><?php echo $date;?><?php echo $cat_tags;?></div>
						<p>
							<?php if($tab_target){?>
								<a href="<?php echo $newsLink;?>" class="arrow" target="_blank"><span class="info_external"><?php echo $newsTitle; ?></span></a>
							<?php } else {?>
								<a href="<?php echo $newsLink;?>" class="arrow" <?php echo ($tab_target) ? 'target="_blank"' : '';?>><?php echo $newsTitle; ?></a>
							<?php }?>
						</p>
					</li>
					<?php } ?>
				</ul>
			</div><!-- /.info_wall -->
			<p class="moreLink"><a href="/info/"><span>一覧を見る</span></a></p>
		</section><!-- /.info -->
		<?php }?>

	<?php

	wp_reset_query();

	// 公演・イベント（post_status：公開 があったら表示する）
	// ------------------------------------------------
	//	一覧に表示する　にチェックが入っているイベントのみ
	$posts_args = array(
	  'post_type'=>'event',
	  'post_status'=>'publish',
	  'posts_per_page'=>-1,
		'meta_query' => array(
			array(
				'key' => 'in_list',
				'value' => 1,
				'compare' => '=',
			)
		),
		'tax_query' => array(
	    array(
	      'taxonomy' => 'expire_category',	//タクソノミーを指定（公開終了カテゴリは非表示）
	      'field' => 'slug',	//ターム名をスラッグで指定する
	      'terms' => 'expired_event',	//表示したいタームをスラッグで指定
	      'operator'=>'NOT IN'
	    )
	  )
	);
	$lists = get_posts($posts_args);
	// foreach($lists as $lis){
	// 	var_dump($lis->post_title);
	// }
	if(!empty($lists)){

		$tabs_visible = get_field('tabs_visible');//タブリストの表示・非表示
		$tabs = get_field('addField_event');//タブ設定
		$tab_li = '';

		foreach($tabs as $tab){
			$event_genre_array = $tab['event_genre'];
			$tab_visible = $tab['tab_visible'];
			$sort_genre = '';
			$sort_id_array = '';

			//	タブに含まれるジャンルに該当するイベントの数を取得
			if(is_array($event_genre_array)){
				foreach($event_genre_array as $event_genre){
					$sort_genre .= ' genre_'.$event_genre;
					if($event_genre === end($event_genre_array)){
						$sort_id_array .= $event_genre;
					}else{
						$sort_id_array .= $event_genre.',';
					}
				}
			}

			//	タブに含まれるジャンルに該当するイベントの数を取得
			//	一覧に表示する　にチェックが入っているイベントのみ
			$genre_posts_args = array_merge(
				$posts_args,
				array(
					'tax_query' => array(
		        array(
		          'taxonomy' => 'genre',
		          'field' => 'ID',
		          'terms' => array($sort_id_array)
		        ),
						'relation' => 'AND',
						array(
							'taxonomy' => 'expire_category',	//タクソノミーを指定（公開終了カテゴリは非表示）
							'field' => 'slug',	//ターム名をスラッグで指定する
							'terms' => 'expired_event',	//表示したいタームをスラッグで指定
							'operator'=>'NOT IN'
						),
		      )
				)
			);
			$posts_by_genre = get_posts($genre_posts_args);

			if(!$tab_visible && count($posts_by_genre)>0){
				$tab_li .= '<li><a href="" data-genre="'.$sort_genre.'">'.$tab['tab_title'].'</a></li>';
			}
		}

	?>
		<section class="event_list_wrapper">
		<h2 <?php echo ($tabs_visible || !$tab_li) ? 'class="no_tabs"' : '';?>>公演・イベント情報</h2>
		<?php

		// イベントのソートタブ
		// --- 非表示にチェックが入っていなかったら表示する
		// --- タブのジャンルに含まれる公演・イベントがあったら表示する
		if(!$tabs_visible && $tab_li){
		?>
		<div class="tabs tabs_right">
		<ul>
			<li><a href="" data-genre=" genre_all" class="current">すべて
			</a></li><?php echo $tab_li;?>
		</ul>
		</div>
		<!-- /.tabArea -->
		<?php }

		// イベントリスト
		wp_reset_query();
		?>
		<ul class="event_list clearfix fixHeight sort_list">
			<?php
			foreach($lists as $list){
				include('content-event_block.php');
			}
			?>
			<p class="moreLink"><a href="/event/"><span>一覧を見る</span></a></p>
		</ul><!-- /event_list -->
		</section>
	<?php
	}

	$args = array(
		'post_type' => 'culture',
		'posts_per_page' => 6//全件表示：-1
	);
	$culturePosts = get_posts($args);
	if(!empty($culturePosts)){
	?>
	<section class="cultureArea notice">
		<h2>カルチャークラブ
		<span class="more"><a href="/culture/" class="arrow">一覧を見る</a></span></h2>
		<ul class="event_list clearfix fixHeight culture_list">
			<?php
			foreach ($culturePosts as $culturePost) {
				$post = $culturePost;
				$cultureID = $culturePost->ID;
				$title = get_the_title($cultureID);
				$brTitle = get_field('event_title',$cultureID);
				if($brTitle) $title = $title;
				$place = get_field('place', $cultureID);
				$time = get_field('time', $cultureID);
				$price = get_field('price', $cultureID);
				$contact = get_field('contact', $cultureID);
				$remark = get_field('remark', $cultureID);
				$copy = get_field('copy',$cultureID);
				$url = get_permalink($cultureID);
				$thumb = get_field('thumb',$cultureID)['url'];
				if(!$thumb){
				  $thumb = '/image-nowprinting.jpg';
				}

				//チケットの状態
				$cat_args = array('orderby' => 'order');
				$cat_tags = '';
				$ticket_tags = '';
				$ticket_terms = wp_get_post_terms($cultureID, 'culture_label', $cat_args);
				foreach($ticket_terms as $ticket_term){
				  $ticket_slug = $ticket_term->slug;
				  $ticket_name = $ticket_term->name;

				  // タグの色を取得する
				  $tag_id = 'culture_label_'.$ticket_term->term_id;
				  $tag_color = '';
				  $tag_color_num = get_field('tag_color', $tag_id);
				  if($tag_color_num){
				    $tag_color = 'style="border-color:'.$tag_color_num.'; color:'.$tag_color_num.';"';
				  }

				  if($ticket_term === end($ticket_terms)){
				    $ticket_tags .= '<span class="tag-ticket tag-'.$ticket_slug.'"'.$tag_color.'>'.$ticket_name.'</span>'."\n";
				  }else{
				    $ticket_tags .= '<span class="tag-ticket tag-'.$ticket_slug.'"'.$tag_color.'>'.$ticket_name.'</span>';
				  }
				}

			?>
			<li class="clearfix">
				<div class="thumb"><a href="<?php echo $url;?>"><img src="<?php echo $thumb;?>" alt="">
				<?php
				// NEW・UPDATEをそれぞれ**日間だけ表示
				$hide_baloon = get_field('hide_baloon', $cultureID);  //baloonを表示するかどうか
				$modified = false; //更新したかどうかのフラグ
				$visibleDays = $mark_days; //○日間表示
			  $today = (int) date_i18n('U');
			  $entry = (int) get_the_time('U', $cultureID);
			  $update = (int) get_the_modified_time('U', $post->ID);	// 最終日の更新日
			  $elapsed = (float)($today - $entry) / 86400.0;
			  $elapsed_update = (float)($today - $update) / 86400.0;
				if(!$hide_baloon){
				  if( $visibleDays > $elapsed ){?>
				    <div class="bl bl-new">NEW</div>
				  <?php
				  }else if ( $visibleDays > $elapsed_update ){
				    $modified = true;
				  ?>
				    <div class="bl bl-update">UPDATE</div>
				  <?php
				  }
				}
				?>
				</a>
				</div>
				<div class="detail">
					<div class="timesNum"><?php echo $time;?></div>
					<h3><a href="<?php echo $url;?>"><?php echo $title;?></a></h3>
					<p><?php echo $copy;?></p>
					<?php echo $ticket_tags;?>
				</div>
			</li>
			<?php
			}
			?>
		</ul><!-- /event_list -->
		<p class="moreLink"><a href="/culture/"><span>一覧を見る</span></a></p>
	</section>
	<?php }?>

	<!--
	<section class="notice info_list update_list">
		<h2>Facebook</h2>
		<div class="notice_container">
		<div class="notice_timeline">
			<div class="fb-page" data-href="/" data-tabs="timeline" data-width="500" data-height="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"></div>
		</div>
		</div>
	</section>

	<section class="notice info_list update_list column_2 clearfix">
		<div class="column_2_inner">
			<h2>Facebook</h2>
			<div class="notice_container">
			<div class="notice_timeline">
				<div class="fb-page" data-href="/" data-tabs="timeline" data-width="500" data-height="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"></div>
			</div>
			</div>
		</div>
		<div class="column_2_inner">
			<br class="sp-only"><br class="sp-only">
			<h2>Twitter</h2>
			<div class="notice_container twTimeline">
			<a class="twitter-timeline" href="/" data-chrome="nofooter noheader noborders" data-height="231"></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
		</div>
	</section>
	-->
	<!-- /.notice -->

	<section class="hallInfo column_2 clearfix fixHeight">
		<div class="column_2_inner colorPanel clearfix">
			<div class="thumb" style="margin-bottom:-4px;">
				<img src="<?php echo $theme_path;?>/images/common/img-guide-shisetu.jpg" alt="">
				<!--<img src="<?php echo $theme_path;?>/images/common/sp/img-guide-shisetu.jpg" alt="" class="for-sp">-->
			</div>
			<div class="detail">
				<h3><a href="/about/outline/" class="arrow">施設案内</a></h3>
				<ul>
					<?php
					$aboutPage_id = get_id_by_slug('about');
					$pages_args = array(
						'post_type' => 'page',
						'posts_per_page' => -1,
						'post_parent' => $aboutPage_id
					);
					$childPages = get_posts($pages_args);
					foreach($childPages as $childPage){
						$childPageLink = get_permalink($childPage->ID);
					?>
					<li>・<a href="<?php echo get_permalink($childPage->ID);?>"><?php echo $childPage->post_title;?></a></li>
					<?php }?>
				</ul>
			</div>
		</div>
		<div class="column_2_inner colorPanel clearfix">
			<div class="thumb" style="margin-bottom:-4px;">
				<img src="<?php echo $theme_path;?>/images/common/img-guide-rental.jpg" alt="">
				<!--<img src="<?php echo $theme_path;?>/images/common/sp/img-guide-rental.jpg" alt="" class="for-sp">-->
			</div>
			<div class="detail">
				<h3><a href="/guide/subscribe/" class="arrow">利用案内</a></h3>
				<ul>
					<?php
					$guidePage_id = get_id_by_slug('guide');
					$pages_args = array(
						'post_type' => 'page',
						'posts_per_page' => -1,
						'post_parent' => $guidePage_id
					);
					$childPages = get_posts($pages_args);
					foreach($childPages as $childPage){
						$childPageLink = get_permalink($childPage->ID);
					?>
					<li>・<a href="<?php echo get_permalink($childPage->ID);?>"><?php echo $childPage->post_title;?></a></li>
					<?php }?>
				</ul>
			</div>
		</div>

	</section><!-- /.hallInfo -->
	</div><!-- /.right_column -->
</div><!-- /.primary -->

<div class="secondary">
	<?php get_sidebar('all');?>
</div>
<!-- /.secondary -->

<?php get_footer(); ?>
