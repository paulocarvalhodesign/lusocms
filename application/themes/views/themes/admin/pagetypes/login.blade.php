<!doctype html>
<html class="signup sign_up" lang="{{Config::get('application.language')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Login</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
   <link href='http://fonts.googleapis.com/css?family=Quantico:400,700' rel='stylesheet' type='text/css'>
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/login.css') }}
 
</head>

<body class="login_page sign_up">
    <div class="container">
      
      <div class="row-fluid"> 
        <div class="span12">
        <div class="span4"></div>  
        <div class="span4">
          <center><h3 class="cms_logo"><img width="25" src="<?php echo url('cms_core/lusocms/public/global/img/icon.png');?>"> LUSO CMS</h3></center>
        </div>  
         <div class="span4"></div>  
        </div>
       
        <div class="span12">
        <div class="span4"></div>     
        <div class="span4">
        <div class="box">
          
       
        {{ Form::open('login') }}
    
     @if (Session::has('login_errors'))
  <div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <span class="error">Username or password incorrect.</span>
</div>
    @endif
    {{ Form::token(); }}
    <!-- username field -->
    <p>{{ Form::label('username', 'Username') }}</p>
    <p>{{ Form::text('username') }}</p>
    <!-- password field -->
    <p>{{ Form::label('password', 'Password') }}</p>
    <p>{{ Form::password('password') }}</p>

     <p class="remember_me">
        <label>{{ Form::checkbox('remember') }}keep me signed in ?</label>
    </p>
   

    <!-- submit button -->
    <p>{{ Form::submit('Login', $attributes = array('class' => 'btn')) }}</p>
    {{ Form::close() }}

         </div>
         <br/>
         
           {{  Elements::get('admin_footer') }}
        </div>
        <div class="span4"></div>  
       </div>
        </div>  
    </div>



  {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }}  
  {{ HTML::script('themes/admin/js/app.js') }} 


  
</body>
</html>
