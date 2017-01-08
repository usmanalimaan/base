<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Session->flash(); ?>
<p class="login-box-msg"><b>Please enter your New Password</b></p>
<fieldset>
  
 <div class="form-group has-feedback">
   <?php echo $this->Form->input('password',array('label'=>false,'class'=>'form-control','placeholder'=>'New Password')); ?>
   <!-- <?php //echo $this->Form->input('password_confirm',array('label'=>false,'class'=>'form-control','placeholder'=>'Conform New Password')); ?> -->
   <?php echo $this->Form->input('reset_password_token',array('label'=>false,'class'=>'form-control','placeholder'=>'Token','hidden'=>'true')); ?>
   <!-- <input type="hidden" name="$data[User][reset_password_token]" value="<?php echo $id; ?>"> -->
   <span class="glyphicon glyphicon-user form-control-feedback" id="someresponce"></span>
 </div>

</fieldset>
<div class="row">
  <div class="col-xs-6">
    <button type="submit" class="btn btn-primary btn-block btn-flat">Update password</button>
  </div>
</br>
</div>
