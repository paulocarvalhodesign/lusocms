<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 


 if(CMS_INSTALL){
    
     Route::get('setup',function(){
        
            return Redirect::to('/');
            
        
        });
   
    Route::get('setup/(:any)',function(){
       
           return Redirect::to('/');
           
       
    });
    

    $routes = DB::table('pages')->get(); 
    Route::get('/', array('uses'=>'home@index'));
    
    foreach($routes as $route)
    {


       Route::get($route->route, array('after' => 'compress','uses'=>'home@index'));
           

    }


    
     Route::get('login', array('uses'=>'login@index'));
     Route::post('login', array('before'=>'csrf','uses'=>'login@index'));
     Route::get('logout', function() {
         Auth::logout();
                 
         return Redirect::to('/');

    });

    // Do routes that required Authentication
    Route::group(array('before' => 'auth'), function()
    {

    

    // Dashboard Routes
    Route::get('admin', array('before' => 'subscriber','uses'=>'admin@index'));
    Route::get('admin/cms_upgrade_download', array('before' => 'subscriber','uses'=>'admin@cms_upgrade_download'));
    Route::get('admin/finish_upgrade', array('before' => 'subscriber','uses'=>'admin@finish_upgrade'));
    
    
    // Files Routes
    Route::get('files', array('before' => 'subscriber','uses'=>'files@index'));
    Route::get('files/sets', array('before' => 'subscriber','uses'=>'files@sets'));
    Route::post('files/sets', array('before' => 'subscriber','uses'=>'files@sets'));
    Route::get('files/manage_set/(:num)', array('before' => 'subscriber','uses'=>'files@sets'));
    Route::post('files/upload', array('before' => 'subscriber','uses'=>'files@upload'));
    Route::post('files/multi_upload', array('before' => 'subscriber','uses'=>'files@multi_upload'));
    Route::get('files/delete_file/(:num)',array('before' => 'subscriber','uses'=>'files@delete_file'));
    Route::get('files/delete_set/(:num)',array('before' => 'subscriber','uses'=>'files@delete_set'));
    Route::get('files/remove_from_set/(:num)',array('before' => 'subscriber','uses'=>'files@remove_from_set'));
    Route::post('files/save_properties',array('before' => 'subscriber','uses'=>'files@save_properties'));
    Route::post('files/add_to_set',array('before' => 'subscriber','uses'=>'files@add_to_set'));
    Route::post('files/reorder_set',array('before' => 'subscriber','uses'=>'files@reorder_set'));
   
   // Pages Routes
    Route::get('pages', array('before' => 'subscriber','uses'=>'pages@index'));
    Route::get('pages/new', array('before' => 'subscriber','uses'=>'pages@new'));
    Route::post('pages/new', array('before' => 'subscriber','uses'=>'pages@new'));
    Route::get('pages/composer', array('before' => 'subscriber','uses'=>'pages@composer'));
    Route::post('pages/composer', array('before' => 'subscriber','uses'=>'pages@composer'));
    Route::get('pages/composer_groups', array('before' => 'subscriber','uses'=>'pages@composer_groups'));
    Route::post('pages/composer_groups', array('before' => 'subscriber','uses'=>'pages@composer_groups'));
    Route::post('pages/update_page', array('before' => 'subscriber','uses'=>'pages@update_page'));
    Route::get('pages/attributes', array('before' => 'subscriber','uses'=>'pages@attributes'));
    Route::post('pages/save_page_atributes', array('before' => 'subscriber','uses'=>'pages@save_page_atributes'));
    Route::get('pages/manage/(:num)',array('before' => 'subscriber','uses'=>'pages@manage'));
    Route::get('pages/delete/(:num)',array('before' => 'subscriber','uses'=>'pages@delete'));
    Route::post('pages/add_attribute',array('before' => 'subscriber','uses'=>'pages@add_attribute'));
    Route::post('pages/edit_attribute/(:num)',array('before' => 'subscriber','uses'=>'pages@edit_attribute'));
    Route::get('pages/delete_attribute/(:num)', array('before' => 'subscriber','uses'=>'pages@delete_attribute'));
    Route::post('pages/order', array('before' => 'subscriber','uses'=>'pages@order'));
   
    // Blocks Routes
    Route::get('blocks', array('before' => 'subscriber','uses'=>'blocks@index'));
    Route::get('blocks/(:any)', array('before' => 'subscriber','uses'=>'blocks@index'));
    Route::get('editblock', array('before' => 'subscriber','uses'=>'editblock@index'));
    Route::get('moveblock', array('before' => 'subscriber','uses'=>'moveblock@index'));  
    Route::post('blocks/reorder',array('before' => 'subscriber','uses'=>'blocks@reorder'));

    // Route::group(array('before' => 'administrator'), function()
    // {
    // Settings Routes
    Route::get('settings', array('before' => 'administrator','before' => 'subscriber','uses'=>'settings@index'));
    Route::post('settings/maintenance', array('before' => 'administrator','before' => 'subscriber','uses'=>'settings@maintenance'));
    Route::post('settings/error_level', array('before' => 'administrator','before' => 'subscriber','uses'=>'settings@error_level'));
    Route::post('settings/analytics', array('before' => 'administrator','before' => 'subscriber','uses'=>'settings@analytics'));
    Route::post('settings/sitename', array('before' => 'administrator','before' => 'subscriber','uses'=>'settings@sitename'));
    Route::post('settings/language', array('before' => 'administrator','before' => 'subscriber','uses'=>'settings@language'));
    Route::post('settings/theme', array('before' => 'administrator','before' => 'subscriber','uses'=>'settings@theme'));
    Route::post('settings/theme_install', array('before' => 'administrator','before' => 'subscriber','uses'=>'settings@theme_install'));
    
    
     // Extensions Routes
    Route::get('extensions', array('before' => 'administrator','before' => 'subscriber','uses'=>'extensions@index'));
    
  

    Route::get('edit/(:num)',array('before' => 'subscriber','uses'=>'edit@index'));
    Route::get('edit/publish/(:num)',array('before' => 'subscriber','uses'=>'edit@publish'));

    

    Route::get('delete_block', function(){

        $block =  $_GET['block'];
        $id =  $_GET['id'];
        $page_id = $_GET['page_id'];
        $global =  $_GET['global'];
        $deleted_block = DB::table($block)->delete($id);

        if($global == 'true'){
                $reset = '0';
                $handle = substr_replace($block ,"",-1);
                $delete_from_page = DB::table('page_blocks')
                ->where_page_id_and_block_id_and_block_handle($reset, $id, $handle)
                ->delete();
        }else{
              $handle = substr_replace($block ,"",-1);
              $delete_from_page = DB::table('page_blocks')
              ->where_page_id_and_block_id_and_block_handle($page_id, $id, $handle)
              ->delete();
        }

        
        $page = Page::find($page_id);
        return Redirect::to($page->route);



  });

    // users Routes
    Route::post('users/update', array('uses'=>'users@update'));
    Route::get('users', array('uses'=>'users@index'));
    Route::post('users/new', array('before' => 'subscriber','uses'=>'users@new'));
    Route::get('users/delete/(:num)', array('before' => 'subscriber','uses'=>'users@delete'));
 

 });//end of auth group


Route::get('sitemap', function(){

    $sitemap = new Sitemap();

    // set item's url, date, priority, freq
    $sitemap->add(URL::to(), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
    $sitemap->add(URL::to('page'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');

    $pages = DB::table('pages')->where_exclude_from_sitemap('0')->order_by('order', 'desc')->get();
    foreach ($pages as $page)
    {
        $sitemap->add(URL::to($page->route), $page->updated_at, '0.9', 'monthly');
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('html');
    

});
     
}else{
    Route::get('/(:any)', function(){

      return Redirect::to('setup');

    });
    Route::get('setup',array('uses'=>'setup@index'));
    
    Route::post('setup',function(){

        $host = Input::get('host');
        $username = Input::get('username');
        $password = Input::get('password');
        $table = Input::get('table');
        $a ="'";

        $rules = array(
                        'host'  => 'required',
                        'username' => 'required',
                        'password' => 'required',
                        'table' => 'required',
                    );
        $input = Input::all();
        
        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
              $errors = $validation->errors->all('<p>:message</p>'); 
    
              $message ='<div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span class="error">';    

                  foreach($errors as $error)

                  $message .= $error;

                  $message .=' </span> </div>';



  

            Session::flash('message', $message);     
            return Redirect::to('setup');
        
        }else{

         
      
      

            if(@$conn = mysql_connect($host, $username, $password)) {
              

              $database_file = file_get_contents(path('app').'install/database.php');
              $new  = str_replace("%HOSTNAME%",$host,$database_file);
              $new  = str_replace("%USERNAME%",$username,$new);
              $new  = str_replace("%PASSWORD%",$password,$new);
              $new  = str_replace("%DATABASE%",$table,$new);


              File::put(path('root').'cms_config/config.php', $new);




               
           

            } else {
               

                $message = 'Wrong Credentials, get it right please :)';

                Session::flash('message', $message);     
                return Redirect::to('setup');
                
                }


        return Redirect::to('setup/user_setup');
      }
    });

    Route::get('setup/user_setup',function(){

     
       $view = View::make('path: '.ADMIN_THEME_PATH.'install/user.blade.php');

      return $view;

    });
    Route::post('setup/user_setup',function(){

        $nickname = Input::get('nickname');
        $username = Input::get('username');
        $password = Input::get('password');
        
        
        $a ="'";

         $rules = array(
                        'nickname'  => 'required',
                        'username' => 'required|email',
                        'password' => 'required',
                        
                    );
        $input = Input::all();
        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
              $errors = $validation->errors->all('<p>:message</p>'); 
    
              $message ='<div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span class="error">';    

                  foreach($errors as $error)

                  $message .= $error;

                  $message .=' </span> </div>';



  

            Session::flash('message', $message);     
        
        
        }else{


          

        $data[] = '<?php ';
                 $data[] ='$nickname='.$a.$nickname.$a.';';     
                 $data[] ='$username='.$a.$username.$a.';'; 
                 $data[] ='$password='.$a.$password.$a.';'; 
                
                
                File::put(path('root').'/cms_config/user.php', $data);   




       
      }  
       return Redirect::to('setup/app_setup');
    });
   
    Route::get('setup/app_setup',function(){

 
      $view = View::make('path: '.ADMIN_THEME_PATH.'install/app.blade.php');

      return $view;

    });
    
    Route::post('setup/install_cms',function(){
     
        $name = Input::get('name');
        $theme = 'default';
         $a ="'";

         $rules = array(
                        'name'  => 'required',
                        
                        
                    );
        $input = Input::all();
        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
              $errors = $validation->errors->all('<p>:message</p>'); 
    
              $message ='<div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span class="error">';    

                  foreach($errors as $error)

                  $message .= $error;

                  $message .=' </span> </div>';



  

            Session::flash('message', $message);     
            return Redirect::to('setup/error');
        
        }else{


        $data[] = '<?php ';
                 $data[] ='$name='.$a.$name.$a.';';     
                 $data[] ='$theme='.$a.$theme.$a.';'; 
               
                
                
                File::put(path('root').'cms_config/site_name.php', $data);   



       
           return Redirect::to('setup/done');
      
          
        }


           
     

    });
    
    Route::get('setup/done',function(){

      
      $view = View::make('path: '.ADMIN_THEME_PATH.'install/done.blade.php');

      return $view;

    });
    Route::get('setup/error',function(){

     
      $view = View::make('path: '.ADMIN_THEME_PATH.'install/app.blade.php');

      return $view;

    });

     Route::post('setup/done',function(){

                $verify[] = '<?php ';
                $verify[] ='$install=true;'; 
                File::put(path('root').'cms_config/verify.php', $verify);    

              Install::insert_db();


              include(path('root').'cms_config/user.php');   
              include(path('root').'cms_config/site.php');       
              include(path('root').'cms_config/site_name.php'); 

                
                
                
              

                DB::table('themes')->insert(array(
                  'name' => 'default',
                  'description' => 'Default theme',
                  'active' => '1'
                 )); 
                 DB::table('users')->insert(array(
                 
                  'username' => $username,
                  'nickname' => $nickname,
                  'password' => Hash::make($password)
                )); 

                
                $verify[] = ' ';
                File::put(path('root').'cms_config/site.php', $verify);
                File::put(path('root').'cms_config/site_name.php', $verify);
                File::put(path('root').'cms_config/user_details.php', $verify);



                return Redirect::to('/');

     });
    }

    
    
    
/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
  return Redirect::to('404');
});

