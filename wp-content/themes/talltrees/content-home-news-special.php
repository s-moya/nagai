<?php

// 臨時お知らせ枠

// TOPページID
$home_id = get_id_by_slug('home');

$special_visiblity = get_field('special_visiblity', $home_id);
$special_content = get_field('special_content', $home_id);
$special_url = get_field('special_url', $home_id) ? : '';

if($special_visiblity != 'hidden'){
?>
<div class="specialNews text-frame">
<span class="specialNews__icon"><svg viewBox="0 0 3 12"><g><path class="st0" d="M0,0h3v8H0V0z"/><path class="st0" d="M3,9v3H0V9H3z"/></g></svg></span>
<?php if($special_url){ ?>
	<p class="specialNews__title"><a href="<?php echo $special_url;?>"><?php echo $special_content;?></a></p>
<?php } else { ?>
	<p class="specialNews__title"><?php echo $special_content;?></p>
<?php } ?>
</div>
<?php }
