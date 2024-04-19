<div class="cointaner">
<div class="card">
  <h5 class="card-header">Create Brand</h5>



  <div class="card-body">
  <a href="<?php echo base_url('brand/list')?>" class="btn btn-success">List Brand</a>
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
  <form action = "<?php echo base_url('brand/store')?>" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" name="title" class="form-control" id="slug" onkeyup="ChangeToSlug();" aria-describedby="emailHelp" oninput="validateInput(this)">
    <?php echo '<span class="text text-danger">'.form_error('title').'</span>';?>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Slug</label>
    <input type="text" name="slug" class="form-control" id="convert_slug" aria-describedby="emailHelp" oninput="validateInput(this)">
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
    <label for="exampleInputPassword1">Description</label>
    <div class="form-group">
    <label for="exampleFormControlSelect1">Status</label>
        <select class="form-control" name ="status" id="exampleFormControlSelect1">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
        </select>
  </div>
  </div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
  </div>
</div>
</div>