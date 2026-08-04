@extends('voyager::master')
@php
  $edit = !is_null($dataTypeContent->getKey());
  $add = is_null($dataTypeContent->getKey());
@endphp
@section('page_title', __('voyager::generic.' . (isset($dataTypeContent->id) ? 'edit' : 'add')) . ' ' .
  $dataType->getTranslatedAttribute('display_name_singular'))

@section('css')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
  <h1 class="page-title">
    <i class="{{ $dataType->icon }}"></i>
    {{ __('voyager::generic.' . (isset($dataTypeContent->id) ? 'edit' : 'add')) . ' ' . $dataType->getTranslatedAttribute('display_name_singular') }}
  </h1>
@stop

@section('content')
  <div class="page-content container-fluid">
    <form class="form-edit-add" role="form"
      action="@if (!is_null($dataTypeContent->getKey())) {{ route('voyager.' . $dataType->slug . '.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.' . $dataType->slug . '.store') }} @endif"
      method="POST" enctype="multipart/form-data" autocomplete="off">
      <!-- PUT Method if we are editing -->
      @if (isset($dataTypeContent->id))
        {{ method_field('PUT') }}
      @endif
      {{ csrf_field() }}

      <div class="row">
        <div class="col-md-8">
          <div class="panel panel-bordered">
            {{-- <div class="panel"> --}}
            @if (count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="panel-body">
              <div class="form-group">
                <label for="name">{{ __('voyager::generic.name') }}</label>
                <input type="text" class="form-control" id="name" name="name"
                  placeholder="{{ __('voyager::generic.name') }}"
                  value="{{ old('name', $dataTypeContent->name ?? '') }}">
              </div>

              <div class="form-group">
                <label for="email">{{ __('voyager::generic.email') }}</label>
                <input type="email" class="form-control" id="email" name="email"
                  placeholder="{{ __('voyager::generic.email') }}"
                  value="{{ old('email', $dataTypeContent->email ?? '') }}">
              </div>


              {{-- Custom --}}
              <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại"
                  value="{{ old('phone', $dataTypeContent->phone ?? '') }}">
              </div>

              <div class="form-group">
                <label for="branch_id">ID chi họ</label>
                <input type="text" class="form-control" id="branch_id" name="branch_id" placeholder="ID chi họ"
                  value="{{ old('branch_id', $dataTypeContent->branch_id ?? '') }}">
              </div>

              <div class="form-group">
                <label for="ngay_gia_han">Ngày gia hạn</label>
                <input type="datetime-local" class="form-control" id="ngay_gia_han" name="ngay_gia_han"
                  value="{{ old('ngay_gia_han', $dataTypeContent->ngay_gia_han ?? '') }}">
              </div>

              <div class="form-group">
                <label for="loai_dich_vu">Loại dịch vụ</label>
                <input type="number" class="form-control" id="loai_dich_vu" name="loai_dich_vu"
                  value="{{ old('loai_dich_vu', $dataTypeContent->loai_dich_vu ?? '') }}">
              </div>

              <div class="form-group">
                <label for="so_ngay_han">Số ngày gia hạn</label>
                <input type="number" class="form-control" id="so_ngay_han" name="so_ngay_han"
                  placeholder="Số ngày gia hạn" value="{{ old('so_ngay_han', $dataTypeContent->so_ngay_han ?? '') }}">
              </div>

              <div class="form-group">
                <label for="template">ID Template</label>
                <input type="number" class="form-control" id="template" name="template"
                  placeholder="ID của Template người dùng"
                  value="{{ old('template', $dataTypeContent->template ?? '') }}">
              </div>
              {{-- End Custom --}}

              <div class="form-group">
                <label for="password">{{ __('voyager::generic.password') }}</label>
                @if (isset($dataTypeContent->password))
                  <br>
                  <small>{{ __('voyager::profile.password_hint') }}</small>
                @endif
                <input type="password" class="form-control" id="password" name="password" value=""
                  autocomplete="new-password">
              </div>

              @can('editRoles', $dataTypeContent)
                <div class="form-group">
                  <label for="default_role">{{ __('voyager::profile.role_default') }}</label>
                  @php
                    $dataTypeRows = $dataType->{isset($dataTypeContent->id) ? 'editRows' : 'addRows'};

                    $row = $dataTypeRows->where('field', 'user_belongsto_role_relationship')->first();
                    $options = $row->details;
                  @endphp
                  @include('voyager::formfields.relationship')
                </div>
                <div class="form-group">
                  <label for="additional_roles">{{ __('voyager::profile.roles_additional') }}</label>
                  @php
                    $row = $dataTypeRows->where('field', 'user_belongstomany_role_relationship')->first();
                    $options = $row->details;
                  @endphp
                  @include('voyager::formfields.relationship')
                </div>
              @endcan

              @php
                if (isset($dataTypeContent->locale)) {
                    $selected_locale = $dataTypeContent->locale;
                } else {
                    $selected_locale = config('app.locale', 'en');
                }
              @endphp

              <div class="form-group">
                <label for="locale">{{ __('voyager::generic.locale') }}</label>
                <select class="form-control select2" id="locale" name="locale">
                  @foreach (Voyager::getLocales() as $locale)
                    <option value="{{ $locale }}" {{ $locale == $selected_locale ? 'selected' : '' }}>
                      {{ $locale }}</option>
                  @endforeach
                </select>
              </div>
              @php
                $dataTypeRows = $dataType->{$edit ? 'editRows' : 'addRows'};
              @endphp

              @foreach ($dataTypeRows as $row)
                @if ($row->type == 'relationship')
                  @if ($row->field == 'user_belongsto_lineage_relationship')
                    <label for="locale">Thuộc dòng họ</label>
                    @include('voyager::formfields.relationship', ['options' => $row->details])
                  @endif
                @endif
              @endforeach

            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="panel panel panel-bordered panel-warning">
            <div class="panel-body">
              <div class="form-group">
                @if (isset($dataTypeContent->avatar))
                  <img
                    src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image($dataTypeContent->avatar) }}"
                    style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                @endif
                <input type="file" data-name="avatar" name="avatar">
              </div>
            </div>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary pull-right save">
        {{ __('voyager::generic.save') }}
      </button>
    </form>
    <div style="display:none">
      <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
      <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
    </div>
  </div>
@stop

@section('javascript')
  <script>
    $('document').ready(function() {
      $('.toggleswitch').bootstrapToggle();
    });
  </script>
@stop
