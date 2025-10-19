<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Panel;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PanelUserController extends Controller
{
    public function index(Panel $panel): View
    {
        return view('admin.panels.users', [
            'panel' => $panel->load('users'),
            'availableUsers' => User::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request, Panel $panel): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'role' => ['required', 'string'],
        ]);

        $panel->users()->syncWithoutDetaching([
            $validated['user_id'] => ['role' => $validated['role']],
        ]);

        return redirect()->route('admin.panels.users.index', $panel)->with('status', __('User assigned to panel.'));
    }

    public function destroy(Panel $panel, User $user): RedirectResponse
    {
        $panel->users()->detach($user);

        return redirect()->route('admin.panels.users.index', $panel)->with('status', __('User removed from panel.'));
    }
}
