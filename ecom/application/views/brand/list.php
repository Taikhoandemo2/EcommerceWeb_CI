<div class="cointaner">
    <div class="card">
        <div class="card-header">
             List Brand
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
        <a href="<?php echo base_url('brand/create')?>" class="btn btn-primary">Add Brand</a>
        <?php
            // Decode JSON data
            $brand_data = json_decode($json_data);
            if ($brand_data !== null && is_array($brand_data)) {
            ?>
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Status</th>
            <th scope="col">Manage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($brand_data as $key => $bra) {
            ?>
            <tr>
            <th scope="row"><?php echo $key+1?></th>
            <td><?php echo $bra->title?><Mark</td>
            <td><?php echo $bra->slug?></td>
            <td><?php echo $bra->description?></td>
            <td>
                <img src="<?php echo base_url('uploads/brand/'.$bra->image)  ?>" width="150" height="150">
            </td>
            <td>
                <?php
                if ($bra->status==1)
                {
                    echo 'Active';
                }
                else{
                    echo 'Inactive';
                }
                ?>
            </td>
            <td>
                <a onclick="return confirm('Are you sure want to delete this brand?')" href="<?php echo base_url('brand/delete/'.$bra->id) ?>" class="btn btn-danger">Delete</a>
                <a href="<?php echo base_url('brand/edit/'.$bra->id) ?>" class="btn btn-warning">Edit</a>
            </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
        </table>
        <?php } else { ?>
                <p>No sliders found.</p>
            <?php } ?>
        </div>
</div>
</div>