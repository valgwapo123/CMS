<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemController extends CI_Controller {
 


 public function __construct() {
      parent::__construct();


      $language=($this->session->userdata('lang_use')==null)? 'de' : $this->session->userdata('lang_use');
      $this->session->set_userdata('lang_use', $language);
      $this->lang->load('home',$language);


      $this->load->library('migration');
      $this->load->library('session');

      $this->load->model('navigation/NavigationPostModel');
      $this->load->model('post/PostModel');
      $this->load->library('curl');
      $this->load->library('DatabaseWrapper');

      //cron job
      $this->curl->set_url(site_url('cron_job')); 
      $this->curl->set_method('post');
      $response = $this->curl->result();


  }





  public function generateLinks($element,$currentLanguage){
    // check if element has an link and if link is internal or external
    if ($element->link!=""){
      if (substr_count($element->link,'https')>0){
        $element->href=$element->link;
        $element->target="_blank";
      } else {
        $element->href=$element->link;
        $element->target="";
      }
    } else {
					   if ($element->alias==""){
										$element->href="javascript:void(0);";
          $element->target="";
								} else {
          $element->href="/".$currentLanguage->alias."/".$element->alias;
          $element->target="";
								}
    }
    return $element;
  }
  public function prepareNavigation($currentLanguage,$currentPage){    
    $db = new DatabaseWrapper();
    $path[]=$currentPage->id;
    if ($currentPage->parent>0){
      $blub=$db->query('SELECT id,name,parent FROM navigation WHERE id=?',Array($currentPage->parent))->fetchRow();
      if ($blub->parent>0){
         $path[]=$blub->id;
         $next=$db->query('SELECT id,name,parent FROM navigation WHERE id=?',Array($blub->parent))->fetchRow();         
         if ($next->parent>0){
           $path[]=$next->id;
         }
      }
    }
    $path=array_reverse($path);
    if (count($path)==2) {
     $path[]=0;
    }
    if (count($path)==1) {
     $path[]=0;
     $path[]=0;
    }    
    $navi =  $db->query('SELECT id,name,alias,link,parent FROM navigation WHERE parent=? AND state=1 ORDER BY sort ASC',Array($currentLanguage->id))->fetchAll();
    foreach ($navi AS $element){
      $element=$this->generateLinks($element,$currentLanguage);
      $element->css="";
      if ($element->id==$path[0]) $element->css="active";
      $element->items=new stdClass();
      $element->items=$db->query('SELECT id,name,alias,link,parent FROM navigation WHERE parent=? AND state=1 ORDER BY sort ASC',Array($element->id))->fetchAll();
      foreach ($element->items AS $sub){
        $sub->css="";
        if ($sub->id==$path[1]) $sub->css="active";
        $sub=$this->generateLinks($sub,$currentLanguage);
        $sub->items=new stdClass();
        $sub->items=$db->query('SELECT id,name,alias,link,parent FROM navigation WHERE parent=? AND state=1 ORDER BY sort ASC',Array($sub->id))->fetchAll();
        foreach ($sub->items AS $blub){
          $blub->css="";
          if ($blub->id==$path[2]) $blub->css="active";
          $blub=$this->generateLinks($blub,$currentLanguage);
        }
      }
    }
    return $navi;
  }
		function addLazyClass($html) {    
    $pattern = '/<img(.*?)>/';
    $replacement = '<img loading="lazy" $1>';
    $newHtml = preg_replace($pattern, $replacement, $html);
    return $newHtml;
  }
  public function navigation($route){

		 $data['parent_id'] = $this->NavigationPostModel->read_parent_id($this->uri->segment(2));   
		 $data['parent_id_2'] = $this->NavigationPostModel->read_parent_id_submenu($this->NavigationPostModel->read_parent_id($this->uri->segment(2)));
		 $data['parent_full']=  $this->NavigationPostModel->read_id($this->NavigationPostModel->read_parent_id($this->uri->segment(2)));
		 //end	
		 $language=($this->session->userdata('lang_use')=='')? $this->uri->segment(1): $this->session->userdata('lang_use');
		 $data['language_'] = $this->NavigationPostModel->read_language(0);
		 $data['navigation'] = $this->NavigationPostModel->read_navigation($this->NavigationPostModel->get_parent_id($language),0);
		 $data['login_required'] = 0;
		 $this->load->view('header',$data);

		$this->load->view('navigation',$data);
  } 

 
 public function applyModules($id){
   $objects = new stdClass();   
   $db = new DatabaseWrapper();
   
   // fetch all announces
   if ($db->table_exists("fe_announce")){
     $objects->fe_announce = $db->query('SELECT * FROM fe_announce WHERE id_page = ? AND online_from < ? AND online_to > ? AND state=1',array($id,time(),time()))->fetchRow();
   } else {
     $objects->fe_announce =array();
   }
   
   return $objects;
 }
	public function prepareOutput($page){
   $content="";   
		 $content.=str_replace("assets/","/application/public/assets/",$page->maincss);
   $content.=str_replace("assets/","/application/public/assets/",$page->sectioncss);
   $content.=str_replace("assets/","/application/public/assets/",$page->html);
   //$content=str_replace('&quot;',"'",$content);
   //$content=str_replace('//',"/",$content);
   $content=str_replace('//application/public/assets/',"/application/public/assets/",$content);
			if ($this->config->item('lazyload_images')){
     //$content=$this->addLazyClass($content);
   }
   $page->html=$content;
		 return $page;
	}
 public function fetchLogos($blub){
   $blub->favicon="";
   $blub->logo="";
   
   $files=json_decode($blub->files);
   $images=json_decode($blub->images);
   if (is_array($files) && isset($files[0])){
     $blub->favicon="/upload".$files[0];
   }
   if ($images->preview){
     $blub->logo="/upload".$images->preview[0];
   }
   
   return $blub;
 }
 public function getImages($item){   
     $images=json_decode($item['images']);
     $item['preview']=$images->preview;
     $item['full']=$images->full;
      
   return $item;
 }



	public function front_view($param_lang,$route,$seo=NULL) 
	{

    function compress_code($code) 
    {
     $search = array(
      '/\>[^\S ]+/s',  // remove whitespaces after tags
      '/[^\S ]+\</s',  // remove whitespaces before tags
      '/(\s)+/s'       // remove multiple whitespace sequences
     );

     $replace = array('>','<','\\1');
     $code = preg_replace($search, $replace, $code);
     return $code;
    }

  //  ob_start("compress_code");      
   $db = new DatabaseWrapper();   
   $preferences = $db->query('SELECT * FROM fe_preferences')->fetchRow();
   $languages=$db->query('SELECT * FROM navigation WHERE parent=0 AND state=1 AND name<>"system"')->fetchAll();   
   $currentLanguage=$db->query('SELECT * FROM navigation WHERE alias="'.$param_lang.'"')->fetchRow();
   if (!$currentLanguage) header("Location:/");
   if (!$route OR strlen($route)==0){
     $page = $db->query('SELECT * FROM navigation WHERE parent='.$currentLanguage->id.' AND is_home=1')->fetchRow();
     if ($page){
       header('Location:/'.$param_lang.'/'.$page->alias);
     } else {
       echo "error";exit;
     }
   } else {
     $home = $db->query('SELECT * FROM navigation WHERE parent='.$currentLanguage->id.' AND is_home=1')->fetchRow();
     $page = $db->query('SELECT * FROM navigation WHERE alias="'.$route.'"')->fetchRow();
     if ($page){
       //echo "alles ok";exit;
     } else {
       header('Location:/'.$param_lang.'/'.$home->alias);
     }
   }
   
   
   $data['fe_preferences']=$this->fetchLogos($preferences);
   if (!$data['fe_preferences']) {
     echo "error";exit;
   }
     
   
   
   $data['parent_id'] = $this->NavigationPostModel->read_parent_id($this->uri->segment(2));
		 $data['parent_id_2'] = $this->NavigationPostModel->read_parent_id_submenu($this->NavigationPostModel->read_parent_id($this->uri->segment(2)));
		 $data['parent_full']=  $this->NavigationPostModel->read_id($this->NavigationPostModel->read_parent_id($this->uri->segment(2)));
		 //end	
		 $language=($this->session->userdata('lang_use')=='')? $param_lang : $this->session->userdata('lang_use');
   
		 $data['language_'] = $this->NavigationPostModel->read_language(0);
		 $data['navigation'] = $this->NavigationPostModel->read_navigation($this->NavigationPostModel->get_parent_id($param_lang),0);
		 $data['login_required'] = 0;
		 $data['languages']=$languages;
   $data['currentLanguage']=$currentLanguage;
   
   $currentPage=$this->NavigationPostModel->read_alias($route);
   $data['navi']=$this->prepareNavigation($currentLanguage,(object)$currentPage);
   
   
  
   
   // check if the current page has a footer if not fetch the language footer
   $footer = $db->query('SELECT * FROM fe_footer WHERE id_parent=?',Array($currentPage->id))->fetchRow();
   if (!$footer){
     $footer = $db->query('SELECT * FROM fe_footer WHERE id_parent=?',Array($currentLanguage->id))->fetchRow();
   }
   
			if (!$footer){
				 $footer=new stdClass();
     $footer->html="";
			} else {
     $footer = $this->prepareOutput($footer); 
   }
   
   if ($footer) {
    $data['footer']=$footer;
   }
   
   
   $data['modules']=$this->applyModules($currentPage->id);
   
			$data['currentPage']=$this->prepareOutput($currentPage);
		 $data['blog_list']=$this->PostModel->read_post('fe_posts',$this->NavigationPostModel->get_id($this->uri->segment(2)),'id','ASC');
			
			if ($seo!=NULL){
     $data['blog_single'] = $db->query("SELECT * FROM fe_posts WHERE seo=?",Array($seo))->fetchRow();
   }
			
   if (isset($data['blog_list']) OR isset($data['blog_single'])){
     $template="blog";
     if (isset($data['blog_single'])) {
       $template="blog_detail";
       $data['blog_list']=NULL;
       $data['blog_single']->back="/".$currentLanguage->alias.'/'.$currentPage->alias;
       $data['blog_list'][]=(array)$data['blog_single'];
       
     }
     $blogcontent="";
     $blogsection="";
     // check if #fe_posts exists within content
     // if it exists then display the blog content instead of #fe_posts
     // otherwise append it as section with content to current content    
     foreach ($data['blog_list'] AS $blog){
       $data['blog']=$this->getImages($blog);
       $blogcontent.=$this->load->view($this->checkLanguageDirs($currentLanguage->alias).'/'.$template,$data,true);
     }

   

     if (substr_count($currentPage->html,"#fe_posts")>0){      
       $currentPage->html=str_replace('#fe_posts',$blogcontent,$currentPage->html);
     } else {
       $blogsection=$this->load->view($this->checkLanguageDirs($currentLanguage->alias).'/'.'blog_section',$data,true);
       $currentPage->html.=$blogsection;
       $currentPage->html=str_replace('#fe_posts',$blogcontent,$currentPage->html);
     }

    //  str_replace("/ Do Nothing","//Do Nothing",$currentPage->html);
  }
  
  $data['currentPage']=$currentPage;	


		if ($currentPage->login_required && $this->session->userdata('LOGIN')!='YES'){
     $this->load->view($this->checkLanguageDirs($currentLanguage->alias).'/'.'login',$data); 
   } else {
     if ($currentPage->template && is_file(APPPATH.'views/'.$this->checkLanguageDirs($currentLanguage->alias).'/'.$currentPage->template.'.php')){       
       $this->load->view($this->checkLanguageDirs($currentLanguage->alias).'/'.$currentPage->template,$data);
     } else {
       $this->load->view($this->checkLanguageDirs($currentLanguage->alias).'/'.'default',$data);
     }     
   }
   
	// }


  //  ob_end_flush();
   
	}



 public function checkLanguageDirs($lang){
   if (!is_dir(APPPATH.'views/'.$lang)) $lang="default";
   return $lang;
 }
	public function home(){

   $home_id=$this->PostModel->get_table_info('fe_preferences')->id_home;
   $parent_id=$this->NavigationPostModel->read_id($home_id);



   redirect($this->config->item('base_url').$this->NavigationPostModel->read_navigation_info($parent_id)->alias.'/'.$this->NavigationPostModel->read_navigation_info($home_id)->alias);
	}


}
