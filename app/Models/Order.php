<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected static function boot() {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = self::generateOrderNumber();
        });
    }

    public static function generateOrderNumber()
    {
        $prefix = 'ORD-';
        $randomNumber = strtoupper(\Str::random(8));

        // Ensure the order number is unique
        while (self::where('order_number', $prefix . $randomNumber)->exists()) {
            $randomNumber = strtoupper(\Str::random(8));
        }

        return $prefix . $randomNumber;
    }

    public function scopeCompletedLastMonth($query)
    {
        $startOfLastMonth = Carbon::now()->startOfMonth()->subMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        return $query->where('status', 'completed')
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
