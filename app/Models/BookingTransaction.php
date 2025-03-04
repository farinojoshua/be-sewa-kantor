<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone_number',
        'booking_trx_id',
        'is_paid',
        'started_at',
        'total_amount',
        'duration',
        'ended_at',
        'office_space_id',
    ];

    public static function generateUniqueBookingTrxId(): string
    {
        $prefix = 'FO';
        do {
            $bookingTrxId = $prefix . mt_rand(1000, 9999);
        } while (self::where('booking_trx_id', $bookingTrxId)->exists());

        return $bookingTrxId;
    }

    public function officeSpace(): BelongsTo
    {
        return $this->belongsTo(OfficeSpace::class, 'office_space_id');
    }
}
