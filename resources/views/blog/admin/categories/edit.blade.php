@extends('layouts.app')
@section('content')
    @php
        /** @var  \App\Models\BlogCategory  $item  */
    @endphp

    <form method="POST" action="{{ route('blog.admin.categories.update'), $item->id }}">
        @method('PATCH')
        @csrf
        <div class="container">
            @php
            /** @var \Illuminate\Support\ViewErrorBag $errors */
            @endphp
            @if($errors->any())
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>

                </div>

            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.categories.includes.item_edit_main_coll')
                </div>
                <div class="col-md-3">
                    @include('blog.admin.categories.includes.item_edit_add_coll')
                </div>

            </div>

        </div>

    </form>
@endsection
