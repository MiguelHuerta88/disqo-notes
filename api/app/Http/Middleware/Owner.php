<?php

namespace App\Http\Middleware;

use Closure;

class Owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // pull the passed in user_id
        $userId = $request->user()->id;
        $params = $request->route()->parameters();

        // by the time we reach this middleware for this route we should have a notes object
        $note = isset($params['notes']) ? $params['notes'] : null;
        $noteId = $note ? $note->id : null;
       
        //if no userId dont continue
        if (!$noteId) {
            return response()->json([
                'data' => [
                    'message' => 'Missing id param. Cannot continue until this is passed to request'
                ]
            ]);
        }
        // next user_id on notes obj must match logged in user
        if ($note->user_id == $userId) {
            // check to make sure that logged in user is the owner of the note
            return $next($request);
        }
        // check to make sure that logged in user is the owner of the note
        return response()->json([
            'data' => [
                'message' => 'You\'re not the owner. Cannot modify note'
            ]
        ]);
    }
}
