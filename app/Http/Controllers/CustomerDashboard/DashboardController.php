<?php

namespace App\Http\Controllers\CustomerDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected $dir = 'backend.dashboard.';
    protected $url = 'dashboard.';

    public function __construct()
    {
        $this->middleware('role:superuser|customer');
        view()->share('url', $this->url);
        view()->share('dir', $this->dir);
    }

    public function index(): View
    {
        return view($this->dir . 'dashboard');
    }

}
