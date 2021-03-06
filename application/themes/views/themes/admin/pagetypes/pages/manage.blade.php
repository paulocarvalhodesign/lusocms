<!doctype html>
<html lang="{{Config::get('application.language')}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Manage Page</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
   <link href='http://fonts.googleapis.com/css?family=Quantico:400,700' rel='stylesheet' type='text/css'>
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::style('jquery-ui/css/lusocms-theme/jquery-ui-1.9.0.custom.min.css') }} 
    {{ HTML::style('global/css/timepicker.css') }}
    {{ HTML::script('jquery-ui/js/jquery-ui-1.9.0.custom.min.js') }} 
    {{ HTML::script('global/js/jquery-ui-timepicker-addon.js') }}
    {{ HTML::script('global/js/jquery-ui-sliderAccess.js') }}
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/dashboard.css') }}
</head>
{{ Session::get('info') }}
<body class="dashboard">
  <div class="dashboard-wrapper">
    <div class="container">
      <div class="header_dashboard">
      <div class="row-fluid">
        {{  Elements::get('dashboard_elements') }}
        <div class="span12">

        {{  Elements::get('dashboard_navigation') }}
       
      </div>

      </div>
    </div>
 <div class="row-fluid">
<div class="span12 main">
<div class="ajax-message"></div>
              <br/>
              <div class="block header_block">
                <h4><i class="icon-file"></i>Managing ::  {{$page->title}}

            <ul class="inner_navigation">
               <li>
                  
                  <a href="{{url($page->route)}}"><i class="icon icon-globe"></i>  Visit Page</a>

              </li>
               
               <li>
                
                <a class="" href="{{url('pages')}}"><i class="icon icon-arrow-left"></i>  Back</a>
              </li>
              
            </ul> 


                </h4>  
              </div>
               <br/>
              <div class="block">
            
              <div class="row-fluid">
               <div class="span12">   
                 {{Form::open('pages/update_page')}}
                
              <div class="span4">
                 
               {{Form::hidden('id',$page->id)}}
               <p>
              <label><span>Page Title:</span></label>
              {{ Form::text('title', $page->title, array('id'=>'title')) }}
              </p>
              <p>
              <label><span>Page Tags</span></label>
              {{Form::text('tags',$page->tags)}}
              </p>
               <p>
              <label><span>Page Keywords</span></label>
              {{Form::text('keywords', $page->keywords)}}
              </p>
              <p>
              <label><span>Page Owner</span></label>
              
              {{Form::select('owner', $users, $page->owner)}}
              </p>
              </div>


              <div class="span4">
               <p>
              <label><span>Page URL:</span></label>
              {{ Form::text('url', $page->url, array('id'=>'url')) }}
             </p>
             <label><span>Exclude from sitemap</span></label>
             <?php
              if($page->exclude_from_sitemap == '1')
              $opts = array('1'=>'TRUE', '0'=>'FALSE');
              else
              $opts = array('0'=>'FALSE', '1'=>'TRUE');  
              ?>
              {{ Form::select('exclude_from_sitemap', $opts) }} 
              </p>  
               <p> 
               
               <label><span>Exclude from Navigation</span></label>
               <?php 
              if($page->exclude_from_navigation == '1')
              $opts = array('1'=>'TRUE', '0'=>'FALSE');
              else
              $opts = array('0'=>'FALSE', '1'=>'TRUE');  
              ?>
              {{ Form::select('exclude_from_navigation', $opts) }}
               </p>
             </div>

            <div class="span4">
              <p>
              <label><span>PageType:</span></label>
              {{ Form::select('pagetype', $pagetypes, $page->pagetype ) }}
             </p>

              <p>
               <label><span>Parent:</span></label>
              <?php $parent = Page::where_parent_id($page->parent_id)->only('name');?>
              {{ Form::select('parent_id', $parents, $parent) }}
             </p>  
              
              <p>
               <label><span>Exclude from pagelist</span></label>
                <?php 
              if($page->exclude_from_pagelist == '1')
              $opts = array('1'=>'TRUE', '0'=>'FALSE');
              else
              $opts = array('0'=>'FALSE', '1'=>'TRUE');  
              ?>
              {{ Form::select('exclude_from_pagelist', $opts) }}
               </p>
            </div>

                <div class="row-fluid"> 
              <div class="span12">  
              <div class="span8">
              
              
                 
             <p>
              
              <label><span>Description:</span></label>
              {{ Form::textarea('description', $page->description, array('class'=>'description', 'width'=>'100%')) }}
            </p>

               </div>
                <div class="span4">
          
              
              <br/>
              <br/>
              <br/>
              <br/>

            

            {{Form::submit('Save Page', array('class'=>'btn'))}}

          
            {{ Form::close() }}
            </div>
      </div>
