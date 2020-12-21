<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{

    public $timestamps = true;
    protected $table = 'borrowings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'during', 'quantity', 'user_id', 'book_id', 'isBorrow'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'delivred_date', 'remaining_days'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'integer',
        'isBorrow' => 'boolean',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function mostViewed(){
        $collection = Borrowing::all()->groupBy('book_id');

        $sorted = $collection->sortByDesc(function ($values, $key) {
            return $values->count();
        });
        return $sorted;
    }

    public function getDelivredDateAttribute(){
        return $this->created_at->addDays($this->during);
    }

    public function getRemainingDaysAttribute(){
        return $this->delivred_date->diffForHumans(Carbon::now());
    }
}
