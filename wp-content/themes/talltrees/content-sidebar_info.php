<?php

// template ： お知らせのサイドバー

require_once "class/TtEvent.php";


$this_post_year = get_the_date('Y');	// 閲覧中の記事の投稿年
$this_post_id = get_the_ID();	// 閲覧中の記事のID
?>

<nav class="nav_category side_category_list">
<h3 class="to_parent"><a href="/info/topics/" class="arrow">お知らせ</a></h3>
<?php

$archive_year = get_query_var('year');
$info_year = NULL; // 年の初期化
$info_args = array( // クエリの作成
	'post_type' => 'post', // 投稿タイプの指定
	'orderby' => 'date', // 日付順で表示
	'posts_per_page' => -1 // すべての投稿を表示
);

$the_query = new WP_Query($info_args);
if($the_query->have_posts()){ // 投稿があれば表示
	while ($the_query->have_posts()){
		$the_query->the_post();
		if($info_year != get_the_date('Y') ){
			$info_year = get_the_date('Y');
			?>
			<dl class="<?php echo (is_singular('post') && $this_post_year == $info_year) ? 'nav_category_show' : '';?>">
				<dt class="arrow"><?php echo $info_year;?>年</dt>
				<dd>
					<ul><?php
						$info_child_args = array_merge( $info_args, array(
							'year' => $info_year
						) );
						$info_child_query = new WP_Query($info_child_args);
						if($info_child_query->have_posts()){ // 投稿があれば表示
							while ($info_child_query->have_posts()){
								$info_child_query->the_post();
								$info_child_id = get_the_ID();
								$info_perma_link = get_permalink();
								$info_link = get_field('url') ? : '';
								$info_tab_target = get_field('tab_target') ? : '';
								$info_date = get_the_date('Y年n月j日');
								$perma_link = $info_link ? : $info_perma_link;
								?>
								<li class="<?php echo (is_singular('post') && $this_post_id == $info_child_id) ? 'nav_category_current' : '';?>">
								<?php if($info_tab_target){?>
									<a href="<?php echo $perma_link;?>" class="arrow_simple" target="_blank"><span class="arw_external -hover"><?php echo $info_date;?></span></a>
								<?php } else {?>
									<a href="<?php echo $perma_link;?>" class="arrow_simple"><?php echo $info_date;?></a>
								<?php }?>
								</li>
								<?php
							}// loop end
							wp_reset_postdata();
						}

						?></ul>
				</dd>
			</dl>
			<?php
		}
	} // ループの終了
	wp_reset_postdata(); // クエリのリセット
}
?>

</nav>
