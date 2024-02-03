<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary pull-right m-2" data-toggle="modal" data-target="#product_modal">Add Customers</button>
            <!-- Modal -->
            <form action="<?= current_url() ?>" method="post" enctype='multipart/form-data'>
                <?= csrf_field() ?>
                <div class="modal fade" id="product_modal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Customer</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                </div>
                                <div class="form-floating mb-3 mt-3">
                                    <input type="number" class="form-control" name="mobile" placeholder="Enter Mobile number" required>
                                </div>
                                <div class="form-floating mb-3 mt-3">
                                    <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                                </div>
                                <div class="form-floating mb-3 mt-3">
                                    <textarea class="form-control" name="address" placeholder="Enter Address" required></textarea>
                                </div>
                                <div class="form-floating mb-3 mt-3">
                                    <input type="number" class="form-control" name="state_code" placeholder="Enter state code" required>
                                </div>
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" name="gst" placeholder="Enter gst" required>
                                </div>
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" name="pan" placeholder="Enter PAN" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>GST</th>
                                    <th>PAN</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($customers as $value) : ?>
                                    <tr>
                                        <td><?= $value['name'] ?></td>
                                        <td><?= $value['mobile'] ?></td>
                                        <td><?= $value['email'] ?></td>
                                        <td><?= $value['gst'] ?></td>
                                        <td><?= $value['pan'] ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-rounded btn-outline-primary float-right" data-toggle="modal" data-target="#cust_modal<?= $value['id'] ?>"><i class="fa fa-pencil"></i></button>
                                                </div>
                                                <div class="col-md-6">
                                                    <form action="<?= current_url() ?>" method="post" enctype='multipart/form-data'>
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                                        <button type="submit" name="delete_cust" class="btn btn-rounded btn-outline-primary"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Modal -->
                                            <form action="<?= current_url() ?>" method="post" enctype='multipart/form-data'>
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                                <div class="modal fade" id="cust_modal<?= $value['id'] ?>">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Add Customer</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-floating mb-3 mt-3">
                                                                    <input type="text" class="form-control" name="name" value="<?= $value['name'] ?>" required>
                                                                </div>
                                                                <div class="form-floating mb-3 mt-3">
                                                                    <input type="number" class="form-control" name="mobile" value="<?= $value['mobile'] ?>" required>
                                                                </div>
                                                                <div class="form-floating mb-3 mt-3">
                                                                    <input type="email" class="form-control" name="email" value="<?= $value['email'] ?>" required>
                                                                </div>
                                                                <div class="form-floating mb-3 mt-3">
                                                                    <textarea class="form-control" name="address" required><?= $value['address'] ?></textarea>
                                                                </div>
                                                                <div class="form-floating mb-3 mt-3">
                                                                    <input type="number" class="form-control" name="state_code" value="<?= $value['state_code'] ?>" required>
                                                                </div>
                                                                <div class="form-floating mb-3 mt-3">
                                                                    <input type="text" class="form-control" name="gst" value="<?= $value['gst'] ?>" required>
                                                                </div>
                                                                <div class="form-floating mb-3 mt-3">
                                                                    <input type="text" class="form-control" name="pan" value="<?= $value['pan'] ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>