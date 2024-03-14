<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use CodeIgniter\Model;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class BillingController extends BaseController
{

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->customers = new \App\Models\CustomerModel();
        $this->products = new \App\Models\ProductsModel();
        $this->purchase = new \App\Models\PurchaseModel();
        $this->sale = new \App\Models\SaleModel();
    }

    public function purchaseIndex()
    {
        $data['purchases'] = $this->purchase->findAll();
        $products = $this->products->findAll();
        $data['products'] = array_reduce($products, function ($carry, $val) {
            $carry[$val['id']] = $val;
            return $carry;
        });
        $suppliers = $this->customers->findAll();
        $data['suppliers'] = array_reduce($suppliers, function ($carry, $val) {
            $carry[$val['id']] = $val;
            return $carry;
        });
        return $this->render_page('inward_stock.php', $data);
    }
    public function purchasecreate()
    {
        $postdata = $this->request->getPost();
        if (!empty($postdata)) {
            $prod_inventory = $postdata['purchase_inventory'];
            $inventory_arr = [];
            foreach ($prod_inventory as $key => $inventory) {
                foreach ($inventory as $key1 => $value) {
                    $inventory_arr[$key1][$key] = $value;
                }
            }
            $new_inventories = [];
            if (!empty($inventory_arr)) {
                foreach ($inventory_arr as $products) {
                    $temp_inve = $products;
                    if (count(explode('_', $products['prod_id'])) > 1) {
                        list($product_name, $product_id) = explode('_', $products['prod_id']);
                        $stock = ($this->products->find($product_id))['stock'];
                        $prod_update = [
                            'id' => $product_id,
                            'stock' => $products['qty'] + $stock,
                            'category_id' => 1
                        ];
                        $this->products->save($prod_update);
                        $temp_inve['prod_id'] = $product_id;
                    } else {
                        $prod_update = [
                            'name' => $products['prod_id'],
                            'stock' => $products['qty'],
                            'product_rate' => $products['unit_rate'],
                            'measure_in' => $products['mesure_unit'],
                            'status' => 1,
                            'category_id' => 1
                        ];
                        $this->products->save($prod_update);
                        $temp_inve['prod_id'] = $this->products->getInsertID();
                    }
                }
                array_push($new_inventories, $temp_inve);
            }
            $postdata['purchase_inventory'] = json_encode($inventory_arr);
            $postdata['status'] = 1;
            $this->purchase->save($postdata);
            return redirect()->route('purchases');
        }
        $data['suppliers'] = $this->customers->findAll();
        $data['products'] = $this->products->select('id,name')->findAll();
        return $this->render_page('new_purchase.php', $data);
    }
    public function saleIndex()
    {
        $postdata = $this->request->getGetPost();
        $data['sale'] = $this->sale->findAll();
        $products = $this->products->findAll();
        $data['products'] = array_reduce($products, function ($carry, $val) {
            $carry[$val['id']] = $val;
            return $carry;
        });
        $suppliers = $this->customers->findAll();
        $data['suppliers'] = array_reduce($suppliers, function ($carry, $val) {
            $carry[$val['id']] = $val;
            return $carry;
        });
        if ($postdata) {
            if ($postdata['delete']) {
                $del_sale = $this->sale->find($postdata['delete']);
                if ($del_sale) {
                    $del_prods = json_decode($del_sale['sale_inventory']);
                    foreach ($del_prods as $items) {
                        $prod = $this->products->find($items->prod_id);
                        $stock = $prod['stock'] + $items->qty;
                        $this->products->save(['id' => $items->prod_id, 'stock' => $stock]);
                    }
                }
                $this->sale->delete($postdata['delete']);
                return redirect()->route('sales');
            }
        }
        return $this->render_page('sale_invoice.php', $data);
    }
    public function salecreate()
    {
        $postdata = $this->request->getPost();
        if (!empty($postdata)) {
            if (isset($postdata['check_prod_id'])) {
                $data['stock'] = ($this->products->find($postdata['check_prod_id']))['stock'];
                $data['token'] = csrf_hash();
                return $this->response->setJSON($data);
            } elseif (isset($postdata['invoice_check'])) {
                if (strlen($postdata['invoice_check']) == 2) {
                    if (strtolower($postdata['invoice_check']) == 'de' || strtolower($postdata['invoice_check']) == 'bs') {
                        $last_sale_element = array_shift($this->sale->get_last_invoice(strtolower($postdata['invoice_check'])));
                        if (!empty($last_sale_element)) {
                            list($pre, $counter) = explode('/', $last_sale_element['inc_no']);
                            $data['inc_no'] = $pre . '/00' . ($counter + 1);
                            $data['token'] = csrf_hash();
                            $data['status'] = 1;
                        } else {
                            $data['inc_no'] = strtoupper($postdata['invoice_check']) . date('y') . '-' . (date('y') + 1) . '/001';
                            $data['token'] = csrf_hash();
                            $data['status'] = 1;
                        }
                    } else {
                        $data['token'] = csrf_hash();
                        $data['status'] = 0;
                    }
                } else {
                    $data['token'] = csrf_hash();
                    $data['status'] = 0;
                }
                return $this->response->setJSON($data);
            } else {
                $invoice_check = $this->sale->find()->where('inc_no', $postdata['inc_no'])->count();
                if ($invoice_check > 1) {
                    $this->session->set('notify', ['type' => 'warning', 'content' => 'Dublicate Invoice']);
                    return redirect()->route('new_sales');
                }
                $prod_inventory = $postdata['sale_inventory'];
                $inventory_arr = [];
                foreach ($prod_inventory as $key => $inventory) {
                    foreach ($inventory as $key1 => $value) {
                        $inventory_arr[$key1][$key] = $value;
                    }
                }
                if (!empty($inventory_arr)) {
                    foreach ($inventory_arr as $products) {
                        $stock = ($this->products->find($products['prod_id']))['stock'];
                    }
                    foreach ($inventory_arr as $products) {
                        $stock = ($this->products->find($products['prod_id']))['stock'];
                        $prod_update = [
                            'id' => $products['prod_id'],
                            'stock' => $stock - $products['qty'],
                            'category_id' => 1
                        ];
                        $this->products->save($prod_update);
                    }
                }
                $postdata['sale_inventory'] = json_encode($inventory_arr);
                $postdata['status'] = 1;
                $this->sale->save($postdata);
                return redirect()->route('sales');
            }
        }
        $data['suppliers'] = $this->customers->findAll();
        $data['supliers_add'] = array_reduce($data['suppliers'], function ($carry, $val) {
            $carry[$val['id']] = $val;
            return $carry;
        });
        $data['products'] = $this->products->select('id,name')->where('stock>0')->findAll();
        return $this->render_page('new_sale.php', $data);
    }
}
