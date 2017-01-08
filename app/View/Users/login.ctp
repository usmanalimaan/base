<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Session->flash(); ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<p class="login-box-msg"><b>Please enter your username and password</b></p>
<fieldset>
  
 <div class="form-group has-feedback">
   <?php echo $this->Form->input('username',array('label'=>false,'class'=>'form-control','placeholder'=>'User name')); ?>
   <span class="glyphicon glyphicon-user form-control-feedback"></span>
 </div>
 
 <div class="form-group has-feedback">
  <?php echo $this->Form->input('password',array('label'=>false,'class'=>'form-control','placeholder'=>'Password')); ?>
  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div> 

<!-- <div class="g-recaptcha" data-sitekey="6LeF1QcUAAAAAAXf6L7HcRnqJXUYQ4r-Y2IGZT8M"></div> -->


</fieldset>
<div class="row">
  <div class="col-xs-4">
    <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
    <!--  -->
  </div>
</br>
</div>

<?php
echo $this->Html->link( "Register New Accout",   array('action'=>'add') ); 
?>
<br>
<?php
echo $this->Html->link( "Forget Password", array('action'=>'forgot_password') ); 
?>