</div>

               
              
              
           
           
          </div>
        </div>
      </div>
      <br/>

        <div class="block">
          <div class="span12"> 

           <div class="row-fluid">
  
            <h4>Page Attributes</h4>

            @if(empty($attributes))  
              <h5>No attributes available...</h5> 
              @else
                @foreach($attributes as $attribute)
                
                  
                   {{Form::open('pages/save_page_atributes')}}



                   {{Form::hidden('type',$attribute->type)}}

                   {{Form::hidden('page_id',$page->id)}}

                   {{Form::hidden('name',$attribute->name)}}
                  
                  <label>Attribute Name: {{$attribute->name}}</label>
                    @if($attribute->type == 'text')
                    <div class="well">
                    <?php 
                    $text = DB::table('text_attribute')->where_page_id_and_name($page->id,$attribute->name)->first();
                    if(empty($text))
                      {
                        $at = '';
                        $id = '';
                      }
                      else
                      {
                        $id = $text->id;
                        $at = $text->content;
                      } 
                    ?>
                    {{Form::text('content', $at)}}
                    {{Form::hidden('id', $id)}}
                    {{Form::submit('save', array('class'=>'btn'))}}
                    {{Form::close()}}
                    </div>

                    @elseif($attribute->type == 'image')
                    <div class="well">
                  <?php 

                   $img = DB::table('image_attribute')->where_page_id_and_name($page->id,$attribute->name)->first(); ?>

                    @if(!empty($img))
                     
                      
                      <?php $i = DB::table('files')->where_id($img->file_id)->first();?>
                      {{Form::hidden('id', $img->id)}}
                     <div class="attributes-holder">
                      <div id="field-{{$attribute->id}}"> {{Form::hidden('file_id',$i->thumb_location)}}</div> 
                      <div id="holder-{{$attribute->id}}"> <img src='{{url($i->thumb_location)}}'/></div> 
                      <center>
                        <a class="btn image_submit"  id="imageblockmedia-selector-{{$attribute->id}}">Select File</a>
                      </center>
                     </div>
                      <br/> 
                    @else
                      <?php $id = '0';?>
                     {{Form::hidden('id', $id)}}
                     <div class="attributes-holder">
                      <div id="field-{{$attribute->id}}"></div> 
                      <div id="holder-{{$attribute->id}}"></div> 
                      <center>
                        <a class="btn image_submit" id="imageblockmedia-selector-{{$attribute->id}}">Select File</a>
                      </center>
                    </div>
                  
                  
                    @endif
                    {{Form::submit('save', array('class'=>'btn'))}}
                    {{Form::close()}}
                   </div>
                    @elseif($attribute->type == 'date')
                    <div class="well">
                    <?php 
                    $text = DB::table('date_attribute')->where_page_id_and_name($page->id,$attribute->name)->first();
                    if(empty($text))
                      {
                        $at = '';
                        $id = '';
                      }
                      else
                      {
                        $id = $text->id;
                        $at = $text->content;
                      } 
                    ?>
                    {{Form::text('content', $at, array('class'=>'datepicker'))}}
                    {{Form::hidden('id', $id)}}

                     <script>
                      $(function() {
                      $( ".datepicker" ).datetimepicker();
                      });
                      </script>
                    
                    {{Form::submit('save', array('class'=>'btn'))}}
                    {{Form::close()}}
                   </div>

                    @endif
                  <br/> 
                  
               <br/> 
             
                @endforeach
              @endif

            
            
            </div>

        </div>
      </div>
      <br/>
   </div>




<div id="imageblockimages">
 <button class="btn btn-primary"  id="imageblock_close_image_manager">Close</button>
 <ul class="filemanager" id="imageblockuItem" >
<?php foreach($files as $file):?>

<li>
  <p>
  
  
                       <img src='{{url($file->thumb_location)}}'/>
                        
                        <span><?php echo $file->thumb_location;?></span>
                          
  </p>
</li>

<?php endforeach;?>
</ul>
</div>
</div>

<div class="header_dashboard">
<div class="row-fluid">
<div class="span12">
<div class="span4"></div>
<div class="span4">
{{  Elements::get('admin_footer') }}
</div>
<div class="span4"></div>
</div>
</div>
</div>  

{{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 

    
<script type="text/javascript">
                 

            $(document).ready(function () {
                      
               @if(!empty($attributes))  
             
           
                @foreach($attributes as $attribute) 
                  
                   $('#imageblockuItem p').click(function(){
                    
                    var $this = $(this);
                    
                    var test{{$attribute->id}} = $.trim($this.text());


                    $('#field-{{$attribute->id}}').html('<input type="hidden" value="'+test{{$attribute->id}}+'" name="file_id" >');
                    $('#holder-{{$attribute->id}}').html('<img class="image_preview" src="{{url()}}'+test{{$attribute->id}}+'"/>');
                    $('#imageblockimages').hide();
                    $('#imageblockmedia-selector-{{$attribute->id}}').show();
                    });   

                   
                    $("#imageblock_close_image_manager").click(function () {
                  
                    $('#imageblockimages').hide();
                    
                    $('#imageblockmedia-selector-{{$attribute->id}}').show();



                    });   

                    $("#imageblockmedia-selector-{{$attribute->id}}").click(function (event) {
                    
                    event.preventDefault();

                    $('#imageblockimages').show();
                    
                    $('#imageblockmedia-selector-{{$attribute->id}}').hide();



                    });   

                @endforeach    
                
                @endif


                  });

</script>

    
</body>
</html>
