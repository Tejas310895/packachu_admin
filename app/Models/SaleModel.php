<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table      = 'sale';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'inc_no',
        'customer_id',
        'invoice_date',
        'shipped_date',
        'sale_inventory',
        'billing_add',
        'billing_state_code',
        'shipping_add',
        'shipping_state_code',
        'transport_name',
        'transport_number',
        'status'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;

    function get_last_invoice($pre)
    {
        return $this->where('LOWER(mid(inc_no,1,2))', strtolower($pre))->orderBy('SUBSTRING(inc_no, 9)')->find();
    }
}
