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
 
<div class="span10">
  <img class="luso_icon" src="<?php echo url('public/global/img/icon.png');?>" width="25"/>
<div class="user_img_toolbar">  
<?php
 $user   = Auth::user(); 
 $avatar = User::showAvatar($user, '40', '40');
?>
<span>
<?php echo Lang::line('toolbar.logged_in');?><br/>
<?php echo $user->nickname;?>
</span>
 &nbsp;
<?php echo $avatar;?>
</div>

<?php if($user->canCreate() == 'true'):?>



<ul class="cms_toolbar_options">
      <li><i class="icon-th-large icon-white"></i> <?php echo HTML::link('admin', Lang::line('toolbar.dashboard')); ?></li>

      <?php if(Config::get('edit_mode') == 'false' || Config::get('edit_mode') == ''):?>
      
      <li><i class="icon-pencil icon-white"></i> <?php echo HTML::link('edit/'.Config::get('page_id').'', Lang::line('toolbar.edit_mode'), array('class'=>'edit-trigger')); ?></li>

      <li><i class="icon-certificate icon-white"></i><?php echo HTML::link('pages/manage/'.Config::get('page_id').'', Lang::line('toolbar.page_properties')); ?></li>

      <li><i class="icon-plus icon-white"></i><?php echo HTML::link('pages/new', Lang::line('toolbar.add_page')); ?></li>

     <?php elseif(Config::get('edit_mode') == 'true'):?>

      <li><i class="icon-pencil icon-white"></i> <?php echo HTML::link('edit/publish/'.Config::get('page_id').'', Lang::line('toolbar.publish'), array('class'=>'save-trigger')); ?></li>
      
      <li><i class="icon-certificate icon-white"></i><?php echo HTML::link('pages/manage/'.Config::get('page_id').'', Lang::line('toolbar.page_properties')); ?></li>


       <li><i class="icon-plus icon-white"></i><?php echo HTML::link('pages/new', Lang::line('toolbar.add_page')); ?></li>
  
      <?php endif;?>
    </ul>
  <?php endif;?> 
  </div>
  <div class="span2">
    <ul class="cms_toolbar_options_quit">
      <li><i class="icon-off icon-white"></i> <?php echo HTML::link('logout', Lang::line('toolbar.logout')); ?></li> 
      
    </ul>

  </div>




  