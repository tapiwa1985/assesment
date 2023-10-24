<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = 'booking_id';

    /**
     * @var string $table
     */
    protected $table = 'bookings';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'reason',
        'user_id',
        'date_booked'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
