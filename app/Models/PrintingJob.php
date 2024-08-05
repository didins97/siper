<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintingJob extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot() {
        parent::boot();

        static::updating(function ($model) {
            $order = $model->order;
            switch ($model->status) {
                case 'completed':
                    $order->status = 'completed';
                    $model->end_date = now();
                    break;
                case 'processing':
                    $order->status = 'inprogress';
                    $model->end_date = null;
                    break;
                case 'cancelled':
                    $order->status = 'pending';
                    $model->end_date = null;
                    break;
                default:
                    $order->status = 'inprogress';
                    $model->end_date = null;
                    break;
            }

            $order->save();
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
