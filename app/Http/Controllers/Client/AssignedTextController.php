<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignedText;

class AssignedTextController extends Controller
{
    public function show(AssignedText $assignedText)
{
    $user = auth()->user();

    if (! $assignedText->assignedUsers->contains($user)) {
        abort(403, 'Unauthorized');
    }

    $assignedText->load('creator');

    return view('client.assigned-texts.show', compact('assignedText'));
}
}
