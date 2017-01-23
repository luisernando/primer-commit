<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Customer extends Model
{
    use softDeletes;
    /**
     * nombre de la tabla
     * @var string
     */
    protected $table = 'customers';
    /**
     * columna primaria
     */
    protected $primaryKey = 'id';

    /**
     * campos a asignar masivamente, para llenar
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
    ];

    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }
}
