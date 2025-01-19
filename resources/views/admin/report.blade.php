@extends('layout.partials._head')
@section('content')

@vite('resources/css/report.css')
<div class="container mt-3">
<ul class="nav-tab nav-tabs display-flex" id="reportTabs" role="tablist" style="list-style: none; padding: 0;">
    <li class="nav-item" role="presentation">
        <button
            class="nav-link {{ request()->hasAny(['month', 'search']) ? '' : 'active' }}"
            id="daily-tab"
            data-bs-toggle="tab"
            data-bs-target="#daily"
            type="button"
            role="tab"
            aria-controls="daily"
            aria-selected="{{ request()->hasAny(['month', 'search']) ? 'false' : 'true' }}"
            style="font-weight: bold; text-decoration:none; border: none; border-radius: 0; padding: 10px 20px;"
        >
            DAILY
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button
            class="nav-link {{ request()->hasAny(['month', 'search']) ? 'active' : '' }}"
            id="monthly-tab"
            data-bs-toggle="tab"
            data-bs-target="#monthly"
            type="button"
            role="tab"
            aria-controls="monthly"
            aria-selected="{{ request()->hasAny(['month', 'search']) ? 'true' : 'false' }}"
            style="font-weight: bold; text-decoration:none; border: none; border-radius: 0; padding: 10px 20px;"
        >
            MONTHLY
        </button>
    </li>
</ul>


        
@include('admin.download.tab-daily')
@include('admin.download.tab-monthly')
@include('admin.search-instructor')

@endsection
