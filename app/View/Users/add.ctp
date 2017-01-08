<p class="login-box-msg"><b>Register a new membership</b></p>

    <?php echo $this->Form->create('User');?>
    <fieldset>
      <div class="form-group has-feedback">
        <?php echo $this->Form->input('username',array('label'=>false,'class'=>'form-control','placeholder'=>'User name')); ?>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
         <?php echo $this->Form->input('email',array('label'=>false,'class'=>'form-control','placeholder'=>'Email Id')); ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo $this->Form->input('password',array('label'=>false,'class'=>'form-control','placeholder'=>'Password')); ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
       <?php echo $this->Form->input('password',array('label'=>false,'class'=>'form-control','placeholder'=>'Conform Password')); ?>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
     

      <div class="row">
       
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>

    <?php
echo $this->Html->image("login-facebook.jpg", array(
    "alt" => "Signin with Facebook",
    'url' => array('action'=>'social_login', 'Facebook')
));
 
echo $this->Html->image("login-google.jpg", array(
    "alt" => "Signin with Google",
    'url' => array('action'=>'social_login', 'Google')
));
 
echo $this->Html->image("login-twitter.jpg", array(
    "alt" => "Signin with Twitter",
    'url' => array('action'=>'social_login', 'Twitter')
));
echo $this->Html->image("", array(
    "alt" => "Signin with Microsoft",
    'url' => array('action'=>'social_login', 'Microsoft')
));
?>



    <a href="<?php echo  $this->base; ?>/Users/login" class="text-center">I already have a membership</a>