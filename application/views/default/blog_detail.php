<div class="is-section is-box is-align-left type-poppins box-hover">
    <div class="is-overlay"></div>
    <div class="is-boxes">
        <div class="is-box-centered">
            <div class="is-container v2 size-16 leading-13 is-content-1100">
              
              <?php $this->load->view('/de/blog_images.php'); ?>
              
                <div class="row">
                    <div class="col-md-12">    
  <div class="spacer height-20"></div>
  <h3 class="font-light size-21"><?php echo $blog['name'];?></h3>
  <p style="color: rgb(145, 145, 145);">
    <?php echo $blog['text'];?>    
  </p>
  <p class="leading-22">
    <a href="<?php echo $blog['back'];?>" title="" class="no-underline"><?php echo $this->lang->line('back')?> <i class="icon ion-android-arrow-forward"></i></a>
  </p>
</div>

                </div>
            </div>
        </div>
    </div>
</div>