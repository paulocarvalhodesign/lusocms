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
  <img class="luso_icon" src="<?php echo url('cms_core/public/global/img/icon.png');?>" width="25"/>
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
<?php $all_sets = DB::table('sets')->get();

     if($all_sets){
      foreach($all_sets as $set)

            $sets[$set->id] = $set->name;
        }else{
           $sets []= ''; 
     }?>





<ul class="cms_toolbar_options">
      <li><i class="icon-th-large icon-white"></i> 
        <?php echo HTML::link('admin', Lang::line('toolbar.dashboard')); ?>
      </li>
<?php if($user->canWrite()):?>
  <li>

        <i class="icon-pencil icon-white"></i>

        <?php echo HTML::link('pages/composer', Lang::line('toolbar.composer')); ?>
 </li>
 <?php endif;?> 
<?php if($user->isAdministrator()):?>
      <?php if(Config::get('edit_mode') == 'false' || Config::get('edit_mode') == ''):?>
      
      <li><i class="icon-pencil icon-white"></i> <?php echo HTML::link('edit/'.Config::get('page_id').'', Lang::line('toolbar.edit_mode'), array('class'=>'edit-trigger')); ?></li>

      <li>

        <i class="icon-certificate icon-white"></i>

        <?php echo HTML::link('pages', Lang::line('toolbar.page')); ?>
        <ul class="media_options">
           <li><i class="icon-certificate icon-white"></i> <?php echo HTML::link('pages/manage/'.Config::get('page_id').'', Lang::line('toolbar.page_properties')); ?></li>
           <li><i class="icon-plus-sign icon-white"></i><?php echo HTML::link('pages/new', Lang::line('toolbar.add_page')); ?></li>
        </ul>

      </li>

     

       <li><i class="icon-folder-open icon-white"></i>
      <?php echo HTML::link('files', Lang::line('toolbar.add_media')); ?>
      <ul class="media_options">
      <li>
        <a href="#" type="button" class="" onclick="$('#upload_modal').modal({backdrop: 'static'});"><i class="icon-plus-sign icon"></i> Upload</a>
      </li>
      <li>  
        <a href="#" type="button" class="" onclick="$('#multi_upload_modal').modal({backdrop: 'static'});">  <i class="icon-plus-sign icon"></i> Multi-files Upload </a>
      </li>
      </ul>
      </li>

     <?php elseif(Config::get('edit_mode') == 'true'):?>

      <li><i class="icon-pencil icon-white"></i> <?php echo HTML::link('edit/publish/'.Config::get('page_id').'', Lang::line('toolbar.publish'), array('class'=>'save-trigger')); ?></li>
      
      <li>

        <i class="icon-certificate icon-white"></i>

        <?php echo HTML::link('#', Lang::line('toolbar.page')); ?>
        <ul class="media_options">
           <li><i class="icon-certificate icon-white"></i> <?php echo HTML::link('pages/manage/'.Config::get('page_id').'', Lang::line('toolbar.page_properties')); ?></li>
           <li><i class="icon-plus icon-white"></i><?php echo HTML::link('pages/new', Lang::line('toolbar.add_page')); ?></li>
        </ul>

      </li>


      <li><i class="icon-folder-open icon-white"></i>
      <?php echo HTML::link('#', Lang::line('toolbar.add_media')); ?>
      <ul class="media_options">
      <li>
        <a href="#" type="button" class="" onclick="$('#upload_modal').modal({backdrop: 'static'});">Upload</a>
      </li>
      <li>  
        <a href="#" type="button" class="" onclick="$('#multi_upload_modal').modal({backdrop: 'static'});">  <i class="icon-plus-sign icon"></i> Multi-files Upload </a>
      </li>
  
      <?php endif;?>
    </ul>
  <?php endif;?> 
  </div>
  <div class="span2">
    <ul class="cms_toolbar_options_quit">
      <li><i class="icon-off icon-white"></i> <?php echo HTML::link('logout', Lang::line('toolbar.logout')); ?></li> 
      
    </ul>

  </div>

 <div class="modal hide" id="upload_modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Upload a new file:</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo  URL::to('files/upload') ;?>" id="upload_modal_form" enctype="multipart/form-data">
                        <label for="photo">Photo</label>
                        <input type="file" placeholder="Choose a file to upload" name="file" id="file" />
                        <label for="description">Title</label>
                        <input type="text" value="" name="title"/>
                        <label for="description">Description</label>
                        <textarea placeholder="Describe your file in a few sentences" name="description" id="description" class="span5"></textarea>
                        <label for="photo">Add files to existing set?</label>   
                        <input type="hidden" name="location" value="<?php echo Config::get('page_url');?>"/>
                        <?php foreach($sets as $key=>$value):?>

                         <?php 
                          $current[''] = 'Dont add to set';
                          $current[$value] = $value;
                        ?>

                        <?php endforeach;?>

                        <?php echo Form::select('set',$current);?>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    <button type="button" onclick="$('#upload_modal_form').submit();" class="btn btn-primary">Upload File</a>
                </div>
               </div>


               

<div class="modal hide" id="multi_upload_modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Upload multi-file:</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo URL::to('files/multi_upload') ;?>" id="multi_upload_modal_form" enctype="multipart/form-data">
                        <label for="photo">Zip file</label>
                        <input type="file" placeholder="Choose a file to upload" name="file" id="file" />
                        <input type="hidden" name="location" value="<?php echo Config::get('page_url');?>"/>
                        

                        <label for="photo">Add files to existing set?</label>   

                        <?php foreach($sets as $key=>$value):?>

                         <?php 
                          $current[''] = 'Dont add to set';
                          $current[$value] = $value;
                        ?>

                        <?php endforeach;?>

                        <?php echo Form::select('set',$current);?>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    <button type="button" onclick="$('#multi_upload_modal_form').submit();" class="btn btn-primary">Upload File</a>
                </div>
               </div>




  