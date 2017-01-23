<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Transactions extends Model
{

    use softDeletes;
    /**
     * nombre de la tabla
     * @var string
     */
    protected $table = 'transactions';
    /**
     * columna primaria
     */
    protected $primaryKey = 'transactions_id';

    /**
     * campos a asignar masivamente, para llenar
     */
    protected $fillable = [
        'name',
        'amount',
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }
}
