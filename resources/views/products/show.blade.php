@extends('layouts.app')

@section('content')
    <div class="row" style="padding: 2%">
        <div class="col-sm-6 pull-left">
            <h2>Show Product</h2>
        </div>
        <div class="col-sm-6 d-md-flex justify-content-md-end">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
        </div>
    </div>

    <div class="row" style="margin: auto; padding: 5%; border: solid 1px #aaa; border-radius: 5px;">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $product->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $product->detail }}
            </div>
        </div>
    </div>
@endsection
