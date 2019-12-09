<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNoteRequest;
use App\Models\Notes;
use App\Http\Resources\Note as NotesResource;

class NotesController extends Controller
{
	/**
	 * @var Notes model instance
	 */
	public $notes;

	/**
	 * Constructor
	 *
	 * @param      \App\Models\Notes  $note   The note
	 */
	public function __construct(Notes $note)
	{
		$this->notes = $note;
	}

	/**
	 * Create note
	 *
	 * @param  \App\Http\Requests\CreateNoteRequest  $request  The request
	 *
	 * @return Resource
	 */
    public function create(CreateNoteRequest $request)
    {
    	// we will create the note and return a Resource
    	return new NotesResource($this->notes->create($request->all()));
    }
}
