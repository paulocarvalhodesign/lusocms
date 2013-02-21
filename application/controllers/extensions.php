<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Extensions_Controller extends Dashboard_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Admin Controller 
     |--------------------------------------------------------------------------
     |
     */


    public $restful = true;

   
    

    /*
     |--------------------------------------------------------------------------
     | The Admin Dashboard with analytics 
     |--------------------------------------------------------------------------
     |
     */
     public function __construct(){

        $user = Auth::user();
        $user_role = db::table('role_user')->where_role_id($user->id)->first(); 
        $this->permitions = Permitions::administrator($user_role->role_id);
        Config::set('permitions', $this->permitions); 
        $settings = DB::table('settings')->get();
        foreach($settings as $setting)
        Config::set($setting->name, $setting->value);
        Config::set('application.language', Config::get('language'));
     }

    public function get_index() {
      
    
    
      
    if(!$this->permitions){

    Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">You dont haver suficient permitions to access that page.!</span>
                  </div>



        ');
    
      return Redirect::to('admin');
        }
    else{
    
      $blocks = Block::all();
      $view = View::make('path: '.ADMIN_THEME_PATH.'extensions.blade.php')
        
        ->with('user',Auth::user())
        ->with('blocks', $blocks);
       

      return $view;
    }
    }

    
        
}