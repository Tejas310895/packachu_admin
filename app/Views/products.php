<?php
$request = \Config\Services::request();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary pull-right m-2" data-toggle="modal" data-target="#product_modal">Add Products</button>
            <!-- Modal -->
            <form action="<?= current_url() ?>" method="post" enctype='multipart/form-data'>
                <?= csrf_field() ?>
                <div class="modal fade" id="product_modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Products</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <select class="mb-3" id="single-select" name="category_id" required>
                                    <option value="" selected disabled>Select Category</option>
                                    <?php foreach ($category as $cats) : ?>
                                        <option value="<?= $cats['id'] ?>"><?= $cats['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="product_mrp" placeholder="Enter MRP" required>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="measure_in" placeholder="Enter Measure Unit" required>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="product_rate" placeholder="Enter Rate" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="product_img" required>
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="prod" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary pull-right m-2" data-toggle="modal" data-target="#cat_modal">Add Category</button>
            <!-- Modal -->
            <?= form_open(current_url(), ['method' => 'post']) ?>
            <div class="modal fade" id="cat_modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Category</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control input-rounded" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="cat" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-4">
                        <li class=" nav-item">
                            <a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false">All</a>
                        </li>
                    </ul>
                    <div class="tab-content" style="height: 80vh;width:100%;overflow-y:scroll;overflow-x:none;">
                        <div id="navpills-1" class="tab-pane active">
                            <div class="container-fluid">

                                <div class="row pt-4">
                                    <?php foreach ($products as $items) :
                                    ?>
                                        <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6 col-md-6">
                                            <div class="card mb-3" style="max-width: 540px;">
                                                <div class="row g-0">
                                                    <div class="col-md-4 px-0">
                                                        <?php if ($items['product_img'] !== null) : ?>
                                                            <img src="<?= IMGPROD . $items['product_img'] ?>" class="img-fluid img-cover rounded-start " alt="...">
                                                        <?php endif ?>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body p-2">
                                                            <h5 class="card-title"><?= $items['name'] ?></h5>
                                                            <div class="row">
                                                                <?php if ($items['product_mrp'] > 0 && $items['product_mrp'] != null) : ?>
                                                                    <div class="col-4 p-1 border-right">
                                                                        <h6 class="text-muted mb-1 text-center" style="font-size:1em;">MRP</h6>
                                                                        <p class="text-muted mb-1 text-center" style="font-size:0.8em;"><strong><?= $items['product_mrp'] ?>/<?= $items['measure_in'] ?></strong></p>
                                                                    </div>
                                                                <?php endif ?>

                                                                <div class="col-4 p-1 border-right">
                                                                    <h6 class="text-muted mb-1 text-center" style="font-size:1em;">Rate</h6>
                                                                    <p class="text-muted mb-1 text-center" style="font-size:0.8em;"><strong><?= $items['product_rate'] ?>/<?= $items['measure_in'] ?></strong></p>
                                                                </div>
                                                                <?php if ($items['product_mrp'] > 0 && $items['product_mrp'] != null) : ?>
                                                                    <div class="col-4 p-1">
                                                                        <h6 class="text-danger mb-1 text-center" style="font-size:1em;">Margin</h6>
                                                                        <p class="text-danger mb-1 text-center" style="font-size:0.8em;"><strong><?= round(100 - (($items['product_rate'] / $items['product_mrp']) * 100)) ?>%</strong></p>
                                                                    </div>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#edit_<?= $items['id'] ?>">
                                                                        <i class="mdi mdi-pencil"></i>
                                                                    </button>
                                                                    <!-- Modal -->
                                                                    <form action="<?= current_url() ?>" method="post" enctype='multipart/form-data'>
                                                                        <?= csrf_field() ?>
                                                                        <input type="hidden" name="id" value="<?= $items['id'] ?>">
                                                                        <div class="modal fade" id="edit_<?= $items['id'] ?>">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title">Modal title</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <select class="mb-3 single-select-placeholder" id="<?= $items['id'] ?>" name="category_id" required>
                                                                                            <option value="" selected disabled>Select Category</option>
                                                                                            <?php foreach ($category as $cats) : ?>
                                                                                                <option value="<?= $cats['id'] ?>" <?= ($items['category_id'] == $cats['id']) ? 'selected' : '' ?>><?= $cats['name'] ?></option>
                                                                                            <?php endforeach ?>
                                                                                        </select>
                                                                                        <div class="form-floating mb-3 mt-3">
                                                                                            <input type="text" class="form-control" name="name" value="<?= $items['name'] ?>" required>
                                                                                        </div>
                                                                                        <div class="form-floating mb-3">
                                                                                            <input type="text" class="form-control" name="product_mrp" value="<?= $items['product_mrp'] ?>" required>
                                                                                        </div>
                                                                                        <div class="form-floating mb-3">
                                                                                            <input type="text" class="form-control" name="measure_in" value="<?= $items['measure_in'] ?>" required>
                                                                                        </div>
                                                                                        <div class="form-floating mb-3">
                                                                                            <input type="text" class="form-control" name="product_rate" value="<?= $items['product_rate'] ?>" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="submit" name="prod_edit" class="btn btn-primary">Save changes</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="col-4">
                                                                    <form action="<?= current_url() ?>" method="post">
                                                                        <?= csrf_field() ?>
                                                                        <input type="hidden" name="id" value="<?= $items['id'] ?>">
                                                                        <input type="hidden" name="status" value="<?= ($items['status'] == 1) ? '0' : '1' ?>">
                                                                        <button type="submit" name="prod_status" class="btn btn-block btn-<?= ($items['status'] == 1) ? 'warning' : 'success' ?>"><?= ($items['status'] == 1) ? '<i class="mdi mdi-lock"></i>' : '<i class="mdi mdi-lock-open"></i>' ?></button>
                                                                    </form>
                                                                </div>
                                                                <div class="col-4">
                                                                    <form action="<?= current_url() ?>" method="post">
                                                                        <?= csrf_field() ?>
                                                                        <input type="hidden" name="id" value="<?= $items['id'] ?>">
                                                                        <button type="submit" name="prod_delete" class="btn btn-block btn-danger"><i class="mdi mdi-delete"></i></button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>