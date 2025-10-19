<?php

namespace App\Services\Reports;

use App\Models\ReportDefinition;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class ReportRunner
{
    public function __construct(private ?Client $httpClient = null)
    {
        $this->httpClient = $httpClient ?? new Client(['timeout' => config('panel.report_builder.default_timeout', 10)]);
    }

    public function run(ReportDefinition $report): array
    {
        $results = [];
        foreach ($report->dataSources as $dataSource) {
            $results[] = [
                'data_source' => $dataSource->name,
                'payload' => $this->executeDataSource($dataSource->driver, $dataSource->configuration, $report->query),
            ];
        }

        return [
            'report' => $report->only(['name', 'description']),
            'visualization' => $report->visualization,
            'results' => $results,
        ];
    }

    protected function executeDataSource(string $driver, array $configuration, array $query): mixed
    {
        return match ($driver) {
            'http' => $this->executeHttp($configuration, $query),
            'internal' => $this->executeInternal($configuration, $query),
            default => null,
        };
    }

    protected function executeHttp(array $configuration, array $query): mixed
    {
        $method = strtoupper($configuration['method'] ?? 'GET');
        $url = $configuration['url'] ?? '';
        $options = [
            'query' => $method === 'GET' ? Arr::get($query, 'filters', []) : [],
            'json' => $method !== 'GET' ? $query : [],
            'headers' => $configuration['headers'] ?? [],
            'timeout' => $configuration['timeout'] ?? config('panel.report_builder.default_timeout', 10),
        ];

        $response = $this->httpClient->request($method, $url, $options);

        return json_decode($response->getBody()->getContents(), true) ?? [];
    }

    protected function executeInternal(array $configuration, array $query): mixed
    {
        $endpoint = $configuration['endpoint'] ?? null;
        if (! $endpoint) {
            return [];
        }

        $response = Http::timeout($configuration['timeout'] ?? config('panel.report_builder.default_timeout', 10))
            ->{$configuration['method'] ?? 'post'}($endpoint, $query);

        return $response->json();
    }
}
