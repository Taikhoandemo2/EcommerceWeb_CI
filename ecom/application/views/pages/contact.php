<div class="container">
   
    <div class="row">
        <div class="md-col-12 notfound">
            <!-- <img src="<?php echo base_url('frontend/images/404.jpg') ?>" alt="404notfound"> -->
            <!-- <h4>PAGE NOT FOUND!</h4> -->
            <h4><center> Contact us by Email. We'll contact you as soon as possible!  </center> </h4>
            
          
        <form action="<?php echo base_url('send-contact')  ?>" method="POST">
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
        <div class="form-group">
            <label for="exampleInputEmail1">Email address *</label>
            <input type="email" class="form-control" name="email" required id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Name *</label>
            <input type="text" class="form-control" name="name"  id="name" placeholder="...">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Phone Number *</label>
            <input type="text" class="form-control" name="phone" required id="phone" placeholder="...">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Address</label>
            <input type="text" class="form-control" name="address" required id="address" placeholder="...">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Note *</label>
            <textarea name="note" required id="note" cols="30" rows="5" resize="none" placeholder="Write note here!"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        </div>

    </div>
</div>