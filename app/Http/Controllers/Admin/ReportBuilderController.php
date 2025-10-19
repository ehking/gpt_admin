<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataSource;
use App\Models\Panel;
use App\Models\ReportDefinition;
use App\Services\Reports\ReportRunner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportBuilderController extends Controller
{
    public function index(Panel $panel): View
    {
        return view('admin.reports.index', [
            'panel' => $panel,
            'reports' => $panel->reports()->latest()->paginate(),
        ]);
    }

    public function create(Panel $panel): View
    {
        return view('admin.reports.create', [
            'panel' => $panel,
            'dataSources' => DataSource::all(),
        ]);
    }

    public function store(Request $request, Panel $panel): RedirectResponse
    {
        $validated = $this->validateReport($request);

        $report = $panel->reports()->create($validated);
        $this->syncDataSources($report, $validated);

        return redirect()->route('admin.reports.edit', [$panel, $report])->with('status', __('Report created successfully.'));
    }

    public function edit(Panel $panel, ReportDefinition $report): View
    {
        return view('admin.reports.edit', [
            'panel' => $panel,
            'report' => $report->load('dataSources'),
            'dataSources' => DataSource::all(),
        ]);
    }

    public function update(Request $request, Panel $panel, ReportDefinition $report): RedirectResponse
    {
        $validated = $this->validateReport($request, $report->id);

        $report->update($validated);
        $this->syncDataSources($report, $validated);

        return redirect()->route('admin.reports.edit', [$panel, $report])->with('status', __('Report updated successfully.'));
    }

    public function preview(Request $request, Panel $panel, ReportDefinition $report, ReportRunner $runner): View
    {
        $results = $runner->run($report);

        return view('admin.reports.preview', [
            'panel' => $panel,
            'report' => $report,
            'results' => $results,
        ]);
    }

    protected function validateReport(Request $request, ?int $reportId = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:report_definitions,slug,'.($reportId ?? 'null')],
            'description' => ['nullable', 'string'],
            'query' => ['required', 'array'],
            'visualization' => ['required', 'array'],
            'data_sources' => ['array'],
            'data_sources.*' => ['exists:data_sources,id'],
            'mappings' => ['array'],
        ]);
    }

    protected function syncDataSources(ReportDefinition $report, array $validated): void
    {
        if (! empty($validated['data_sources'])) {
            $pivotData = [];
            foreach ($validated['data_sources'] as $sourceId) {
                $pivotData[$sourceId] = [
                    'mapping' => $validated['mappings'][$sourceId] ?? null,
                ];
            }
            $report->dataSources()->sync($pivotData);
        } else {
            $report->dataSources()->detach();
        }
    }
}
