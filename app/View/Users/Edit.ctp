 <!-- In your View -->


<?php echo $this->Form->create('User');
echo $this->Form->hidden('id', array('value' => $this->data['User']['id'])); ?>

<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">

            <div class="box-header with-border" >
            <h1><?php echo $this->Flash->render('positive') ?></h1>
           

              <h3 class="box-title" id='demo'>Edit Information of User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Usernames cannot be changed!</label>
                
                   <?php echo $this->Form->input('username',array('label'=>false,'class'=>'form-control','placeholder'=>'User name','readonly' => 'readonly')); ?>
                </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">Emil Id</label>
                  <?php echo $this->Form->input('email',array('label'=>false,'class'=>'form-control','placeholder'=>'Emil Id')); ?>                </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">New Password (leave empty if you do not want to change)</label>
                  <?php echo $this->Form->input('password_update',array('label'=>false,'class'=>'form-control','placeholder'=>'New Password','maxLength' => 255, 'type'=>'password','required' => 0)); ?> 
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm New password*</label>
                  <?php echo $this->Form->input('password_update',array('label'=>false,'class'=>'form-control','placeholder'=>'Confirm New Password','maxLength' => 255, 'type'=>'password','required' => 0)); ?>
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            <?php echo $this->Form->end(); ?>

          </div>
          <!-- /.box -->

          

        </div>