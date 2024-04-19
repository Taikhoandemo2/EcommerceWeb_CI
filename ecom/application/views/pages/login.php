<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
                        <?php
                            if ($this->session->flashdata('success'))
                            {
                                ?>
                                <div class = "alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                            <?php
                            }
                            elseif($this->session->flashdata('error')){
                                ?>
                                <div class = "alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                                <?php
                            }
                            ?>
						<form action="<?php echo base_url('login-customer')?>" method="POST">
							<input type="email" name="email" placeholder="Email" />
                            <?php echo form_error('email');?>
							<input type="password" name="password"  placeholder="Password" />
                            <?php echo form_error('password');?>

							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<div id="nameError" style="color: red;"></div>
						<form action="<?php echo base_url('dang-ky')?>" method="POST">
							<input type="text" name="name" id="nameInput" placeholder="Name" oninput="validateInput(this)"/>						
							<?php echo form_error('name')?>

							<input type="text" name="phone" placeholder="Phone" oninput="validateInput(this)"/>				
							<?php echo form_error('phone')?>

							<input type="text" name="address" placeholder="Address" oninput="validateInput(this)"/>
							<?php echo form_error('address')?>

							<input type="email" name="email"  placeholder="Email Address" />
							<?php echo form_error('email')?>
							

							<input type="password" name="password" placeholder="Password" oninput="validateInput(this)"/>
							<?php echo form_error('password')?>
							

							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->