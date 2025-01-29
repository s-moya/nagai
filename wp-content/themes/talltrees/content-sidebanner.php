<?php
$theme_path   = get_stylesheet_directory_uri(); //テーマパス
$blog_path    = get_bloginfo("url"); //ブログURL

$ticketPage = 'trash';
$ticketPageId = get_id_by_slug('ticket');
if($ticketPageId) $ticketPage = get_post_status($ticketPageId);

$membersPage = 'trash';
$membersPageId = get_id_by_slug('members');
if($membersPageId) $membersPage = get_post_status($membersPageId);

$mailnewsPage = 'trash';
$mailnewsPageId = get_id_by_slug('mailnews');
if($mailnewsPageId) $mailnewsPage = get_post_status($mailnewsPageId);

$artistPage = 'trash';
$artistPageId = get_id_by_slug('artist');
if($artistPageId) $artistPage = get_post_status($artistPageId);

if($ticketPage == 'publish' || $membersPage == 'publish' || $mailnewsPage == 'publish' || $artistPage == 'publish'){
?>

<ul class="banner_area clearfix fixHeight">

  <li>
  	  <a href="https://ticket.kxdfs.co.jp/kpb-s/showList" target="_blank" rel="noopener noreferrer">
  	  	<img src="<?php echo $theme_path;?>/images/common/bnr-ticket.jpg" alt="オンラインチケット">
  	  	<img src="<?php echo $theme_path;?>/images/common/sp/bnr-ticket_sp.jpg" alt="オンラインチケット" class="sp">
  	  </a>
  </li>

  <?php
  if($membersPage == 'publish'){
  ?>
  <li><a href="/members/"><img src="<?php echo $theme_path;?>/images/common/bnr-member.jpg" alt="">
    <img src="<?php echo $theme_path;?>/images/common/sp/bnr-member_sp.jpg" alt="" class="sp">
  </a></li>
  <?php
  }
  if($mailnewsPage == 'publish'){
  ?>
  <li><a href="/mailnews/"><img src="<?php echo $theme_path;?>/images/common/bnr-mail.jpg" alt="">
    <img src="<?php echo $theme_path;?>/images/common/sp/bnr-mail_sp.jpg" alt="" class="sp">
  </a></li>
  <?php
  }
  if($artistPage == 'publish'){
  ?>
  <li><a href="/artist/"><img src="<?php echo $theme_path;?>/images/common/bnr-artist.jpg" alt="">
    <img src="<?php echo $theme_path;?>/images/common/sp/bnr-artist_sp.jpg" alt="" class="sp">
  </a></li>
  <?php } ?>
  
  <li>
	<a href="/liver/">
	  	<img src="<?php echo $theme_path;?>/images/common/bnr-liver.jpg" alt="">
  	  	<img src="<?php echo $theme_path;?>/images/common/sp/bnr-liver_sp.jpg" alt="誰でもライバー" class="sp">
  	  </a>
  </li>
  <li>
	<a href="https://line.me/R/ti/p/@970hqmjb" target="_blank">
	  	<img src="<?php echo $theme_path;?>/images/common/bnr-line.jpg" alt="">
  	  	<img src="<?php echo $theme_path;?>/images/common/sp/bnr-line_sp.jpg" alt="LINE" class="sp">
  	  </a>
  </li>
  <li>
	<a href="https://www.youtube.com/channel/UCw3AZ0GpxejgwycNemOU_aw" target="_blank">
	  	<img src="<?php echo $theme_path;?>/images/common/bnr-youtube.jpg" alt="">
  	  	<img src="<?php echo $theme_path;?>/images/common/sp/bnr-youtube_sp.jpg" alt="Youtube" class="sp">
  	  </a>
  </li>
  <li>
	<a href="https://www.instagram.com/nagaicivichall/" target="_blank">
	  	<img src="<?php echo $theme_path;?>/images/common/bnr-insta.jpg" alt="">
  	  	<img src="<?php echo $theme_path;?>/images/common/sp/bnr-insta_sp.jpg" alt="Youtube" class="sp">
  	  </a>
  </li>

  <li>
	<a href="https://x.com/2ycwp3jVpp22754" target="_blank">
	  	<img src="<?php echo $theme_path;?>/images/common/bnr-twitter.jpg" alt="">
  	  	<img src="<?php echo $theme_path;?>/images/common/sp/bnr-twitter_sp.jpg" alt="Twitter" class="sp">
  	  </a>
  </li>

  <!--

  <li>
  	  <a href="https://lin.ee/7gvgXvf"><img src="https://scdn.line-apps.com/n/line_add_friends/btn/ja.png" alt="友だち追加" height="36" border="0" /></a>
  	  <a href="https://lin.ee/7gvgXvf"><img src="https://scdn.line-apps.com/n/line_add_friends/btn/ja.png" alt="友だち追加" height="36" border="0" class="sp" /></a>
  </li>

  <li>
  	  <a href="/" target="_blank" rel="noopener noreferrer">
  	  	<img src="<?php echo $theme_path;?>/images/common/bnr-XXX.jpg" alt="">
  	  	<img src="<?php echo $theme_path;?>/images/common/sp/bnr-XXX_sp.jpg" alt="" class="sp">
  	  </a>
  </li>
  -->

</ul><!-- /.banner_area -->
<?php }?>
