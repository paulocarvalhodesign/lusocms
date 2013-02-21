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
    
     
      
     $view = View::make('path: '.ADMIN_THEME_PATH.'install/index.blade.php');
     return $view;
 
    }


    

    
    
}