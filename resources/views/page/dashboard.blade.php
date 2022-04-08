@extends('layout.master')
@section('heading_title', __('dashboard.heading_title'))
@section('content')
  {{-- group devices start --}}
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ __('device.group_title') }}&nbsp;({{ count($device_groups) }})</h3>
    </div>
    <div class="card-body">
      <div class="row">
        @foreach($device_groups as $device_group)
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">{{ $device_group['name'] }}</span>
                <span class="info-box-number">{{ $device_group['createdTimeFormat'] }}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  {{-- group devices end --}}
  {{-- group asset start --}}
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ __('asset.group_title') }}&nbsp;({{ count($asset_groups) }})</h3>
    </div>
    <div class="card-body">
      <div class="row">
        @foreach($asset_groups as $asset_group)
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">{{ $asset_group['name'] }}</span>
                <span class="info-box-number">{{ $asset_group['createdTimeFormat'] }}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  {{-- group asset end --}}
  {{-- group dashboard start --}}
  <div class="card dashboard-card">
    <div class="card-header">
      <h3 class="card-title">{{ __('th_dashboard.group_title') }}&nbsp;({{ count($dashboard_groups) }})</h3>
    </div>
    <div class="card-body">
      <div class="row">
        @foreach($dashboard_groups as $dashboard_group)
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">{{ $dashboard_group['name'] }}</span>
                <a href="{{ route('dashboard_groups.list_info', $dashboard_group['id']['id'] ?? '') }}" class="link-item">
                  <i class="fas fa-arrow-circle-right"></i>
                </a>
                <a href="javascript:;" class="link-item">
                  <i class="fas fa-user"></i>
                </a>
                <a href="javascript:;" class="link-item">
                  <i class="fas fa-share-alt"></i>
                </a>
                <a href="javascript:;" class="link-item">
                  <i class="fas fa-arrow-left"></i>
                </a>
                <a href="javascript:;" class="link-item">
                  <i class="fas fa-trash"></i>
                </a>
                <span class="info-box-number">{{ $dashboard_group['createdTimeFormat'] }}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  {{-- group dashboard end --}}
@endsection