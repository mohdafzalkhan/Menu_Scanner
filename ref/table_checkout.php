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
	
	$added_on=date('Y-m-d h:i:s');
	$sql="insert into order_master_table(user_id,name,mobile,total_price,order_status,payment_status,added_on) values('".$_SESSION['FOOD_USER_ID']."','$name','$mobile','$totalPrice','1','pending','$added_on')";
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

<div class="checkout-area pb-80 pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="checkout-wrapper">
                            <div id="faq" class="panel-group">
                                <div class="panel panel-default">
                                <h3>Enter Information</h3>
                                    <form method="post">
                                    <label>Enter Name</label>
                                        <input type="text" name="name" required>
                                        <label>Enter Mobile Number</label>
                                        <input type="text" name="mobile" required>
                                          <button type="submit" class="btn btn-primary btn-lg" name="place_order">SUBMIT</button>
                                    </form>
						   </div>
                        </div>
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
        </div>
        

<?php
include("footer.php");
?>