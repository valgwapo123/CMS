<div class="is-wrapper">
            <div class="is-section is-section-navbar is-section-sticky is-section-auto is-box type-poppins" style="height:90px;background:transparent;">
               <div class="is-overlay">
                  <div class="is-overlay-content content-selectable" data-module="navbar-builder" data-module-desc="Navigation Bar" data-dialog-width="570px" data-dialog-height="640px" data-html="">
                     <style>
                        .is-topbar.fixed.static.dark,
                        .is-topbar.fixed.static,
                        .is-topbar.dark.lighttext.shrink,
                        .is-topbar.shrink,
                        .is-topbar.lighttext.shrink,
                        .is-topbar.fixed.dark,
                        .is-topbar.fixed,
                        .is-topbar.dark.shrink {
                        background-color:<?=$fe_preferences->navcolor?>!important;
                        }
                        .is-topbar.fixed.static.dark .is-menu li ul,
                        .is-topbar.fixed.static .is-menu li ul,
                        .is-topbar.dark.lighttext .is-menu li ul,
                        .is-topbar .is-menu li ul,
                        .is-topbar.lighttext .is-menu li ul,
                        .is-topbar.fixed.dark .is-menu li ul,
                        .is-topbar.fixed .is-menu li ul,
                        .is-topbar.dark .is-menu li ul {
                        background-color:<?=$fe_preferences->navcolor?>!important;
                        }
                        @media all and (max-width: 1024px) {
                        .is-menu {
                        background-color:<?=$fe_preferences->navcolor?>!important;                        
                        }
                        }
	
		.is-topbar .is-menu > ul > li > a {
		  color:<?=$fe_preferences->fontcolor?>!important;
		}
		.is-topbar .is-menu > ul > li > a.active {
		  color:<?=$fe_preferences->activecolor?>!important;
		}
		.is-topbar .is-menu > ul > li > a:hover {
		  color:<?=$fe_preferences->hovercolor?>!important;
		}
		.is-menu li ul li a {
		  color:<?=$fe_preferences->fontcolor?>!important;
		}
		.is-menu li ul li a.active {
		  color:<?=$fe_preferences->activecolor?>!important;
		}
		.is-menu li ul li a:hover {
		  color:<?=$fe_preferences->hovercolor?>!important;
		}
		.menutoggle {
		  color:<?=$fe_preferences->fontcolor?>!important;
		}
		#is-menu-toggle .line {
		  background:<?=$fe_preferences->fontcolor?>!important;	
		}
		.is-menu a span.caret {	
		  border-top: 4px solid <?=$fe_preferences->fontcolor?>!important;	
		}
                     </style>
                     <div class="is-topbar fixed" data-bgcolor="<?=$fe_preferences->navcolor?>">
                        <div class="is-topbar-container" style="max-width:1180px;">
                           <div class="is-topbar-logo">
                              <a class="is-logo-link" href="/" title="">
                              <img class="is-photo-profile" src="<?=$fe_preferences->logo?>" alt="">
                              <span class="is-sitename"></span>
                              </a>
                           </div>
                           <div class="is-topbar-menu">
                              <a id="is-menu-toggle" href="javascript:void(0)" title="Menu"><span class="line line-1"></span><span class="line line-2"></span><span class="line line-3"></span></a>
                              <div class="is-menu-overlay"></div>
                              <div class="is-menu">
                                 <div class="is-menu-search-input"><input id="is_txtSearch" type="text" placeholder="Search"><button id="is_btnSearch"><i class="icon-menu-search"></i></button></div>
					<ul class="is-menu-links" >
						<?php
						  foreach ($navi as $nav){ ?>
						  <li>
						    <a class="<?=$nav->css?>" href="<?=$nav->href?>"<?php if ($nav->target!="") echo 'target="_blank"';?>><?=$nav->name?><?php if ($nav->items){ ?><span><span class="caret menutoggle"></span></span><? } ?></a>
						    <?php if ($nav->items){ ?>							
							<ul class="sub_sub-menu">
							<?php foreach ($nav->items as $level2){ ?>
							  <li>
							    <a class="<?=$level2->css?>" href="<?=$level2->href?>"<?php if ($level2->target!="") echo 'target="_blank"';?>><?=$level2->name?><?php if ($level2->items){ ?><span><span class="caret menutoggle"></span></span><? } ?></a>
							    <?php if ($level2->items){ ?>
							    <ul>
								<?php foreach ($level2->items as $level3){ ?>
								<a class="<?=$level3->css?>" href="<?=$level3->href?>"<?php if ($level3->target!="") echo 'target="_blank"';?>><?=$level3->name?></a>
								<?php } ?>
							    </ul>
							    <?php } ?>
							  </li>
							<?php } ?>
							</ul>
						    <? } ?>
						  </li>
						<? } ?>						
						<? if (count($languages)>1){ ?>
						<li>
						  <a href="/<?php echo $currentLanguage->alias?>"><?php echo $currentLanguage->name?> <span><span class="caret menutoggle"></span></span></a>				  
						  <ul>
						  <?php foreach ($languages AS $language){
						    if ($currentLanguage->alias!=$language->alias){ ?>	
						      <li><a href="/<?php echo $language->alias;?>"><?php echo $language->name;?></a></li>
						    <?php } } ?>
						   </ul>
						</li>
						<? } ?>
						<?php if($this->session->userdata('LOGIN')=='YES'){ ?>
						<li><a href="javascript:void(0);"><?php echo ($this->session->userdata('username'));?><span><span class="caret menutoggle"></span></span></a>
						  <ul><li><a href="<?php echo base_url(); ?>/logout"><i class="fa-fw fa-solid fa-right-from-bracket"></i> <?php echo $this->lang->line('logout')?></a></li></ul>
						</li>
						<?php } ?>
					</ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <script>
                        var navbarReady = function(fn) {
                            var stateCheck = setInterval(function() {
                                if (typeof NavBar === "undefined") return;
                                clearInterval(stateCheck);
                                try {
                                    fn()
                                } catch (e) {}
                            }, 1);
                        };
                        navbarReady(function() {
                            var obj = new NavBar({
                                onSearch: (keywords) => {
                                    var domain = window.location.hostname;
                                    window.open("https://www.google.com/search?q=" + keywords + " site:" + domain, "G1window");
                                }
                            });
                            obj.init();
                        });
                     </script>
                  </div>
               </div>
            </div>
