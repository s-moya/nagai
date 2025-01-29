<?php

// モーダル版お知らせ枠

// TOPページID
$home_id = get_id_by_slug('home');

$modal_visiblity = get_field('modal_visiblity', $home_id);
$modal_title = get_field('modal_title', $home_id);
$modal_content = get_field('modal_content', $home_id);

if($modal_visiblity != 'hidden'){
?>
<div class="modalNews" id="modalNews" style="display:none;">
<?php if($modal_title){ ?>
<h2 class="modalNews__title"><?php echo $modal_title;?></h2>
<?php } ?>
<div class="modalNews__content">
	<div class="free_area">
		<?php
		echo $modal_content;
		?>
	</div>
</div>
</div>
<?php }
