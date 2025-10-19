<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Panel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PanelController extends Controller
{
    public function index(): View
    {
        return view('admin.panels.index', [
            'panels' => Panel::query()->latest()->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('admin.panels.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:panels,slug'],
            'description' => ['nullable', 'string'],
            'metadata' => ['array'],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        $panel = Panel::query()->create($validated);

        return redirect()->route('admin.panels.show', $panel)->with('status', __('Panel created successfully.'));
    }

    public function show(Panel $panel): View
    {
        return view('admin.panels.show', compact('panel'));
    }

    public function edit(Panel $panel): View
    {
        return view('admin.panels.edit', compact('panel'));
    }

    public function update(Request $request, Panel $panel): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:panels,slug,'.$panel->id],
            'description' => ['nullable', 'string'],
            'metadata' => ['array'],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        $panel->update($validated);

        return redirect()->route('admin.panels.show', $panel)->with('status', __('Panel updated successfully.'));
    }

    public function destroy(Panel $panel): RedirectResponse
    {
        $panel->delete();

        return redirect()->route('admin.panels.index')->with('status', __('Panel removed.'));
    }
}
