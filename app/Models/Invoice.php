<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The items that belong to the Invoice
     *
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class)->withPivot('qty');
    }

    /**
     * Get the from that owns the Invoice
     *
     */
    public function fromAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'from');
    }

    /**
     * Get the from that owns the Invoice
     *
     */
    public function forAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'for');
    }
}
