<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasUuid;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The primary key's datatype.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The ID field is a UUID
     *
     * @var bool
     */
    protected bool $primaryKeyIsUuid = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
        'payer_id',
        'user_id',
        'type',
        'category',
        'status',
        'description',
    ];

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
