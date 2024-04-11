<div class ="container">
    <h1>Sign Up Admin Page</h1>
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


<form action="<?php echo base_url('register-insert')?>" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Username:</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username">
    <?php echo form_error('username');?>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address:</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <?php echo form_error('email');?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password:</label>
    <input type="password" name ="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    <?php echo form_error('password');?>
  </div>
  <a href="<?php echo base_url('login')?>" class="btn btn-default">Return Log in</a>
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>
</div>