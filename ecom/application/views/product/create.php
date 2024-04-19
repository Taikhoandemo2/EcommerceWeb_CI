<div class="cointaner">
    <div class="card">
        <h5 class="card-header">Create Product</h5>
    
    <div class="card-body">
        <a href="<?php echo base_url('product/list')?>" class="btn btn-success">List Product</a>
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
        <form action = "<?php echo base_url('product/store')?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" name="title" class="form-control" id="slug" onkeyup="ChangeToSlug();" aria-describedby="emailHelp" oninput="validateInput(this)">
            <?php echo '<span class="text text-danger">'.form_error('title').'</span>';?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input type="text" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" oninput="validateNumberInput(this)" >
            <div id="priceError" style="color: red;"></div>
            <?php echo '<span class="text text-danger">'.form_error('price').'</span>';?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Quantity</label>
            <input type="text" name="quantity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" oninput="validateQuantityInput(this)">
            <div id="quantityError" style="color: red;"></div>
            <?php echo '<span class="text text-danger">'.form_error('quantity').'</span>';?>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Slug</label>
            <input type="text" name="slug" class="form-control" id="convert_slug" aria-describedby="emailHelp" >
            <?php echo '<span class="text text-danger">'.form_error('slug').'</span>';?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <input type="text" name="description" class="form-control" id="exampleInputPassword1" oninput="validateInput(this)">
            <?php echo '<span class="text text-danger">'.form_error('description').'</span>';?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Image</label>
            <input type="file" name="image" class="form-control-file" id="exampleInputPassword1" >
            <small><?php if (isset($error)){echo $error;} ?></small>
        </div>
    
    <div class="form-group">
        <label for="exampleInputPassword1">Brand</label>
            <select class="form-control" name ="brand_id" id="exampleFormControlSelect1">
           
            <?php
            foreach ($brand as $key => $bra) {
            ?>
            <option value="<?php echo $bra->id?>"><?php echo $bra->title?></option>
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
            <option value="<?php echo $cate->id?>"><?php echo $cate->title?></option>
            <?php
            }
            ?>
            </select>
    </div>
    
    
    <div class="form-group">
       
        <div class="form-group">
        <label for="exampleFormControlSelect1">Status</label>
            <select class="form-control" name ="status" id="exampleFormControlSelect1">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
            </select>
    </div>
  
    <button type="submit" class="btn btn-primary">Add</button>
    </form>
    </div>
  </div>
  </div>
 

