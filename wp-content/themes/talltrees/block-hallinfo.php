<div class="side_block hoursArea">
  <h2><span>開館情報</span></h2>
  <div class="detail">
    <p>開館時間 9:00～22:00</p>
    <!--
    <ul class="clearfix fixHeight pc-only">
      <li class="clearfix" style="line-height:1em;">
        <strong>利用時間</strong><span>9:00～22:00</span><br />
        <strong>チケット受付時間</strong><span>9:00～21:30</span>
      </li>
    </ul>
    <ul class="clearfix fixHeight sp-only">
      <li class="clearfix" style="line-height:1em;">
        <strong>利用時間</strong><span>9:00～22:00</span><strong>&nbsp;&nbsp;チケット受付時間</strong><span>9:00～21:30</span>
      </li>
    </ul>
    -->
    <span class="pc-only">夜間利用のない場合は17:30まで</span>
    <span class="sp-only"><center>夜間利用のない場合は17:30まで</center></span>
  </div>
</div><!-- /.side_block -->

<div class="side_block closedDays">
  <h2><span>休館日のご案内</span></h2>
  <p>
    <?php
    $topPageID = get_id_by_slug('home');
    $closed = get_field('closed', $topPageID);
    echo $closed;
    ?>
  </p>
</div><!-- /.side_block -->
