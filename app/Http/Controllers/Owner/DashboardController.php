<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    // Lấy tổng số liệu từ database
    $totalRevenue = DB::table('TbDonHang')->sum('tongTien'); // Tổng doanh thu
    $totalProducts = DB::table('TbSanPham')->count();        // Tổng số sản phẩm
    $totalOrders = DB::table('TbDonHang')->count();          // Tổng số đơn hàng
    $totalCategories = DB::table('TbDanhMuc')->count();      // Tổng số danh mục

    // Xử lý dữ liệu biểu đồ doanh thu
    $timeRange = $request->input('timeRange', 'all'); 

    $query = DB::table('TbDonHang')
        ->select(DB::raw('DATE(ngayDatHang) as date'), DB::raw('SUM(tongTien) as revenue'))
        ->groupBy('date')
        ->orderBy('date', 'asc');

    if ($timeRange === '7') {
        $query->where('ngayDatHang', '>=', now()->subDays(7));
    } elseif ($timeRange === '30') {
        $query->where('ngayDatHang', '>=', now()->subDays(30));
    } elseif ($timeRange === '90') {
        $query->where('ngayDatHang', '>=', now()->subDays(90));
    }

    $chartData = $query->get();

    // Tách dữ liệu biểu đồ thành các mảng
    $chartDates = $chartData->pluck('date')->toArray();
    $chartRevenues = $chartData->pluck('revenue')->toArray();

    // Truyền dữ liệu sang view
    return view('owner.dashboard.index', compact(
        'totalRevenue',
        'totalProducts',
        'totalOrders',
        'totalCategories',
        'chartDates',
        'chartRevenues',
        'timeRange'
    ));
}

}
