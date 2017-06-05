<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cat
 *
 * @property string $id
 * @property string $url
 * @property int $rating
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cat whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cat whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cat whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Cat whereUrl($value)
 * @mixin \Eloquent
 */
class Cat extends Model
{
    protected $fillable = ['id', 'url', 'rating'];
    protected $keyType = 'string';
    public $incrementing = false;

    public function getKFactor(): int
    {
        return array_first(config('catmash.k_repartition'), function ($_, $min_rate) {
            return $this->getRating() >= $min_rate;
        });
    }

    public function getRating(): int
    {
        return $this->rating ?? config('catmash.default_rating');
    }
}
