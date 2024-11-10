<?php

namespace Theme\Default\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Theme\Default\Models\Visitor;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
  /**
   * get website visitors report
   * @param Request $request
   * @return Response
   */
  public function visitorReports(Request $request)
  {
    if ($request['type'] == 'monthly') {
      $times = [];
      $visitors = [];

      for ($i = 11; $i >= 0; $i--) {
        $month = now()->subMonths($i);
        $visitorsCount = Visitor::whereYear('visited_at', $month->year)
          ->whereMonth('visited_at', $month->month)
          ->count();

        $times[] = $month->shortMonthName;
        $visitors[] = $visitorsCount;
      }

      return response()->json([
        'success' => true,
        'times' => $times,
        'visitors' => $visitors,
      ]);
    }

    if ($request['type'] == 'daily') {
      $times = [];
      $visitors = [];
      for ($i = 29; $i >= 0; $i--) {

        $day = Carbon::today()->endOfDay()->subDay($i);
        $total_visitors = Visitor::whereDate('visited_at', $day)->count();
        array_push($visitors, $total_visitors);

        array_push($times, $day->format('d M'));
    }

      return response()->json([
        'success' => true,
        'times' => $times,
        'visitors' => $visitors,
      ]);
    }
  }
}
