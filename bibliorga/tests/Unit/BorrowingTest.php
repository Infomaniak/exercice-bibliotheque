<?php

namespace Tests\Unit;

use App\Models\Borrowing;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BorrowingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testMostViewed(){
        $collection = Borrowing::all()->groupBy('book_id');
        print_r($collection);
        $sorted = $collection->sortBy(function ($values, $key) {
            return $values->count();
        });
        print_r($sorted);
        return $sorted;
    }
}
