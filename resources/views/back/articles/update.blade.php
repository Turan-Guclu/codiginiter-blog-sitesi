@extends('back.layouts.master')
@section('title',$article->title.' Makalesini Güncelle')
@section('css')

<link href="{{ asset('back/') }}/summernote/summernote.css" rel="stylesheet"/>

@endsection
@section('js')
<script src="{{ asset('back/') }}/summernote/summernote.js"></script>
<script>

    $(document).ready(function() {
        $('#summernote').summernote({
            lang: 'tr-TR',  // Dil seçeneğini belirleyebilirsiniz.
            height: 500      // Metin alanı yüksekliği
            // Diğer özelleştirmeleri buraya ekleyebilirsiniz.
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

        <form method="POST" action="{{ route('admin.articles.update',$article->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                    <label>Makale Başlığı</label>
                    <input type="text" name="title" class="form-control" value="{{ $article->title }}" required >
            </div>
            <div class="form-group">
                <label>Makale Kategorisi</label>
                <select name="category" class="form-control" required >

                @foreach ($category as $ctg)
             
                <option value="{{ $ctg->id }}" @if($article->category_id==$ctg->id) selected @endif >{{ $ctg->name }}</option>
        
                @endforeach
                </select>
            </div>
            <div class="form-group ">
                <label>Makale Resmi</label>
                <br/>
                <img src="{{ asset('uploads/'.$article->image) }}" class="img-thumbnail rounded" width="300"/>
                <input type="file"  name="image" class="form-control mt-3" >
        </div>
        <div class="form-group flex">
            <label>Makale içerigi</label>
       
                <textarea type="textarea"  style="display: none" id="summernote" name="content" class="form-control" rows="4" required >{!! $article->content !!}</textarea>
        
    </div>

    <div class="form-group">
        <label>Makale Durumu</label>
        <select name="status" class="form-control" required >
        <option value="0" @if($article->status=="0") selected @endif>Pasif</option>
        <option value="1" @if($article->status=="1") selected @endif>Aktif</option>
        </select>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block"> Makaleyi Güncelle </button>
        
    </div>
        </form>

    </div>
</div>

@endsection

