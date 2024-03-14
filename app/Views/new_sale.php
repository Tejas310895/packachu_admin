<input type="hidden" class="stock_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
<input type="hidden" class="inc_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
<?= form_open(current_url(), ['method' => 'post', 'id' => 'sale_form']) ?>
<div class="row mx-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sales Invoice Entry</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="inc_no" placeholder="Invoice No" onchange="check_invoice($(this))" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="invoice_date" required>
                        </div>
                        <div class="col-sm-4">
                            <select class="select2" name="customer_id" id="single-select1" required onchange="add_address($(this))">
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
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="transport_name" placeholder="Transpoter name" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="transport_number" placeholder="Vehicle No" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="shipped_date" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="text" class="form-control mb-2" name="billing_add" placeholder="Billing Address" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control mb-2" name="billing_state_code" placeholder="State Code" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" id="check1" onchange="copy_address($(this))">
                                <label class="form-check-label" for="check1">Same as billing address</label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control mb-2" name="shipping_add" placeholder="Shipping Address" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="number" class="form-control mb-2" name="shipping_state_code" placeholder="State Code" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-body fieldGroup" id="product_basket">
            <div class="input-group mb-3">
                <select id="select-state" class="form-control" name="sale_inventory[prod_id][]" placeholder="Pick a state...">
                    <option value="">Select Product</option>
                    <?php foreach ($products as $item) : ?>
                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                    <?php endforeach ?>
                </select>
                <input type="number" class="form-control" name="sale_inventory[qty][]" placeholder="Quantity" onchange="stock_check($(this))" required />
                <input type="text" class="form-control" name="sale_inventory[unit_rate][]" placeholder="Unit Rate" required />
                <input type="text" class="form-control" name="sale_inventory[gst_rate][]" placeholder="Gst Rate" required />
                <input type="text" class="form-control" name="sale_inventory[discount][]" placeholder="Discount">
                <button type="button" class="btn  btn-square btn-success text-white" onclick="add_purchase_item($(this))">Add</button>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary pull-right">Generate Invoice</button>
        </div>
    </div>
</div>
<?= form_close() ?>
<div class="card-body fieldGroupcopy" id="product_basket" style="display: none;">
    <div class="input-group mb-3 ">
        <select id="select-state" class="form-control" name="sale_inventory[prod_id][]" placeholder="Pick a state..." required>
            <option value="">Select Product</option>
            <?php foreach ($products as $item) : ?>
                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
            <?php endforeach ?>
        </select>
        <input type="number" class="form-control" name="sale_inventory[qty][]" placeholder="Quantity" onchange="stock_check($(this))" required />
        <input type="text" class="form-control" name="sale_inventory[unit_rate][]" placeholder="Unit Rate" required />
        <input type="text" class="form-control" name="sale_inventory[gst_rate][]" placeholder="Gst Rate" required />
        <input type="text" class="form-control" name="sale_inventory[discount][]" placeholder="Discount">
        <button type="button" class="btn  btn-square btn-danger text-white" onclick="delete_purchase_item($(this))"><i class="fa fa-trash"></i></button>
    </div>
</div>
</div>

<script>
    var suppliers = <?= json_encode($supliers_add) ?>;

    function add_address(element) {
        var billing_add = suppliers[element.val()];
        $('input[name="billing_add"]').val(billing_add['address']);
        $('input[name="billing_state_code"]').val(billing_add['state_code']);
    }

    function copy_address(element) {
        if (element.is(':checked')) {
            $('input[name="shipping_add"]').val($('input[name="billing_add"]').val());
            $('input[name="shipping_state_code"]').val($('input[name="billing_state_code"]').val());
        } else {
            $('input[name="shipping_add"]').val();
            $('input[name="shipping_state_code"]').val();
        }
    }

    function add_purchase_item(element) {
        $('body').find('#product_basket').append($('.fieldGroupcopy').html());
    }

    function delete_purchase_item(element) {
        element.parent().remove();

    }

    function stock_check(element) {
        var qty = element.val();
        if (qty > 0) {
            var prod = element.parent().find('select').val();
            if (prod != '') {
                var csrf_token_stock = $('.stock_csrfname').val();
                $.ajax({
                    type: "post",
                    url: window.location.href,
                    data: {
                        '<?= csrf_token() ?>': csrf_token_stock,
                        'check_prod_id': prod
                    },
                    success: function(response) {
                        $('.stock_csrfname').val(response.token);
                        if (parseInt(response.stock) < qty) {
                            element.val('');
                            var comment =
                                notify_alert('warning', "Insufficient Stock! Available stock is " + response.stock);
                        }
                    }
                });
            } else {
                element.val('');
                notify_alert('warning', "Select the product first");
            }
        }
    }

    function check_invoice(element) {
        var inc = element.val();
        var csrf_token_inc = $('.inc_csrfname').val();
        $.ajax({
            type: "post",
            url: window.location.href,
            data: {
                '<?= csrf_token() ?>': csrf_token_inc,
                'invoice_check': inc
            },
            success: function(response) {
                $('.inc_csrfname').val(response.token);
                if (response.status) {
                    element.val(response.inc_no);
                } else {
                    element.val('');
                    notify_alert('warning', "Wrong Invoice Formating");
                }
            }
        });
    }
    // apply_tom('.select-state');

    // function apply_tom(id_name) {
    //     document.querySelectorAll(id_name).forEach((el) => {
    //         let settings = {};
    //         new TomSelect(el, settings);
    //     });
    // }
</script>