<?php

namespace App\Http\Middleware;

use App\Models\Panel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureHasPanelAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $panel = $request->route('panel');

        if ($panel instanceof Panel) {
            $panelId = $panel->getKey();
        } else {
            $panelId = (int) $panel;
        }

        if (! $request->user() || ! $request->user()->hasPanelAccess($panelId)) {
            abort(403, 'You do not have access to this panel.');
        }

        return $next($request);
    }
}
