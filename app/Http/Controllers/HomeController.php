<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Post;
use App\Models\Order;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            $totalClients = Client::count();
            $totalPosts = Post::count();
            $totalFeaturedPosts = Post::where('featured', true)->count();
            $totalServices = Service::count();
            $totalFeaturedServices = Service::where('featured', true)->count();
            $totalBilled = Order::whereIn('status', ['paid', 'completed'])->sum('total_price');

            $topServices = DB::table('orders_have_services')
                ->select('service_id', DB::raw('COUNT(*) as total'))
                ->groupBy('service_id')
                ->orderByDesc('total')
                ->limit(3)
                ->get();

            foreach ($topServices as $service) {
                $service->name = Service::find($service->service_id)?->service_name ?? 'Desconocido';
            }

            $bestMonthRaw = Order::whereIn('status', ['paid', 'completed'])
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_price) as total')
                ->groupBy('month')
                ->orderByDesc('total')
                ->first();

            $bestMonth = null;

            if ($bestMonthRaw) {
                Carbon::setLocale('es');
                $parsedMonth = Carbon::createFromFormat('Y-m', $bestMonthRaw->month);
                $bestMonth = (object)[
                    'month' => ucfirst($parsedMonth->translatedFormat('F Y')),
                    'total' => $bestMonthRaw->total,
                ];
            }

            return view('welcome', [
                'totalClients' => $totalClients,
                'totalPosts' => $totalPosts,
                'totalFeaturedPosts' => $totalFeaturedPosts,
                'totalServices' => $totalServices,
                'totalFeaturedServices' => $totalFeaturedServices,
                'totalBilled' => $totalBilled,
                'topServices' => $topServices,
                'bestMonth' => $bestMonth
            ]);
        }

        return view("welcome");
    }
}
