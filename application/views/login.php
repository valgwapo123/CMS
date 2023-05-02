<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>



<div class="container" style="margin-top:80px;">
      <div class="row account-area align-items-center justify-content-center">
          <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
              <div class="account-form-area">
                  <div class="account-logo-area text-center">
                      <div class="account-logo">
                          <a href="/"><img src="<?php echo base_url(); ?>application/public/assets/images/logoIcon/logo.png" alt="site-logo" alt="logo"></a>
                      </div>
                  </div>

                   

                
                  <?php if (isset($_GET['er'])) { ?>
                    <?php
                        if( $_GET['er'] ){
                        ?>
                    <div class="alert">
                         <?php echo $this->lang->line('error-login')?> 
                    </div>
                  <?php }?>
                 <?php }?> 
                  <div class="account-header text-center">
                      <h3 class="title"><?php echo $this->lang->line('login')?>  </h3>
                  </div>
                  <form method="post" action="<?php echo base_url(); ?>/login-api" id="customer_login" accept-charset="UTF-8">

                      <input name="langvalue" type="hidden"  spellcheck="false" value="<?php echo $this->session->userdata('lang_use')?>">
                   
                      <div class="row ml-b-20">
                          <div class="col-lg-12 form-group">
                              <label><?php echo $this->lang->line('username')?> </label>
                              <input placeholder="username" class="form-control form--control" name="username" type="text" value="" spellcheck="false" autocomplete="off" autocapitalize="off">
                          </div>
                          <div class="col-lg-12 form-group">
                              <label><?php echo $this->lang->line('password')?> </label>
                              <input class="form-control form--control" id="password" name="password" type="password" placeholder="password" required="">
                          </div>

                          <div class="mb-3">
  
                          <div class="col-lg-12 form-group">
                              <div class="checkbox-wrapper d-flex align-items-center flex-wrap">
                                  <div class="checkbox-item">
                                      <label><a href="<?php echo base_url(); ?>/recover"><?php echo $this->lang->line('forgot')?> </a></label>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-12 form-group text-center">
                              <button class="submit-btn" type="submit">
                                  <?php echo $this->lang->line('login')?>                               
                               </button>
                          </div>
                          <div class="col-lg-12 text-center">
                              <div class="account-item mt-10">
                                    <a href="<?php echo base_url(); ?>/qr-register" class="text--base"><?php echo $this->lang->line('register')?> </a>		                                                                  
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>