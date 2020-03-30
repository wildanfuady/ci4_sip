<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Import Transaction</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Import Transaction</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php echo form_open_multipart('transaction/proses_import'); ?>
                    <div class="card">
                        <div class="card-body">
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

                            <div class="form-group">
                                <?php 
                                    echo form_label('File Excel');
                                    $trx_file = [
                                        'type'  => 'file',
                                        'name'  => 'trx_file',
                                        'id'    => 'trx_file',
                                        'class' => 'form-control'
                                    ];
                                    echo form_upload($trx_file); 
                                ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo base_url('transaction'); ?>" class="btn btn-outline-info">Back</a>
                            <button type="submit" class="btn btn-primary float-right">Import</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo view('_partials/footer'); ?>