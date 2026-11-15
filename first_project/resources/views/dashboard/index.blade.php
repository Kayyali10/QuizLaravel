
@extends('layout.dashboard')

@section('title', 'Dashboard')

@section('page-heading', 'Dashboard Overview')

@section('content')
<h1>Hello Ahmad</h1>

<div class="stats-container">

        <div class="stat-card">
            <div class="stat-info">
                <h3>Total User</h3>
                <p>{{$totalUsers}}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Lecturers</h3>
                <p>{{$totalUsers}}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Courses</h3>
                <p>{{$totalUsers}}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>Total Lectures</h3>
                <p>{{$totalUsers}}</p>
            </div>
        </div>


@endsection
