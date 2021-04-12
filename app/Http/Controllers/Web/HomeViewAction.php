<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class HomeViewAction extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    public function __invoke(Request $request) : View
    {
        return view('web.pages.index');
    }

    public function detail(Request $request) : View
    {
        return view('web.pages.detail');
    }
}
