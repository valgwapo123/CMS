<?php $this->load->view('/de/header.php'); ?>
<?php $this->load->view('/de/navigation.php'); ?>

<div class="is-section is-box is-section-auto type-averialibre-barlow">
    <div class="is-overlay"></div>
    <div class="is-boxes">
        <div class="is-box-centered">
            <div class="is-container v2 is-content-600 leading-16 size-19">
                <div class="row">
                    <div class="col-md-12">
                        <div class="spacer height-40"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="<?php echo base_url(); ?>/login-api" id="customer_login" accept-charset="UTF-8">
                           <h1><?php echo $this->session->userdata('login')?></h1>
                           <input name="langvalue" type="hidden"  spellcheck="false" value="<?php echo $this->session->userdata('lang_use')?>">
                           <div>
                                <label for="username"><?php echo $this->lang->line('username')?></label>
                                <div class="mt-1">
                                    <input class="w-full px-2 py-3 text-base border rounded" type="text" id="username" name="username" required="" type="text" value="" spellcheck="false" autocomplete="off" autocapitalize="off">
                                </div>
                           </div>
                           <div>
                                <label for="password"><?php echo $this->lang->line('password')?></label>
                                <div class="mt-1">
                                    <input class="w-full px-2 py-3 text-base border rounded" type="text" id="password" name="password" required="" type="password" value="" spellcheck="false" autocomplete="off" autocapitalize="off">
                                </div>
                           </div>
                           <?php if (isset($_GET['error'])) { ?>
                           <div class="col-lg-12 form-group text-center mt-4">
                             <?php echo $_GET['error']; ?>
                           </div>
                           <?php } ?>
                           <div class="col-lg-12 form-group text-center mt-4">
                                <button class="w-full flex justify-center items-center transition-all cursor-pointer border-2 border-solid border-transparent hover:border-transparent rounded bg-gray-200 hover:bg-gray-300 py-3 size-17 px-8 font-semibold text-gray-600 leading-relaxed" type="submit"><?php echo $this->lang->line('login')?></button>                              
                           </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer->html?>
<?php $this->load->view('/de/footer.php'); ?>