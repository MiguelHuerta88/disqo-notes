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
}
