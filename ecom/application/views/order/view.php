<div class="cointaner">
    <div class="card">
        <div class="card-header">
             List Order
        </div>
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
        <div class="card-body">

        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Order Code</th>
            <th scope="col">Product Name</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">SubTotal</th>
   
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($order_details as $key => $ord) {
            ?>
            <tr>
            <th scope="row"><?php echo $key?></th>
            <td><?php echo $ord->order_code?></td>
            <td><?php echo $ord->title?></td>
            <td><img src="<?php echo base_url('uploads/product/'.$ord->image)  ?>" width="150" height="150"></td>
            <td><?php echo number_format( $ord->price,0,',','.')?></td>
            <td><?php echo $ord->qty?></td>
            <td>
                <?php
                echo number_format($ord->qty * $ord->price,0,',','.');
                ?>
            </td>
            <td>
                <a onclick="return confirm('Are you sure want to delete this category?')" href="<?php echo base_url('order/delete/'.$ord->order_code) ?>" class="btn btn-danger">Delete</a>
                <a href="<?php echo base_url('order/view/'.$ord->order_code) ?>" class="btn btn-warning">View</a>
            </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
        <tr>
                <td>
                    <select class="xulydonhang form-control">
                        <?php
                        if($ord->order_status==1){
                        ?>
                        <option selected id="<?php echo $ord->order_code ?>" value="0">Order Processing</option>
                        <option id="<?php echo $ord->order_code ?>" value="2">Delivery</option>
                        <option id="<?php echo $ord->order_code ?>" value="3">Canceled</option>
                        <?php
                        } else if($ord->order_status==2){
                        ?>
                        <option id="<?php echo $ord->order_code ?>" value="0">Order Processing</option>
                        <option selected id="<?php echo $ord->order_code ?>" value="2">Delivery</option>
                        <option id="<?php echo $ord->order_code ?>" value="3">Canceled</option>
                        <?php
                        } else {
                        ?>
                        <option id="<?php echo $ord->order_code ?>" value="0">Order Processing</option>
                        <option id="<?php echo $ord->order_code ?>" value="2">Delivery</option>
                        <option selected id="<?php echo $ord->order_code ?>" value="3">Canceled</option>
                        <?php 
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
       
        </div>
</div>
</div>