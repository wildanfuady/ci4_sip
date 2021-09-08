<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Product</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php 
            $errors = session()->getFlashdata('errors');
            if(!empty($errors)){ ?>
            <div class="alert alert-danger" role="alert">
              Whoops! Ada kesalahan saat input data, yaitu:
              <ul>
              <?php foreach ($errors as $error) : ?>
                  <li><?= esc($error) ?></li>
              <?php endforeach ?>
              </ul>
            </div>
          <?php } ?>
          <div class="card">
            <?php echo form_open_multipart('product/update'); ?>
              <div class="card-header">Form Edit Produk</div>
              <div class="card-body">
                <?php echo form_hidden('product_id', $product['product_id']); ?>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <?php echo form_label('Image', 'Image'); ?>
                      <br>
                      <img src="<?php echo base_url('uploads/'.$product['product_image']) ?>" class="img-fluid">
                      <br>
                      <br>
                      <?php echo form_label('Ganti Image', 'Ganti Image'); ?>
                      <?php echo form_upload('product_image', $product['product_image']); ?>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group"> 
                      <?php echo form_label('Category', 'Category'); ?>
                      <?php echo form_dropdown('category_id', $categories, $product['category_id'], ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Name', 'Name'); ?>
                      <?php echo form_input('product_name', $product['product_name'], ['class' => 'form-control', 'placeholder' => 'Product Name']); ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Price', 'Price'); ?>
                      <?php echo form_input('product_price', $product['product_price'], ['class' => 'form-control', 'placeholder' => 'Product Price', 'type' => 'number']); ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('SKU', 'SKU'); ?>
                      <?php echo form_input('product_sku', $product['product_sku'], ['class' => 'form-control', 'placeholder' => 'Product SKU']); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <?php echo form_label('Status', 'Status'); ?>
                      <?php echo form_dropdown('product_status', ['' => 'Pilih', 'Active' => 'Active', 'Inactive' => 'Inactieve'], $product['product_status'], ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Description', 'Description'); ?>
                      <?php echo form_textarea('product_description', $product['product_description'], ['class' => 'form-control', 'placeholder' => 'Product Description']); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                  <a href="<?php echo base_url('product'); ?>" class="btn btn-outline-info">Back</a>
                  <button type="submit" class="btn btn-primary float-right">Update</button>
              </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo view('_partials/footer'); ?>