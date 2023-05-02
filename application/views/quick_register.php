
<div class="container" style="margin-top:80px;">
      <div class="row account-area align-items-center justify-content-center">
          <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
              <div class="account-form-area">
            
                  <div class="account-header text-center">
                      <h3 class="title"><?php echo $this->lang->line('register')?></h3>
                  </div>
                  <form method="post" action="<?php echo base_url(); ?>/quickregister" accept-charset="UTF-8" autocomplete="off">
                 
                      <div class="row ml-b-20">
                          <div class="col-lg-12 form-group">
                              <i class="material-icons prefix">account_circle</i>
                              <input class="form-control form--control validate"  type="text" name="username" id="username" minlength="5" spellcheck="false" autocomplete="off" required autocapitalize="off" name="username" type="text"  spellcheck="false" autocomplete="off" autocapitalize="off">
                            <label><?php echo $this->lang->line('username')?></label>	
                            <span class="helper-text"  data-success="{*$lang['right']*}"> </span>
                            </div>


                      <div class="col-lg-12 form-group">
                       <i class="material-icons prefix">phone</i>
                        <input class="form-control form--control validate"   type="text" name="phone" id="phone" spellcheck="false" autocomplete="off" autocapitalize="off" >
                      <span id="valid-msg" class="hide">✓ Valid</span>
                      <span id="error-msg" class="hide"></span>
                      </div>

                      <div class="col-lg-12 form-group">
                        <i class="material-icons prefix">security</i>
                        <label>     <?php echo $this->lang->line('password')?>  </label>
                        <input class="form-control form--control validate" name="password" id="password" autocomplete="new-password" minlength="5" maxlength="20"  autocapitalize="off" value="">
                      </div>

        						  <br/>

          				<!-- 			<div class="error red white-text">
          						xxx
          							</div> -->
			
                          <div class="col-lg-12 form-group text-center">
                              <button class="submit-btn"  type="submit">
                                 <?php echo $this->lang->line('register')?>                                 
                               </button>
                          </div>
                   
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
 
