<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
	/**
	 * Table to be used
	 *
	 * @var        string
	 */
    public $table = 'notes';

    /**
     * Mass assignment arraty
     *
     * @var        array
     */
    protected $fillable = ['user_id', 'title', 'note', 'created_at', 'updated_at'];

    /**
     * scope function
     *
     * @param      <type>  $query   The query
     * @param      <type>  $userId  The user identifier
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
