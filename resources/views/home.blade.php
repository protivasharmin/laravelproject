@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Prodcts 
                    <span class="pull-right">
                        <button class="btn btn-sm btn-success btn-default" data-toggle="modal" data-target="#create_new">Create</button>
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- ----------------- --}}
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        <?php $i=1; ?>
                        @foreach($products as $product)
                        <tr>
                            <?php //dd(base64_encode($product->image)); ?>
                            <td>{{ $i++ }}</td>
                            <td>
                                <img src="{{ 'storage/galeryImages/'.$product->image }}" height="34" width="34">
                            </td>
                            <td>{{ ucfirst($product->title) }}</td>
                            <td>{{ ucfirst($product->description) }}</td>
                            <td>{{ ucfirst($product->price) }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary btn-default" data-toggle="modal" data-target="#edit_{{ $product->id }}">Edit</button>
                                <button class="btn btn-sm btn-danger btn-default" data-toggle="modal" data-target="#delete_modal_{{ $product->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{-- ----------------- --}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Create modal  --}}
<form action="{{ route('pCreate') }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="modal fade" id="create_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Create New </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">                
                <div class="form-group">
                    <label class="control-label">Title:</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label class="control-label">Price:</label>
                    <input type="number" class="form-control" name="price">
                </div>
                <div class="form-group">
                    <label for="message-text" class="control-label">Description:</label>
                    <textarea class="form-control" id="message-text" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" class="form-control-file"name="p-img">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send</button>                    
                </div>
        </div>
    </div>
</div>
</form>
{{-- ./Create modal  --}}

<?php //dd($products); ?>


{{-- Edit modal  --}}
@foreach($products as $product) 
<form action="{{ route('pUpdate', $product->id) }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="modal fade" id="edit_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Edit </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">                
                <div class="form-group">
                    <label class="control-label">Title:</label>
                    <input type="text" class="form-control" name="title" value="{{ $product->title }}">
                </div>
                <div class="form-group">
                    <label class="control-label">Price:</label>
                    <input type="number" class="form-control" name="price" value="{{ $product->price }}">
                </div>
                <div class="form-group">
                    <label for="message-text" class="control-label">Description:</label>
                    <textarea class="form-control" id="message-text" name="description">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label>
                    <input type="file" class="form-control-file"name="p-img" value="{{ $product->image }}">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send</button>                    
                </div>
        </div>
    </div>
</div>
</form>
@endforeach
{{-- ./Edit modal  --}}

{{-- delete modal  --}}
@foreach($products as $product)
<div class="modal fade" id="delete_modal_{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Edit </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">                
            <div class="form-group">
                <h5>Are you sure? You want to delete?</h5>
            </div>
            <div class="modal-footer">
                <form action="{{ route('pDelete', $product->id) }}" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Send</button>                    
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- ./delete modal  --}}

@endsection
