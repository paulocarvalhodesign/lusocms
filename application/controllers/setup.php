<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Setup_Controller extends Base_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Admin Controller 
     |--------------------------------------------------------------------------
     |
     */


    public $restful = true;
    

    public function get_index() {
   
     $folder = path('root').'cms_config';
     if(is_writable($folder)) 
     File::put(path('root').'cms_config/site_name.php', '');
     File::put(path('root').'cms_config/user_details.php', '');
     File::put(path('root').'cms_config/tracking_code.php', '');
     
      
     $view = View::make('path: '.ADMIN_THEME_PATH.'install/index.blade.php');
     return $view;
 
    }


    

    
    
}