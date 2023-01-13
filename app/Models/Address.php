<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    /**
     * Get all of the invoices for the Address
     *
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
