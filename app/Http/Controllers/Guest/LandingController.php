<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\JadwalUjianModel;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    protected $table;

    public function __construct(JadwalUjianModel $table)
    {
        $this->table = $table;
    }

    public function index()
    {
        $data = $this->table->get();
        return view('guest')->with([
            'data' => $data
        ]);
    }
}
