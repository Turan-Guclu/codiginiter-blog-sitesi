@extends('back.layouts.master')
@section('title','Makale Oluştur')
@section('css')

<link href="{{ asset('back/') }}/summernote/summernote.css" rel="stylesheet"/>

@endsection
@section('js')
<script src="{{ asset('back/') }}/summernote/summernote.js"></script>
<script>
    $(document).ready(function(){
        $('#editor').summernote({
            height:500
        });
    });
</script>
@endsection
@section('content')
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold  text-primary"><span> @yield('title') </span></h6>

    </div>
    <div class="card-body">

        
  @if($errors->any())
  <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
           <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
  @endif
        <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                    <label>Makale Başlığı</label>
                    <input type="text" name="title" class="form-control" required >
            </div>
            <div class="form-group">
                <label>Makale Kategorisi</label>
                <select name="category" class="form-control" required >
                <option value="">Seçim Yapınız </option>
                @foreach ($category as $ctg)
                <option value="{{ $ctg->id }}">{{ $ctg->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group ">
                <label>Makale Resmi</label>
                <input type="file"  name="image" class="form-control" required >
        </div>
        <div class="form-group ">
            <label>Makale içerigi</label>
            <textarea type="textarea"  id="editor" name="content" class="form-control" rows="4" required ></textarea>
    </div>

    <div class="form-group">
        <label>Makale Durumu</label>
        <select name="status" class="form-control" required >
        <option value="0">Pasif</option>
        <option value="1">Aktif</option>
        </select>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block"> Makaleyi Oluştur </button>
        
    </div>
        </form>

    </div>
</div>

@endsection