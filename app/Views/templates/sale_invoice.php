<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Codeigniter 4 PDF Example - positronx.io</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <style>
        @media print {
            .pagebreak {
                page-break-before: always;
            }
        }

        @page {
            margin: 2%;
        }

        body {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        .size5 {
            font-size: 0.5em;
        }

        .size7 {
            font-size: 0.7em;
        }

        .size8 {
            font-size: 0.8em;
        }

        .size10 {
            font-size: 1em;
        }

        .size15 {
            font-size: 1.5em;
        }

        .size20 {
            font-size: 2em;
        }

        .size25 {
            font-size: 2.5em;
        }
    </style>
</head>

<body>
    <div class="table-responsive">
        <table class="table table-bordered border border-black mb-0" style="border: 1px solid #000;">
            <thead>
                <tr class="border-dark border-2" style="border: 1px solid #000;">
                    <th class="w-75 text-center p-2" scope="col">Tax Invoice</th>
                    <th class="w-25 text-center p-2 size8" scope="col">Orignal For Recipient</th>
                </tr>
        </table>
        <table class="table table-bordered border border-black mb-0" style="border: 1px solid #000;">
            <thead>
                <tr class="border-dark border-2" style="border: 1px solid #000;">
                    <th class="w-25 text-center p-2" scope="col">
                        <h6 class="mb-0 text-uppercase">BS ENTERPRISES</h6>
                    </th>
                    <th class="w-75 text-center p-2" scope="col" style="font-size:0.8em;">
                        <p class="text-center mb-0 text-capitalize">C-Wing, F.No. 302, Narmada CHS Ltd, Sec-19, Airoli, Navi Mumbai,
                            Thane-400708</p>
                        <p class="text-center mb-0"> +919082571298 | swrapfoil@gmail.com</p>
                    </th>
                </tr>
            </thead>
        </table>
        <table class="table table-bordered border border-black mb-0" style="border: 1px solid #000;">
            <thead>
                <tr class="border-dark border-2" style="border: 1px solid #000;">
                    <th class="w-50 text-left p-2" scope="col">
                        <h5 class="size8">GSTIN Number : 27AAVFB4499H1ZP</h5>
                        <h5 class="size8">Invoice Number : <?= $sales['inc_no'] ?></h5>
                        <h5 class="size8">Invoice Date : <?= date('d-m-Y', strtotime($sales['invoice_date'])) ?></h5>
                        <h5 class="mb-0 size8 text-uppercase">
                            State: MAHARASHTRA
                        </h5>
                    </th>
                    <th class="w-50 text-left p-2" scope="col">
                        <h5 class="text-capitalize size8">Transportor : <?= $sales['transport_name'] ?></h5>
                        <h5 class="size8">E-way Number : </h5>
                        <h5 class="text-uppercase size8">Vehicle Number: <?= $sales['transport_number'] ?></h5>
                        <h5 class="mb-0 size8">Supply Date : <?= $sales['shipped_date'] ?></h5>
                    </th>
                </tr>
            </thead>
        </table>
        <table class="table table-bordered table-secondary mb-0" style="border: 1px solid #000;">
            <thead>
                <tr class="border-dark border-2" style="border: 1px solid #000;">
                    <th class="w-50 text-left p-2" scope="col">
                        <h4 class="size10 mb-0">Details Of Reciever (Billed To)</h4>
                    </th>
                    <th class="w-50 text-left p-2" scope="col">
                        <h4 class="size10 mb-0">Details Of consignee (Shipped To)</h4>
                    </th>
                </tr>
            </thead>
        </table>
        <table class="table table-bordered border border-black mb-0" style="border: 1px solid #000;">
            <thead>
                <tr class="border-dark border-2" style="border: 1px solid #000;">
                    <th class="w-50 text-left p-2" scope="col">
                        <h5 class="size8 mb-0 text-capitalize">Name : <?= $sales['name'] ?></h5>
                        <h5 class="size8 mb-0">Contact : +91 <?= $sales['mobile'] ?></h5>
                        <h5 class="size8 mb-0" style="max-width: 350px;word-wrap: break-word;">Address : <?= $sales['billing_add'] ?></h5>
                        <h5 class="size8 text-uppercase mb-0">GSTIN Number: <?= $sales['gst'] ?></h5>
                    </th>
                    <th class="w-50 text-left p-2" scope="col">
                        <h5 class="size8 text-capitalize mb-0">Name : <?= $sales['name'] ?></h5>
                        <h5 class="size8 mb-0">Contact : +91 <?= $sales['mobile'] ?></h5>
                        <h5 class="size8 d-inline-block mb-0" style="max-width: 350px;word-wrap: break-word;">Address : <?= $sales['billing_add'] ?></h5>
                        <h5 class="size8 text-uppercase mb-0">GSTIN Number: <?= $sales['gst'] ?></h5>
                    </th>
                </tr>
            </thead>
        </table>
        <table class="table table-bordered border border-black mb-0">
            <thead class="size8">
                <tr class="text-center">
                    <th class="align-middle p-1">Sl.No</th>
                    <th class="align-middle p-1">Description of goods</th>
                    <th class="align-middle p-1">HSN Code</th>
                    <th class="align-middle p-1">Quantity</th>
                    <th class="align-middle p-1">Rate<br><small>(Per Carton/<br>Bundle)</small></th>
                    <th class="align-middle p-1">Amount</th>
                    <th class="align-middle p-1">Discount</th>
                    <th class="align-middle  p-1">Taxable Value</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pro_counter = 0;
                $taxable = 0;
                foreach (json_decode($sales['sale_inventory'], true) as $prods) :
                    $prod_data = $products[$prods['prod_id']];
                    $taxable += $prods['qty'] * $prods['unit_rate'];
                ?>
                    <tr class="text-center">
                        <td class=" p-1">
                            <h6 class="size8 mb-0"><?php echo ++$pro_counter; ?></h6>
                        </td>
                        <td class=" p-1">
                            <h6 class="size8 mb-0"><?php echo $prod_data['name']; ?></h6>
                        </td>
                        <td class=" p-1">
                            <h6 class="size8 mb-0"><?php echo $prod_data['hsn_code']; ?></h6>
                        </td>
                        <td class=" p-1">
                            <h6 class="size8 mb-0"><?php echo $prods['qty']; ?></h6>
                        </td>
                        <td class=" p-1">
                            <h6 class="size8 mb-0"><?php echo $prods['unit_rate']; ?></h6>
                        </td>
                        <td class=" p-1">
                            <h6 class="size8 mb-0"><?php echo $prods['qty'] * $prods['unit_rate']; ?></h6>
                        </td>
                        <td class=" p-1">
                            <h6 class="size8 mb-0"><?php echo $prods['discount']; ?> %</h6>
                        </td>
                        <td class=" p-1">
                            <h6 class="size8 mb-0"><?php echo $prods['qty'] * $prods['unit_rate'] - ($prods['qty'] * $prods['unit_rate'] * ($prods['discount'] / 100)); ?></h6>
                        </td>
                    </tr>
                <?php endforeach ?>
                <?php
                $req_count = 4 - count(json_decode($sales['sale_inventory'], true));

                if ($req_count > 1) {

                    for ($x = 0; $x <= $req_count; $x++) {
                        echo "
                                <tr>
                                    <td class='p-2'></td>
                                    <td class='p-2'></td>
                                    <td class='p-2'></td>
                                    <td class='p-2'></td>
                                    <td class='p-2'></td>
                                    <td class='p-2'></td>
                                    <td class='p-2'></td>
                                    <td class='p-2'></td>
                                </tr>
                            ";
                    }
                } else {
                    echo "";
                }

                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7" class="text-right pr-2">
                        <h5 class="mb-0 size10">TOTAL TAXABLE VALUE</h5>
                    </th>
                    <th class="text-center">
                        <h5 class="mb-0 size10"><?= $taxable ?></h5>
                    </th>
                </tr>
            </tfoot>
        </table>
        <table class="table table-bordered border border-black mb-0">
            <thead>
                <tr class="size8 text-center">
                    <th class="p-1" rowspan="2">HSN/SAC</th>
                    <th class="p-1" rowspan="2">Taxable Value</th>
                    <th class="p-1" colspan="2">CGST</th>
                    <th class="p-1" colspan="2">SGST</th>
                    <th class="p-1" colspan="2">IGST</th>
                    <th class="p-1" rowspan="2">Total Tax Amount</th>
                </tr>
                <tr class="size8 text-center">
                    <th class=" p-1">Rate</th>
                    <th class=" p-1">Amount</th>
                    <th class=" p-1">Rate</th>
                    <th class=" p-1">Amount</th>
                    <th class=" p-1">Rate</th>
                    <th class=" p-1">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totcgst = 0;
                $totsgst = 0;
                $totigst = 0;
                $cgst = 0;
                $cgstper = null;
                $sgst = 0;
                $sgstper = null;
                $igst = 0;
                $igstper = null;
                foreach ($gst as $hsn => $gst_vals) :
                    if (in_array('CGST', array_keys($gst_vals))) {
                        $cgstper = array_keys($gst_vals['CGST'])[0];
                        $cgst = array_values($gst_vals['CGST'])[0];
                        $totcgst += array_values($gst_vals['CGST'])[0];
                    } elseif (in_array('SGST', array_keys($gst_vals))) {
                        $sgstper = array_keys($gst_vals['SGST'])[0];
                        $sgst = array_values($gst_vals['SGST'])[0];
                        $totcsst = array_values($gst_vals['SGST'])[0];
                    } elseif (in_array('IGST', array_keys($gst_vals))) {
                        $igstper = array_keys($gst_vals['IGST'])[0];
                        $igst = array_values($gst_vals['IGST'])[0];
                        $totigst = array_values($gst_vals['IGST'])[0];
                    }
                ?>
                    <tr class="size8 text-center">
                        <td class=" p-1"><?= $hsn ?></td>
                        <td class=" p-1"><?= $gst_vals['taxable'] ?></td>
                        <td class=" p-1"><?= ($cgstper) ? $cgstper . '%' : '-' ?></td>
                        <td class=" p-1"><?= $cgst ?></td>
                        <td class=" p-1"><?= ($sgstper) ? $sgstper . '%' : '-' ?> </td>
                        <td class=" p-1"><?= $sgst ?></td>
                        <td class=" p-1"><?= ($igstper) ? $igstper . '%' : '-' ?> </td>
                        <td class=" p-1"><?= $igst ?></td>
                        <td class=" p-1"><?= $cgst + $sgst + $igst ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr class="size8 text-center">
                    <th class=" p-1">TOTAL</th>
                    <th class=" p-1"></th>
                    <th class=" p-1"></th>
                    <th class=" p-1"><?= ($totcgst) ? $totcgst : '' ?></th>
                    <th class=" p-1"></th>
                    <th class=" p-1"><?= ($totsgst) ? $totsgst : '' ?></th>
                    <th class=" p-1"></th>
                    <th class=" p-1"><?= ($totigst) ? $totigst : '' ?></th>
                    <th class=" p-1"><?= $totcgst + $totsgst + $totigst ?></th>
                </tr>
            </tfoot>
        </table>
        <table class="table table-bordered mb-0" style="border: 1px solid #000;">
            <thead>
                <tr class="border-dark border-2" style="border: 1px solid #000;">
                    <th class="w-100 text-left p-0" scope="col">
                        <h5 class="size8 my-2 text-right text-uppercase m-0 p-0">
                            TOTAL IN WORDS : <?= AmountInWords(round($taxable + $totcgst + $totsgst + $totigst))?> INR
                            Only
                        </h5>
                    </th>
                </tr>
            </thead>
        </table>
        <table class="table table-bordered border border-black mb-0" style="border: 1px solid #000;">
            <thead>
                <tr class="border-dark border-2" style="border: 1px solid #000;">
                    <th class="w-50 text-left p-2" scope="col">
                        <h5 class="text-uppercase size8"><u>Bank Details</u></h5>
                        <h5 class="text-uppercase size8">Bank : KOTAK MAHINDRA BANK</h5>
                        <h5 class="text-uppercase size8">AC Number : 8813311337</h5>
                        <h5 class="text-uppercase size8">Branch :DOMBIVALI EAST (IFSC:KKBK0001416)</h5>
                        <h5 class="text-uppercase size8">AC Holder : BS ENTERPRISES</h5>
                        <h5 class="text-uppercase size8">Due Date : </h5>
                    </th>
                    <th class="w-25 text-left p-2" scope="col">
                        <h6 class="size8 text-center">Customer Signature</h6>
                    </th>
                    <th class="w-25 text-left p-0" scope="col">
                        <table class="table border border-1 mb-0">
                            <tr class="size7">
                                <th class="py-1">Taxable Amount</th>
                                <td class="py-1 text-right"><?= $taxable ?></td>
                            </tr>
                            <tr class="size7">
                                <th class="py-1">Output CGST</th>
                                <td class="py-1 text-right"><?= $totcgst ?></td>
                            </tr>
                            <tr class="size7">
                                <th class="py-1">Output SGST</th>
                                <td class="py-1 text-right"><?= $totsgst ?></td>
                            </tr>
                            <tr class="size7">
                                <th class="py-1">Output IGST</th>
                                <td class="py-1 text-right"><?= $totigst ?></td>
                            </tr>
                            <tr class="size7">
                                <th class="py-1">Total Tax</th>
                                <td class="py-1 text-right"><?= $totcgst + $totsgst + $totigst ?></td>
                            </tr>
                            <tr class="size7">
                                <th class="py-1">Round Off</th>
                                <td class="py-1 text-right"><?= round($taxable + $totcgst + $totsgst + $totigst) - ($taxable + $totcgst + $totsgst + $totigst) ?></td>
                            </tr>
                            <tr class="size7">
                                <th class="py-1">Grand Total</th>
                                <td class="py-1 text-right"><?= round($taxable + $totcgst + $totsgst + $totigst) ?></td>
                            </tr>
                        </table>
                    </th>
                </tr>
            </thead>
        </table>
        <table class="table table-bordered border border-black mb-0" style="border: 1px solid #000;">
            <thead>
                <tr class="border-dark border-2" style="border: 1px solid #000;">
                    <th class="w-75 text-left p-2" scope="col">
                        <h4 class="size8"><u>TERMS & CONDITIONS:</u></h4>
                        <p class="size7 mb-0 font-italic">
                            1. Interest will be charged @25% P.A, if the bill is not paid on delivery. <br>
                            2. All claims for shortage, delay, loss or damage to be preferred against carriers only. <br>
                            3. Every care is taken in Packing of Goods and our responsibility ceases as soon as the goods leave our godown. <br>
                            4. Goods once sold will not be taken back. <br>
                            5. All disputes are subject to Mumbai Juridiction only.
                        </p>
                    </th>
                    <th class="w-25 text-left p-2" scope="col">
                        <p class="size8 text-center mb-0" style="font-size:0.6rem;">Certified That the particulars given above are true and correct</p>
                        <h5 class="size8 text-center text-uppercase">For </h5> <br>
                        <br>
                        <h5 class="size8 text-center">Authorised Signature</h5>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>