<?php
    include 'inc/header.php';
        $login = Session::get("customerLogin");
        if($login == true){
            header("location:order.php");
}
?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
    $customerLogin = $customer->customerLogin($_POST);
}
?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
             <?php
             if(isset($customerLogin)){
                 echo $customerLogin;
             }
             ?>
        	<form action="" method="post">
                	<input name="customerEmail" type="text"  placeholder="your email">
                    <input name="password" type="password" placeholder="your pasword" >
                <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>

            </form>
                    </div>


        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
                $customerRegistration = $customer->customerRegistration($_POST);
            }
        ?>

    	<div class="register_account">
    		<h3>Register New Account</h3>
            <?php
                if(isset($customerRegistration)){
                    echo $customerRegistration;
                }
            ?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Your Name" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="your city">
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="your zip code">
							</div>
							<div>
								<input type="text" name="email" placeholder="your email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="your adress">
						</div>
		    		<div>
                        <input type="text" name="country" placeholder="your country">

                    </div>
	
		           <div>
		          <input type="text" name="phone" placeholder="your phone">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="your password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="submit">Create Account</button></div></div>

		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>