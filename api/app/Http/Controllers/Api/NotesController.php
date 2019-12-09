<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNoteRequest;
use App\Models\Notes;
use App\Http\Resources\Note as NotesResource;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NotesCollection;
use Auth;

class NotesController extends Controller
{
	/**
	 * @var Notes model instance
	 */
	public $notes;

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
    	return new NotesResource(Notes::create($request->all()));
    }

    /**
     * View a note
     *
     * @param      \App\Models\Notes  $notes  The notes
     *
     * @return     NotesResource      ( description_of_the_return_value )
     */
    public function view(Notes $notes)
    {
    	// we bind the model to the request so all we have to do is just return the resource
    	return new NotesResource($notes);
    }

    /**
     * Update function
     *
     * @param      \App\Http\Requests\UpdateNoteRequest  $request  The request
     * @param      \App\Models\Notes                     $notes    The notes
     *
     * @return     NotesResource                         ( description_of_the_return_value )
     */
    public function update(UpdateNoteRequest $request, Notes $notes)
    {
    	// update the note and return it
    	$notes->update($request->all());

    	return new NotesResource($notes);
    }

    /**
     * Delete note
     *
     * @param      \App\Models\Notes  $notes  The notes
     *
     * @return     <type>             ( description_of_the_return_value )
     */
    public function delete(Notes $notes)
    {
    	// delete the model and return a json response
    	$notes->delete();

    	return response()->json([
    		'data' => [
    			'message' => 'Note was delete from our database'
    		]
    	]);
    }

    /**
     * get all notes by this user
     *
     * @return     NotesCollection  ( description_of_the_return_value )
     */
    public function all()
    {
    	$userId = Auth::user()->id;

    	return new NotesCollection(Notes::byUser($userId)->orderBy('id', 'desc')->get());
    }
}
