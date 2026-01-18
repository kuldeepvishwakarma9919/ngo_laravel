<?php

use App\Http\Controllers\Member\MemberDashboard;
use Illuminate\Support\Facades\Route;


Route::middleware(['web', 'auth'])
    ->prefix('member')
    ->group(function () {

        Route::get('/dashboard', [MemberDashboard::class, 'index'])->name('member.dashboard');

    });
