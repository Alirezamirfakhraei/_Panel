@extends('Panel::layouts.master')
<?php
$function = new Functions();
?>
@section('title', 'ویرایش تکیت')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">ویرایش تیکت</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-2">
                                @if (count($errors) > 0)
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('tickets.update' , $ticket->id)}}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $ticket->id }}">
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-12">
                                                <div class="checkbox checkbox-primary">
                                                    <input id="priority[{{ $ticket->priority }}]" type="checkbox" name="priority[{{ $ticket->priority }}]" value="{{ $ticket->priority }}">
                                                </div>
                                            @error('priority')
                                            <br>
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-success">ذخیره</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
