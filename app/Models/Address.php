<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's naming convention
    protected $table = 'addresses';

    // Define the primary key if it doesn't follow Laravel's naming convention
    protected $primaryKey = 'address_id';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'user_id',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kabupaten',
        'kode_pos',
        'nomor_hp',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