Event::listen('500', function()
{
  return Redirect::to('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|   Route::filter('filter', function()
|   {
|     return 'Filtered!';
|   });
|
| Next, attach the filter to a route:
|
|   Router::register('GET /', array('before' => 'filter', function()
|   {
|     return 'Hello World!';
|   }));
|
*/



Route::filter('before', function()
{
    // Do stuff before every request to your application...
 require path('root').'cms_config/verify.php';
 if($install == 'true'){

      $settings = DB::table('settings')->get();
      foreach($settings as $setting)
      Config::set($setting->name, $setting->value);
        Config::set('application.language', Config::get('language'));


    } 
    $user = Auth::user();
    if(!empty($user)){
    $user_role = db::table('role_user')->where_role_id($user->id)->first(); 
    $permitions = Permitions::administrator($user_role->role_id);
    Config::set('permitions', $permitions); 
   }
  
    });


Route::filter('profiler', function()
{
   if (!Auth::guest()){
    Config::set('application.profiler', true);
   }
  
});
Route::filter('subscriber', function()
{
      $user = Auth::user();
      if(!Permitions::Administrator($user) && !Permitions::Author($user))  

        return Redirect::to('users');
  
});




Route::filter('compress', function( $response = null )

{
  
function sanitize_output($buffer)
{
    $search = array(
        '/\>[^\S ]+/s', //strip whitespaces after tags, except space
        '/[^\S ]+\</s', //strip whitespaces before tags, except space
        '/(\s)+/s'  // shorten multiple whitespace sequences
        );
    $replace = array(
        '>',
        '<',
        '\\1'
        );
    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}


if(!Auth::user()){
 if ( $response ) {

ob_start("sanitize_output");

 $response->content = sanitize_output($response->content);




 }
}



});

Route::filter('administrator', function()
{
  $user = Auth::user();
      if(!Permitions::Administrator($user))  

        return Redirect::to('admin');
});

Route::filter('after', function($response)
{
  
});

Route::filter('csrf', function()
{
  if (Request::forged()) return Response::error('500');
});




Route::filter('auth', function()
{

if (Auth::guest()) 
  return Redirect::to('login');



if (Auth::user()->isAdministrator()) 
   
    Config::set('application.profiler', true);
    Config::set('error.detail', true);
    Profiler::attach();
  
});


