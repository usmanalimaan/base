<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Session->flash(); ?>
<p class="login-box-msg"><b>Please enter your username</b></p>
<fieldset>
  
 <div class="form-group has-feedback">
   <?php echo $this->Form->input('username',array('label'=>false,'class'=>'form-control','placeholder'=>'User name')); ?>
   <span class="glyphicon glyphicon-user form-control-feedback" id="someresponce"></span>
 </div>
</fieldset>
<div class="row">
  <div class="col-xs-6">
    <button type="submit" class="btn btn-primary btn-block btn-flat">Recover password</button>
  </div>
</br>
</div>
