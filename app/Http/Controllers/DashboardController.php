<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Esccort;
use App\Role;
use App\Transaksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function user(Request $request)
    {
        if ($request->ajax()) {
            // Pengaturan hari
            $date_start = Carbon::now()->subDays(6)->toDateString();    // 7 hari - 1 hari
            $date_end = Carbon::now()->toDateString();
            $period = Carbon::parse($date_start)->daysUntil($date_end);

            // Ini customer
            foreach ($period as $date) {
                $date = $date->toDateString();
                $count = User::whereDate('created_at', $date)
                    ->whereHas('roles', function($q) {
                        $q->where('name', '!=', 'ROLE_ADMIN');  // Ini hardcoded
                    })
                    ->get()
                    ->count();
                $dates[] = $date;
                $count_customers[] = $count;
            }
            // Ini CG
            // foreach ($period as $date) {
            //     $date = $date->toDateString();
            //     $count = Esccort::whereDate('created_at', $date)
            //         ->get()
            //         ->count();
            //     // $dates[] = $date;
            //     $count_cgs[] = $count;
            // }

            return response()->json([$dates, $count_customers]);
            // return response()->json([$dates, $count_customers, $count_cgs]);
        }
        // Untuk debug. Comment/hapus klo tidak butuh.
        else {
        }
    }

    public function pemesanan(Request $request)
    {
        if ($request->ajax()) {
            // Pengaturan hari
            $date_start = Carbon::now()->subDays(6)->toDateString();    // 7 hari - 1 hari
            $date_end = Carbon::now()->toDateString();
            $period = Carbon::parse($date_start)->daysUntil($date_end);

            // Ini jumlah pemesanan
            foreach ($period as $date) {
                $date = $date->toDateString();
                $order = Transaksi::whereDate('order_time', $date)
                    ->get()
                    ->count();
                $dates[] = $date;
                $orders[] = $order;
            }
            // Ini jumlah pendapatan
            foreach ($period as $date) {
                $date = $date->toDateString();
                $income = Transaksi::whereDate('order_time', $date)
                    ->sum('total_bayar');
                // $dates[] = $date;    // Tidak perlu ini biar gk dobel tanggalnya
                $incomes[] = $income;
            }

            return response()->json([$dates, $orders, $incomes]);
        }
        // Untuk debug. Comment/hapus klo tidak butuh.
        else {
            // $date_start = Carbon::now()->subDays(6)->toDateString();    // 7 hari - 1 hari
            // $date_end = Carbon::now()->toDateString();
            // $period = Carbon::parse($date_start)->daysUntil($date_end);

            // // $dates = [];
            // // $orders = [];
            // // $incomes = [];
            // foreach ($period as $date) {
            //     $date = $date->toDateString();
            //     $order = Transaksi::whereDate('order_time', $date)
            //         ->get()
            //         ->count();
            //     $dates[] = $date;
            //     $orders[] = $order;
            // }
            // foreach ($period as $date) {
            //     $date = $date->toDateString();
            //     $income = Transaksi::whereDate('order_time', $date)
            //         ->sum('total_bayar');
            //     // $dates[] = $date;
            //     $incomes[] = $income;
            // }

            // // return response()->json([$dates, $orders]);
            // // return response()->json([$dates, $incomes]);
            // return response()->json([$dates, $orders, $incomes]);
        }
    }
}
