@extends('layouts.index')
@section('content')
<div class="container"><br/><br/>
    <div class="row">
        <div class="col-3">
            <h4>Laravel прототип хостинг изображении</h4>
        </div>
        <div class="col-2 my-2">
            <a href="{{ route('images.create') }}" class="btn btn-success" title="Добавить новые изображении">
                Добавить
            </a>
        </div>

        <div class="col-2 my-2">
            <a href="{{url('/download')}}" class="btn btn-primary" title="Скачать все">Скачать все</a>
        </div>

        <div class="col-3 my-2">
            <a href="{{url('/images')}}?sort=name" class="btn btn-secondary">Сортировка имени</a>
        </div>

        <div class="col-2 my-2">
            <a href="{{url('/images')}}?sort=date" class="btn btn-secondary">Сортировка дата</a>
        </div>
    </div>
    @if(session('message'))
    <div class="alert alert-success" role="alert">
     {{session('message')}}
    </div>
    @endif
    <table class="table table-bordered table-striped text-center" id="imagesTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Название файла</th>
                <th>Дата и время</th>
                <th>Изображении</th>
                <th>Действие</th>
            </tr>    
        </thead>
        <tbody>
              @forelse($images as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->filename }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                       <a href="{{asset('storage/images/'.$item->filename)}}"> <img src="{{asset('storage/images/'. $item->filename)}}" width= '60' height='60' class="img img-responsive" /></a>
                    </td>
                    <td class="text-center">
                         <form action="{{ route('images.destroy', $item->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn btn-danger mt-3" value="Удалить" />
                        </form>
                    </td>
                </tr>
                
                @empty
                <p>Пустой</p> 
                @endforelse
        </tbody>
    </table>
</div>
@endsection