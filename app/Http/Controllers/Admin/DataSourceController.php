<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataSource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DataSourceController extends Controller
{
    public function index(): View
    {
        return view('admin.data-sources.index', [
            'dataSources' => DataSource::query()->latest()->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('admin.data-sources.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'driver' => ['required', 'string', 'max:255'],
            'configuration' => ['required', 'array'],
        ]);

        DataSource::query()->create($validated);

        return redirect()->route('admin.data-sources.index')->with('status', __('Data source created.'));
    }

    public function edit(DataSource $dataSource): View
    {
        return view('admin.data-sources.edit', compact('dataSource'));
    }

    public function update(Request $request, DataSource $dataSource): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'driver' => ['required', 'string', 'max:255'],
            'configuration' => ['required', 'array'],
        ]);

        $dataSource->update($validated);

        return redirect()->route('admin.data-sources.index')->with('status', __('Data source updated.'));
    }

    public function destroy(DataSource $dataSource): RedirectResponse
    {
        $dataSource->delete();

        return redirect()->route('admin.data-sources.index')->with('status', __('Data source removed.'));
    }
}
