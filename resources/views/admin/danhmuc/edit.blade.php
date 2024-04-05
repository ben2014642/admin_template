@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-form :action="route('admin.blog.danhmuc.update')" type="put" :validate="true">
                <x-input type="hidden" name="id" :value="$category->id" />
                <div class="row justify-content-center">
                    @include('admin.danhmuc.forms.edit-left')
                    @include('admin.danhmuc.forms.edit-right')
                </div>
                @include('admin.forms.actions-fixed')
            </x-form>
        </div>
    </div>
@endsection

@push('libs-js')

@endpush


