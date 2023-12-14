
@extends('back.layouts.master')
@section('title',$page->title.' Sayfasini Güncelle')
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

        <form method="POST" action="{{ route('admin.pages.update',$page->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                    <label>Sayfa Başlığı</label>
                    <input type="text" name="title" class="form-control" value="{{ $page->title }}" required >
            </div>
            <div class="form-group ">
                <label>Sayfa Resmi</label>
                <br/>
                <img src="{{ asset('uploads/'.$page->image) }}" class="img-thumbnail rounded" width="300"/>
                <input type="file"  name="image" class="form-control mt-3" >
        </div>
        <div class="form-group flex">
            <label>Sayfa içerigi</label>
       
                <textarea type="textarea"  style="display: none" id="summernote" name="content" class="form-control" rows="4" required >{!! $page->content !!}</textarea>
        
    </div>

    <div class="form-group">
        <label>Sayfa Durumu</label>
        <select name="status" class="form-control" required >
        <option value="0" @if($page->status=="0") selected @endif>Pasif</option>
        <option value="1" @if($page->status=="1") selected @endif>Aktif</option>
        </select>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block"> Sayfayi Güncelle </button>
        
    </div>
        </form>

    </div>
</div>

@endsection