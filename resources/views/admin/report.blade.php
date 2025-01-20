@extends('layout.partials._head')
@section('content')

<style>
    
    body{
    background-color: #e8f1fb;
}
.card-header {
    display: flex;
    justify-content: space-between;
    background-color: #fff;
    align-items: center;
}
.card-header-meow{
    display: flex;
    justify-content: flex-end;
    /* height: 100px; */

}

.card-d{
    box-shadow: 0 10px 20px 10px rgba(0, 0, 0, 0.1);
    margin-top: 0;
    padding: 0;
}
.tab-pane{
    background-color: #fff;

}
.nav-tab{
    display: flex;
    background-color: #e8f1fb;
}
.nav-link :active{
    border: none;
}
/* .nav-link:hover{
    background-color: #a8c4e5;
} */

.containner{
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #b3b5b7;
    padding-top: 10px;
}

.containner p, h3{
    margin:0;
}
.print{
    background-color: #0c8c00;
    color: #fff;
    border: none;
    padding: 6px;
    margin-top: 25px 0 25px 0;
    border-radius: 4px;
    height: fit-content;
    text-decoration: none;
}

#reportTabs{
    display: flex;
    margin: 0;
}
.nav-link.active {
    background-color: #007bff;
    color: white;
}
.nav-link {
    transition: background-color 0.3s ease;
}
    form {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-outline input {
        width: 100%;
        padding: 10px 10px 10px 40px;
        border: 1px solid #CFE2FF;
        border-radius: 4px 0 0 4px;
    }

    .btn-primary {
        padding: 10px ;
        border-radius: 0 4px 4px 0;
    }
    
    h6{
        margin:0;
        padding:0;
        font-weight: 500;
    }
    
    img{
        height: 50px;
        width: auto;
    }

    .result {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #CFE2FF;
        border-radius: 4px;
    }

    .result ul {
        list-style: none;
        padding: 0;
    }

    .result ul li {
        margin: 5px 0;
    }

    .result ul li a {
        text-decoration: none;
        color: #007bff;
    }

    .result ul li a:hover {
        text-decoration: underline;
    }


</style>
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
