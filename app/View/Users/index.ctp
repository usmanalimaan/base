<div class="box">
        <div class="box-header">
              <h3 class="box-title">Users</h3>
            </div>
            <?php echo $this->Session->flash(); ?>
            <!-- /.box-header -->
                <div class="box-body">
                  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                    <div class="col-sm-6">
                      
                  </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Username</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">E-Mail</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Created</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Last Update</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Role</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Status</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                   
                   <?php $count=0; ?>
        <?php foreach($users as $user): ?>                
        <?php $count ++;?>
        <?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
        <?php endif; ?>
            <!-- <td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?></td> -->
            <td><?php echo $this->Html->link( $user['User']['username']  ,   array('action'=>'edit', $user['User']['id']),array('escape' => false) );?></td>
            <td style="text-align: center;"><?php echo $user['User']['email']; ?></td>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['modified']); ?></td>
            <td style="text-align: center;"><?php echo $user['User']['role']; ?></td>
            <td style="text-align: center;"><?php echo $user['User']['status']; ?></td>
            <td >
            <?php echo $this->Html->link(    "Edit",   array('action'=>'edit', $user['User']['id']) ); ?> | 
            <?php
                if( $user['User']['status'] != 0){ 
                    echo $this->Html->link(    "Delete", array('action'=>'delete', $user['User']['id']));}else{
                    echo $this->Html->link(    "Re-Activate", array('action'=>'activate', $user['User']['id']));
                    }
            ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php unset($user); ?>
        </tbody>
                    <!-- <tfoot>
                    <tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>
                    </tfoot> -->
        </table>

        </div>
        </div>
           <!--  <div class="row">
                <div class="col-sm-5">
                    <div style="width:100px;background:white" onmouseover="this.style.background='lightgray';" onmouseout="this.style.background='white';">
                    <?php echo $this->Html->link( "Add A New User.",   array('action'=>'add'),array('escape' => false) ); ?>
                    </div>
                </div>

                </div> -->
                  <!-- <div class="row">
                <div class="col-sm-5">
                    <div style="width:100px;background:white" onmouseover="this.style.background='lightgray';" onmouseout="this.style.background='white';">
                    <?php echo $this->Html->link( "Logout",   array('action'=>'logout') ); ?>
                    </div>
                </div>
                
                </div> -->
            </div>
            </div>
            <!-- /.box-body -->
          </div>