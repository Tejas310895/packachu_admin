<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sale Entries</h4>
            <a href="new_sales" class="btn btn-primary">Add Sale <span class="btn-icon-right"><i class="fa fa-plus"></i></span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="display text-dark" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>Invoice No.</th>
                            <th>Party</th>
                            <th>Inventory</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sale as $entries) : ?>
                            <tr>
                                <td><?= $entries['inc_no'] ?></td>
                                <td><?= $suppliers[$entries['customer_id']]['name'] ?></td>
                                <td>
                                    <?php
                                    $inventories = json_decode($entries['sale_inventory'], true);

                                    ?>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sale<?= $entries['id'] ?>">4</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="sale<?= $entries['id'] ?>">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Product Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table primary-table-bordered text-dark">
                                                            <thead class="thead-primary">
                                                                <tr>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Quantity</th>
                                                                    <th scope="col">Unit Rate</th>
                                                                    <th scope="col">Taxable</th>
                                                                    <th scope="col">Gst</th>
                                                                    <th scope="col">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $taxable_tot = 0;
                                                                $gst_tot = 0;
                                                                $tot_tot = 0;
                                                                foreach ($inventories as $items) :
                                                                    $taxable_tot += $items['unit_rate'] * $items['qty'];
                                                                    $gst_tot += ($items['unit_rate'] * $items['qty']) * ($items['gst_rate'] / 100);
                                                                    $tot_tot += ($items['unit_rate'] * $items['qty']) + (($items['unit_rate'] * $items['qty']) * ($items['gst_rate'] / 100));
                                                                ?>
                                                                    <tr>
                                                                        <th><?= $products[$items['prod_id']]['name'] ?></th>
                                                                        <td><?= $items['qty'] . ' ' . $products[$items['prod_id']]['measure_in'] ?></td>
                                                                        <td><?= $items['unit_rate'] ?></td>
                                                                        <td><?= $items['unit_rate'] * $items['qty'] ?></td>
                                                                        <td><?= round(($items['unit_rate'] * $items['qty']) * ($items['gst_rate'] / 100), 2) ?></td>
                                                                        <td><?= round(($items['unit_rate'] * $items['qty']) + (($items['unit_rate'] * $items['qty']) * ($items['gst_rate'] / 100))) ?></td>
                                                                    </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr class="text-bold">
                                                                    <td colspan="3" class="text-right">Total</td>
                                                                    <td><?= $taxable_tot ?></td>
                                                                    <td><?= $gst_tot ?></td>
                                                                    <td><?= $tot_tot ?></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $tot_tot ?></td>
                                <td style="width:20%;">
                                    <div class="btn-group">
                                        <a href="?delete=<?= $entries['id'] ?>" class="btn btn-danger mr-1">
                                            Delete <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                        <a href="print_sale/<?= $entries['id'] ?>" target="_blank" class="btn btn-primary">
                                            Print <i class="fa fa-print" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>