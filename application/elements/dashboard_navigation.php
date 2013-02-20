<?php  $user   = Auth::user(); ?>

<ul id="navigation" class="dashboard_navigation">

	<?php if($user->canCreate() == 'false'):?>

<li><a href=" <?php echo url('admin') ;?> "><i class="icon-th-large"></i> <?php echo Lang::line('toolbar.dashboard');?></a> </li>
  
     <li><a href=" <?php echo url('pages') ;?> "><i class="icon-file"></i> <?php echo Lang::line('toolbar.pages');?></a> </li>
 
     <li><a href=" <?php echo url('files') ;?> "><i class="icon-folder-close"></i> <?php echo Lang::line('toolbar.files');?></a> </li>
   
     <li><a href=" <?php echo url('users') ;?> "><i class="icon-user"></i> <?php echo Lang::line('toolbar.users');?></a> </li>

     <a class="frontend_btn tt" rel="tooltip" data-placement="top" data-original-title="<?php echo Lang::line('toolbar.frontend_bubble');?>" href="<?php echo url('/');?>"><i class="icon-globe icon"></i> <?php echo Lang::line('toolbar.frontend');?></a>



<?php else:?>


     <li><a href=" <?php echo url('admin') ;?> "><i class="icon-th-large"></i> <?php echo Lang::line('toolbar.dashboard');?></a> </li>
  
     <li><a href=" <?php echo url('pages') ;?> "><i class="icon-file"></i> <?php echo Lang::line('toolbar.pages');?></a> </li>
 
     <li><a href=" <?php echo url('files') ;?> "><i class="icon-folder-close"></i> <?php echo Lang::line('toolbar.files');?></a> </li>
   
     <li><a href=" <?php echo url('form/list') ;?> "><i class="icon-inbox"></i> <?php echo Lang::line('toolbar.forms');?></a> </li>
 
     <li><a href=" <?php echo url('users') ;?> "><i class="icon-user"></i> <?php echo Lang::line('toolbar.users');?></a> </li>
   
     <li><a href=" <?php echo url('settings') ;?> "><i class="icon-wrench"></i> <?php echo Lang::line('toolbar.settings');?></a> </li>
    
     <li><a href=" <?php echo url('extensions') ;?> "><i class="icon-th"></i> <?php echo Lang::line('toolbar.extensions');?></a> </li>
   
     <a class="frontend_btn tt" rel="tooltip" data-placement="top" data-original-title="<?php echo Lang::line('toolbar.frontend_bubble');?>" href="<?php echo url('/');?>"><i class="icon-globe icon"></i> <?php echo Lang::line('toolbar.frontend');?></a>

<?php endif;?>

</ul>
<script>
$(document).ready(function() {

  $(function(){
   
   var segment = url('1');
   var dash = '/';
  
   if(segment == '') { 
    var root = segment+dash;
    }else{
    var root = segment;
    }
    
    $('#navigation li  a[href*="' + root + '"]').attr('class', 'selected');
    $('#navigation li  a[href*="' + root + '"]').parent().attr('class', 'selected-path');
    $('#navigation li  a[href*="' + root + '"] i').addClass('icon-white');
    $('#navigation li  a ').hover(

         function () {
        $(this).find('i').addClass('icon-selected');
        
         },
        function () {

          $(this).find('i').removeClass('icon-selected').addClass('icon');
         }

      );
    

    });




  
   });
</script>