@extends('layouts.index')
@section('content')

<h5 class="my-3"><a href="{{route('images.index')}}" class="text-decoration-none">Главная</a></h5>
<div class="card my-5">
  <div class="card-header">Добавить Новый</div>
  <div class="card-body">
      <form action="{{ route('images.store') }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input class="form-control" name="images[]" multiple type="file" id="photo"> </br>
        <input type="submit" value="Сохранить" class="btn btn-success"></br>
    </form>
  </div>
</div>
@if($errors->any())
    <div class="alert alert-danger"> 
    @foreach ($errors->all() as $error)
                {{ $error }}
    @endforeach
    </div>
@endif
@endsection