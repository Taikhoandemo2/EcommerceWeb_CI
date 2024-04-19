<div class="cointaner">
    <div class="card">
        <h5 class="card-header">Edit Product</h5>
    
    <div class="card-body">
        <a href="<?php echo base_url('product/list')?>" class="btn btn-success">List Product</a>
        <a href="<?php echo base_url('product/create')?>" class="btn btn-success">Add Product</a>
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
      
      <div id="nameError" style="color: red;"></div>
        <form action = "<?php echo base_url('product/update/'.$product->id)?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" value="<?php echo $product->title?>" name="title" class="form-control" onkeyup="ChangeToSlug();" id="slug" aria-describedby="emailHelp" oninput="validateInput(this)">
            <?php echo '<span class="text text-danger">'.form_error('title').'</span>';?> 
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="text" value="<?php echo $product->price?>" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" oninput="validateNumberInput(this)">
            <div id="priceError" style="color: red;"></div>
            <?php echo '<span class="text text-danger">'.form_error('price').'</span>';?> 
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Quantity</label>
            <input type="text" value="<?php echo $product->quantity?> " name="quantity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" oninput="validateQuantityInput(this)">
            <div id="quantityError" style="color: red;"></div>
            <?php echo '<span class="text text-danger">'.form_error('quantity').'</span>';?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" value="<?php echo $product->slug?>" name="slug" class="form-control" id="convert_slug" aria-describedby="emailHelp" >
            <?php echo '<span class="text text-danger">'.form_error('slug').'</span>';?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <input type="text" value="<?php echo $product->description?>" name="description" class="form-control" id="exampleInputPassword1" oninput="validateInput(this)">
            <?php echo '<span class="text text-danger">'.form_error('description').'</span>';?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input type="file" name="image" class="form-control-file" id="exampleInputPassword1" >
            <img src="<?php echo base_url('uploads/product/'.$product->image)  ?>" width="150" height="150">
            <small><?php if (isset($error)){echo $error;} ?></small>
        </div>
    
    <div class="form-group">
        <label for="exampleInputPassword1">Brand</label>
            <select class="form-control" name ="brand_id" id="exampleFormControlSelect1">
           
            <?php
            foreach ($brand as $key => $bra) {
            ?>
            <option <?php echo $bra->id ==$product->brand_id ?'selected' : ' '?>  value="<?php echo $bra->id?>"><?php echo $bra->title?></option>
            <?php
            }
            ?>
            </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Category</label>
            <select class="form-control" name ="category_id" id="exampleFormControlSelect1">
            
            <?php
            foreach ($category as $key => $cate) {
            ?>
            <option <?php echo $cate->id ==$product->category_id ?'selected' : ' '?>  value="<?php echo $cate->id?>"><?php echo $cate->title?></option>
            <?php
            }
            ?>
            </select>
    </div>
    
   
    <div class="form-group">
       
        <div class="form-group">
        <label for="exampleFormControlSelect1">Status</label>
            <select class="form-control" name ="status" id="exampleFormControlSelect1">
            <?php
                if ($product->status==1){
                    ?>
                <option selected value="1">Active</option>
                <option value="0">Inactive</option>
                <?php
                }
                else{
                    ?>
                    <option value="1">Active</option>
                    <option selected value="0">Inactive</option>
                    <?php
                }
                ?>
            </select>
    </div>
  
    <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
  </div>
  </div>
 

