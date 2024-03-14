<?php

namespace App\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use CodeIgniter\Files\File;
use CodeIgniter\Model;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\App;

class TemplateController extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->customers = new \App\Models\CustomerModel();
        $this->products = new \App\Models\ProductsModel();
        $this->purchase = new \App\Models\PurchaseModel();
        $this->sale = new \App\Models\SaleModel();
    }
    public function sale_invoice_prnt($id)
    {
        $data['sales'] = $this->sale->join('customers', 'customer_id=customers.id')->find($id);
        $products = $this->products->findAll();
        $data['products'] = array_reduce($products, function ($carry, $val) {
            $carry[$val['id']] = $val;
            return $carry;
        });
        $data['gst'] = [];
        foreach (json_decode($data['sales']['sale_inventory'], true) as $values) {
            $inv_product = $this->products->find($values['prod_id']);
            $taxable = $values['unit_rate'] * $values['qty'];
            @$data['gst'][$inv_product['hsn_code']]['taxable'] += $taxable;
            if ($data['sales']['billing_state_code'] == 27) {
                @$data['gst'][$inv_product['hsn_code']]['CGST'][$values['gst_rate'] / 2] += $taxable * (($values['gst_rate'] / 2) / 100);
                @$data['gst'][$inv_product['hsn_code']]['SGST'][$values['gst_rate'] / 2] += $taxable * (($values['gst_rate'] / 2) / 100);
            } else {
                @@$data['gst'][$inv_product['hsn_code']]['IGST'][$values['gst_rate']] += $taxable * ($values['gst_rate'] / 100);
            }
        }

        $dompdf = new Dompdf(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $html = view('templates/sale_invoice.php', $data);
        $dompdf->loadHtml($html, 'utf-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('resume.pdf', ['Attachment' => false]);

        return view('includes/theader.php') .
            view('templates/sale_invoice.php', $data);
    }
}
