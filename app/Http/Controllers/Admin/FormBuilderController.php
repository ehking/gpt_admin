<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataSource;
use App\Models\FormDefinition;
use App\Models\Panel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FormBuilderController extends Controller
{
    public function index(Panel $panel): View
    {
        return view('admin.forms.index', [
            'panel' => $panel,
            'forms' => $panel->forms()->latest()->paginate(),
        ]);
    }

    public function create(Panel $panel): View
    {
        return view('admin.forms.create', [
            'panel' => $panel,
            'dataSources' => DataSource::all(),
        ]);
    }

    public function store(Request $request, Panel $panel): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'schema' => ['required', 'array'],
            'submit_handler' => ['nullable', 'url'],
            'data_sources' => ['array'],
            'data_sources.*' => ['exists:data_sources,id'],
            'mappings' => ['array'],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        $form = $panel->forms()->create($validated);

        if (! empty($validated['data_sources'])) {
            $pivotData = [];
            foreach ($validated['data_sources'] as $sourceId) {
                $pivotData[$sourceId] = [
                    'mapping' => $validated['mappings'][$sourceId] ?? null,
                ];
            }
            $form->dataSources()->sync($pivotData);
        }

        $this->persistSchemaSnapshot($form);

        return redirect()
            ->route('admin.panels.forms.edit', [$panel, $form])
            ->with('status', __('Form created successfully.'));
    }

    public function edit(Panel $panel, FormDefinition $form): View
    {
        return view('admin.forms.edit', [
            'panel' => $panel,
            'form' => $form->load('dataSources'),
            'dataSources' => DataSource::all(),
        ]);
    }

    public function update(Request $request, Panel $panel, FormDefinition $form): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'schema' => ['required', 'array'],
            'submit_handler' => ['nullable', 'url'],
            'data_sources' => ['array'],
            'data_sources.*' => ['exists:data_sources,id'],
            'mappings' => ['array'],
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        $form->update($validated);

        if (! empty($validated['data_sources'])) {
            $pivotData = [];
            foreach ($validated['data_sources'] as $sourceId) {
                $pivotData[$sourceId] = [
                    'mapping' => $validated['mappings'][$sourceId] ?? null,
                ];
            }
            $form->dataSources()->sync($pivotData);
        } else {
            $form->dataSources()->detach();
        }

        $this->persistSchemaSnapshot($form);

        return redirect()
            ->route('admin.panels.forms.edit', [$panel, $form])
            ->with('status', __('Form updated successfully.'));
    }

    protected function persistSchemaSnapshot(FormDefinition $form): void
    {
        $disk = config('panel.form_builder.storage_disk', 'local');
        $path = sprintf('forms/%s.json', $form->slug);

        Storage::disk($disk)->put($path, json_encode($form->schema, JSON_PRETTY_PRINT));
    }
}
