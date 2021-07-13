<?php 
include('top.php');

if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
	if($type=='delete'){
		mysqli_query($con,"delete from order_master_table where id='$id'");
		redirect('table_order.php');
	}
	if($type=='active' || $type=='deactive'){
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update order_master_table set deliver_status='$status' where id='$id'");
		redirect('table_order.php');
	}

}

$sql="select * from order_master_table order by id desc";
$res=mysqli_query($con,$sql);

?>
  <div class="card">
            <div class="card-body">
                <h1 class="grid_title">Table Order Master</h1>
			  <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="10%">S.No #</th>
                            <th width="10%">user_id</th>
                            <th width="10%">Name</th>
							<th width="15%">Mobile</th>
							<th width="15%">total price</th>
							<th width="15%">Order Status</th>
                            <th width="15%">Payement Status</th>
                            <th width="20%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)>0){
						$i=1;
						while($row=mysqli_fetch_assoc($res)){
						?>
						<tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row['user_id']?><br/>
							<?php echo $row['name']?></td>
							<td><?php echo $row['mobile']?></td>
							<td><?php echo $row['total_price']?></td>
                            <td><?php echo $row['order_status']?></td>
                            <td><?php echo $row['payment_status']?></td>
                            <td><?php echo $row['deliver_status']?></td>
							<td>
								<?php
								if($row['deliver_status']==0){
								?>
								<a href="?id=<?php echo $row['id']?>&type=deactive"><label class="badge badge-danger hand_cursor">Delivered</label></a>
								<?php
								}else{
								?>
								<a href="?id=<?php echo $row['id']?>&type=active"><label class="badge badge-info hand_cursor">On the way</label></a>
								<?php
								}
								?>
								&nbsp;
								<a href="?id=<?php echo $row['id']?>&type=delete"><label class="badge badge-danger delete_red hand_cursor">Delete</label></a>
							</td>
                           
                        </tr>
                        <?php 
						$i++;
						} } else { ?>
						<tr>
							<td colspan="5">No data found</td>
						</tr>
						<?php } ?>
                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
          </div>
        
<?php include('footer.php');?>