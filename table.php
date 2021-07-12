<?php
include ("header.php");
$cartArr=getUserFullCart();
if(count($cartArr)>0){
	
	
}else{
	redirect(FRONT_SITE_PATH.'shop');
}

if(isset($_SESSION['FOOD_USER_ID'])){
	$is_show='';
	$box_id='';
	$final_show='show';
	$final_box_id='payment-2';
}else{
	$is_show='show';
	$box_id='payment-1';
	$final_show='';
	$final_box_id='';
}
$userArr=getUserDetailsByid();
if(isset($_POST['place_order'])){
	$checkout_name=get_safe_value($_POST['checkout_name']);
	$checkout_email=get_safe_value($_POST['checkout_email']);
	$checkout_mobile=get_safe_value($_POST['checkout_mobile']);
	$checkout_zip=get_safe_value($_POST['checkout_zip']);
	$checkout_address=get_safe_value($_POST['checkout_address']);
	$payment_type=get_safe_value($_POST['payment_type']);
	
	$added_on=date('Y-m-d h:i:s');
	$sql="insert into order_master(user_id,name,email,mobile,address,zipcode,total_price,order_status,payment_status,added_on) values('".$_SESSION['FOOD_USER_ID']."','$checkout_name','$checkout_email','$checkout_mobile','$checkout_address','$checkout_zip','$totalPrice','1','pending','$added_on')";
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
<div class="sample">
     <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <h3>Enter Table Number:</h3>
                    </div>
         </div>
    </div>
</div>

<?php
include("footer.php");
?>