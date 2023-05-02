<div class="col-md-3">  
  <img src="/upload/<?=$blog['preview'][0]?>" alt="">
  <div class="spacer height-20"></div>
  <h3 class="font-light size-21"><?php echo $blog['name'];?></h3>
  <p style="color: rgb(145, 145, 145);">
    <?php echo $blog['teaser'];?>    
  </p>
  <p class="leading-22">
    <a href="<?php echo current_url().'/'.$blog['seo']?>" title="" class="no-underline"><?php echo $this->lang->line('readmore')?> <i class="icon ion-android-arrow-forward"></i></a>
  </p>
</div>
