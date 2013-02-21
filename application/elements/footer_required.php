<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */
?>
<?php Session::get('message') ;?>

<?php if(Auth::check() == true):?>
<div class="cms_toolbar hidden-phone">

<div class="content-fluid">
  <div class="row-fluid">
  <div class="span12">  
<?php  Elements::get('toolbar');?>
  </div>
  </div>
</div>

</div>

<script>
  


$('.delete').click(function(event) {
    event.preventDefault();
    var r=confirm("Are you sure you want to delete?");
    if (r==true)   {  
       window.location = $(this).attr('href');
    }

});
</script>

<?php endif;?>



<?php include(path('root').'cms_config/analytics_tracking_code.php');?> 