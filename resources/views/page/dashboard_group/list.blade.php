@extends('layout.master')
@section('heading_title', ($current_entity_info['name'] ?? '') . ' - ' . __('th_dashboard.group_title'))
@section('content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ ($current_entity_info['name'] ?? '') . ' : ' . __('th_dashboard.group_title') }}</h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
        <tr>
          <th>{{ __('th_dashboard.column_date_created') }}</th>
          <th>{{ __('th_dashboard.column_title') }}</th>
          <th>{{ __('th_dashboard.column_action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list_data['data'] as $item)
          <tr>
            <td>{{ $item['createdTimeFormat'] }}</td>
            <td>{{ $item['name'] }}</td>
            <td>
              <a href="{{ route('dashboard_groups.detail', $item['id']['id'] ?? '') }}" class="btn btn-primary">
                <i class="fas fa-arrow-circle-right"></i>
                <span>{{ __('th_dashboard.btn_open') }}</span>
              </a>
              <a href="{{ route('dashboard_groups.detail_export', $item['id']['id'] ?? '') }}" class="btn btn-secondary">
                <i class="fas fa-download"></i>
                <span>{{ __('th_dashboard.btn_export') }}</span>
              </a>
              <a href="javascript:;" class="btn btn-danger">
                <i class="fas fa-trash"></i>
                <span>{{ __('th_dashboard.btn_trash') }}</span>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection