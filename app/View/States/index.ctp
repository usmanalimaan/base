

<div class="box">
        <div class="box-header">
              <h3 class="box-title">States</h3>
            </div>
             <div class="input-group-addon" style="width:50px;text-align: center;margin:5px;">
                    
                    <a href="<?php echo $this->base;?>/States/add" ><i class="fa fa-plus"></i>  Add State</a>
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

    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
              <tr role="row" class="odd">

                            <th class="sorting_asc" style="width: 50px;">Id</th>
                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 100px;">Country Name</th>
                            <th style="width:100px"> State Name</th>
                            <th  style="width:100px">Actions</th>



              </tr>

              <tr role="row" class="even">
                            <?php foreach($states as$state): ?>

                            <td> <?php echo $state [ 'State'] ['id'];?></td>
                            <td  ><?php echo $state['Country'] ['name'] ; ?></td>
                            <td><?php echo $state [ 'State'] ['name'] ; ?></td>
                            <td>
                            <div class="input-group-addon" style="width:50px;text-align: center;margin:5px;">

                             <a href="<?php echo $this->base;?>/States/edit/<?php echo $state['State']['id']?>" ><i class="fa fa-wrench"></i> </a>
                             
                             </div>

                              <div class="input-group-addon" style="width:50px;text-align: center;margin:5px;">
                             
                             <a href="<?php echo $this->base;?>/States/delete/<?php echo $state['State']['id']?>"><i class="fa fa-trash"></i> </a>
                             </div>
                             </td>

              </tr>

                              <?php endforeach; ?>
    </table>

<!-- <?php echo $this->html->link($user ['User'] ['user_name'],  array('action'=>'view',$user [ 'User'] ['id'])   ) ?> -->
      </div>
        </div>
           <!--  <div class="row">
                <div class="col-sm-5">
                    </div> -->
            </div>
            </div>
            <!-- /.box-body -->
          </div>

