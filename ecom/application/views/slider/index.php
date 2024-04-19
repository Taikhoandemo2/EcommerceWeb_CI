
<div class="container">
    <div class="card">
        <div class="card-header">
            List Slider
        </div>
        <?php
        if ($this->session->flashdata('success')) {
        ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php
        } elseif ($this->session->flashdata('error')) {
        ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php
        }
        ?>
        <div class="card-body">
            <a href="<?php echo base_url('slider/create') ?>" class="btn btn-primary">Add Slider</a>
            <?php
            // Decode JSON data
            $slider_data = json_decode($json_data);
            if ($slider_data !== null && is_array($slider_data)) {
            ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($slider_data as $key => $sli) { ?>
                            <tr>
                                <th scope="row"><?php echo $key ?></th>
                                <td><?php echo $sli->title ?></td>
                                <td><?php echo $sli->description ?></td>
                                <td>
                                    <img src="<?php echo base_url('uploads/sliders/' . $sli->image) ?>" width="150" height="150">
                                </td>
                                <td>
                                    <?php
                                    if ($sli->status == 1) {
                                        echo 'Active';
                                    } else {
                                        echo 'Inactive';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a onclick="return confirm('Are you sure want to delete this slider?')" href="<?php echo base_url('slider/delete/' . $sli->id) ?>" class="btn btn-danger">Delete</a>
                                    <a href="<?php echo base_url('slider/edit/' . $sli->id) ?>" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No sliders found.</p>
            <?php } ?>
        </div>
    </div>
</div>