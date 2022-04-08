@extends('layout.master')
@section('heading_title', __('dashboard.heading_title'))
@section('content')
  {{-- group devices start --}}
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ __('device.group_title') }}</h3>
    </div>
    <div class="card-body">
      <div class="row">
        @foreach($device_groups as $device_group)
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">{{ $device_group['name'] }}</span>
                <span class="info-box-number">{{ $device_group['createdTime'] }}</span>
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
      <h3 class="card-title">{{ __('asset.group_title') }}</h3>
    </div>
    <div class="card-body">
      <div class="row">
        @foreach($asset_groups as $asset_group)
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">{{ $asset_group['name'] }}</span>
                <span class="info-box-number">{{ $asset_group['createdTime'] }}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  {{-- group asset end --}}
@endsection