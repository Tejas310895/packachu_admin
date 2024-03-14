<?= form_open(current_url(), ['method' => 'post', 'id' => 'pur_form']) ?>
<div class="row mx-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Purchase Invoice Entry</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="inc_no" placeholder="Invoice No" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="purchase_date" required>
                        </div>
                        <div class="col-sm-4">
                            <select class="select2" name="supplier_id" id="single-select1" required>
                                <option value="" disabled selected>Select Supplier</option>
                                <?php foreach ($suppliers as $client) : ?>
                                    <option value="<?= $client['id'] ?>"><?= $client['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body fieldGroup" id="product_basket">
                <div class="input-group mb-3 ">
                    <div class="autocomplete" style="width:500px;">
                        <input type="text" class="form-control purchase_prod" name="purchase_inventory[prod_id][]" id="purchase_prod" placeholder="Product Name" required />
                    </div>
                    <input type="text" class="form-control" name="purchase_inventory[mesure_unit][]" placeholder="Measure unit" required />
                    <input type="text" class="form-control" name="purchase_inventory[qty][]" placeholder="Quantity" required />
                    <input type="text" class="form-control" name="purchase_inventory[unit_rate][]" placeholder="Unit Rate" required />
                    <input type="text" class="form-control" name="purchase_inventory[gst_rate][]" placeholder="Gst Rate" required />
                    <input type="text" class="form-control" name="purchase_inventory[discount][]" placeholder="Discount">
                    <button type="button" class="btn  btn-square btn-success text-white" onclick="add_purchase_item($(this))">Add</button>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary pull-right">Generate Invoice</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>
<script>
    function assign_autocomplete() {
        var products = <?= json_encode($products) ?>;
        var atom = document.getElementsByClassName('purchase_prod');
        for (var i = 0; i < atom.length; i++) {
            autocomplete(atom[i], products);
        }
    }
    assign_autocomplete();

    function add_purchase_item(element) {
        var temp = '<div class="input-group mb-3">';
        temp += '<div class="autocomplete" style="width:500px;">';
        temp += '<input type="text" class="form-control purchase_prod" id="purchase_prod" name="purchase_inventory[prod_id][]" placeholder="Product Name" required/>';
        temp += '</div>';
        temp += '<input type="text" class="form-control" name="purchase_inventory[mesure_unit][]" placeholder="Measure unit" required/>';
        temp += '<input type="text" class="form-control" name="purchase_inventory[qty][]" placeholder="Quantity" required/>';
        temp += '<input type="text" class="form-control" name="purchase_inventory[unit_rate][]" placeholder="Unit Rate" required/>';
        temp += '<input type="text" class="form-control" name="purchase_inventory[gst_rate][]" placeholder="Gst Rate" required/>';
        temp += '<input type="text" class="form-control" name="purchase_inventory[discount][]" placeholder="Discount" required/>';
        temp += '<button type="button" class="btn  btn-square btn-danger text-white" onclick="delete_purchase_item($(this))"><i class="fa fa-trash"></i></button>';
        temp += '</div>';
        $('body').find('#product_basket').append(temp);
        assign_autocomplete()
    }

    function delete_purchase_item(element) {
        element.parent().remove();
    }
</script>