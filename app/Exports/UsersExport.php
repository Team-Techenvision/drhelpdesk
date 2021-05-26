<?php

namespace App\Exports;

use App\User;
use App\Order;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class UsersExport implements FromView
{
    use Exportable;
    protected $request;

    function __construct($request)
    {
        $this->request = $request;
    }
    public function view(): View
    {
        $orderData =$this->request;
        return view('admin.components.admin_view_order_export', compact('orderData'));
    }
}
