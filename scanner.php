<?php
include ("header.php");
$cartArr=getUserFullCart();
if(count($cartArr)>0){
	
	
}else{
	redirect(FRONT_SITE_PATH.'shop');
}

$userArr=getUserDetailsByid();
if(isset($_POST['place_order'])){
	$name=get_safe_value($_POST['name']);
	$mobile=get_safe_value($_POST['mobile']);
	$table_number=get_safe_value($_POST['table_number']);
	$added_on=date('Y-m-d h:i:s');
	$sql="insert into order_master_table(user_id,name,mobile,total_price,order_status,payment_status,table_number,added_on) values('".$_SESSION['FOOD_USER_ID']."','$name','$mobile','$totalPrice','1','pending','$table_number','$added_on')";
	mysqli_query($con,$sql);
	$insert_id=mysqli_insert_id($con);
	$_SESSION['ORDER_ID']=$insert_id;
	foreach($cartArr as $key=>$val){
		mysqli_query($con,"insert into order_detail(order_id,dish_details_id,price,qty) values('$insert_id','$key','".$val['price']."','".$val['qty']."')");
	}
	emptyCart();
	redirect(FRONT_SITE_PATH.'success');
	
}
?>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
        <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5" ><br>
                        <br><br>
                        <h4 style="padding-left:150px;margin:0;padding-bottom:0;">Scan QR CODE</h4>
                        <video id="preview" width="100%" height="50%"></video>
                    </div>
                    <div class="col-lg-4">

                </div>
                    <div class="panel panel-default">
                                <h3>Enter Information</h3>
                                    <form method="post">
                                    <label>Enter Name</label>
                                        <input type="text" name="name" required>
                                        <label>Enter Mobile Number</label>  
                                        <input type="text" name="mobile" required>
                                        <label>Enter Table Number:</label>
                                        <input type="tex" name="table_number" id="table" required> 
                                          <button type="submit" class="btn btn-primary btn-lg" name="place_order">SUBMIT</button>
                                    </form>
						   </div>
                    <div class="col-lg-3">
                        <div class="checkout-progress">
                            <div class="shopping-cart-content-box">
								<h4 class="checkout_title">Cart Details</h4>
								<ul>
									<?php foreach($cartArr as $key=>$list){ ?>
									<li class="single-shopping-cart">
										<div class="shopping-cart-img">
											<a href="#"><img alt="" src="<?php echo SITE_DISH_IMAGE.$list['image']?>"></a>
										</div>
										<div class="shopping-cart-title">
											<h4><a href="#">Phantom Remote </a></h4>
											<h6>Qty: <?php echo $list['qty']?></h6>
											<span><?php echo 
														$list['qty']*$list['price'];?> Rs</span>
										</div>
										
									</li>
									<?php } ?>
								</ul>
								<div class="shopping-cart-total">
									<h4>Total : <span class="shop-total"><?php echo $totalPrice?> Rs</span></h4>
								</div>
								
							</div>
                        </div>
                    </div>
            </div>
            
</div>
  

        <script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview'),mirror: false});
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
               } else{
                   alert('No cameras found');
               }

           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('table').value=c;
           });
</script>
<?php
include("footer.php");
?>