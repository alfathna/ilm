<?php

namespace App\Http\Middleware;

use App\Models\News;
use App\Models\ViewLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class IncrementViewCount
{
    /**
     * Handle an incoming request.
     *
     * Increments the view counter for a news article using session
     * to avoid duplicate counts from the same session.
     * Also records a daily view log for accurate chart data.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route('slug');

        if ($slug) {
            $news = News::where('slug', $slug)->first();

            if ($news) {
                $sessionKey = "viewed_news_{$news->id}";

                if (!$request->session()->has($sessionKey)) {
                    $news->increment('views');

                    // Log the daily view (one entry per unique session per article per day)
                    ViewLog::create([
                        'viewable_type' => News::class,
                        'viewable_id'   => $news->id,
                        'viewed_date'   => Carbon::today()->toDateString(),
                    ]);

                    $request->session()->put($sessionKey, true);
                }
            }
        }

        return $next($request);
    }
}
