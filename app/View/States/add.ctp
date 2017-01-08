<?php echo $this->Form->create('State');?>

<div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">

            <div class="box-header with-border" >
            <h1><?php echo $this->Flash->render('positive') ?></h1>
           

              <h3 class="box-title" id='demo'>Add A New State</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Country Name</label>
                
                   <?php echo $this->Form->input('State.country_id',array('type'=>'select','options'=>$id,'class'=>'form-control','label'=>false)); ?>
                </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">State Name</label>
                  <?php echo $this->Form->input('name',array('label'=>false,'class'=>'form-control','placeholder'=>'State Name')); ?>               
                   </div>
                 
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add State</button>
              </div>
            <?php echo $this->Form->end(); ?>

          </div>
          <!-- /.box -->

          

</div>
