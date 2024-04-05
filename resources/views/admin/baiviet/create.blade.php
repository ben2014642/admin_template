@extends('admin.layouts.master')
@push('libs-css')
    <link rel="stylesheet" href="{{ asset('libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}">
@endpush

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.blog.baiviet.store')" type="post" :validate="true">
                <div class="row justify-content-center">
                    @include('admin.baiviet.forms.create-left')
                    @include('admin.baiviet.forms.create-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-form>
        </div>
    </div>
@endsection


@push('custom-js')
    @include('admin.baiviet.scripts.scripts')
@endpush

@push('libs-js')
    <script src="{{ asset('libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('libs/ckeditor/adapters/jquery.js') }}"></script>
    @include('ckfinder::setup')

    <script src="{{ asset('libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('libs/select2/dist/js/i18n/' . trans()->getLocale() . '.js') }}"></script>
@endpush
