@extends('back.layouts.master')
@section('title','Silinen Makaleler')
@section('content')
@section('css')
<link href="{{ asset('back/') }}/bootstraptoggle/bootstrap-toggle.min.css" rel="stylesheet"/>
@endsection

@section('js')
<script src="{{ asset('back/') }}/bootstraptoggle/bootstrap-toggle.min.js"></script>
<script>
      $(function() {
    $('.switch').change(function() {
      //alert('Toggle: ' + $(this).getAttribute('data'));
        id= $(this)[0].getAttribute('article-id');
        statu=$(this).prop('checked');
       $.get("{{ route('admin.switch') }}",{id:id,statu:statu},function(data,status){});
    })
  })
</script>
@endsection

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">

    <h6 class="m-0 font-weight-bold  text-primary">
       @yield('title')
    <span class="float-right"> {{$articles->count() }} Adet Makale Bulundu. </strong>
    </br>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-primary btn-sm float-right mt-2"><i class="fa fa-list"></i> Tüm Makaleler</a>
  </span>
    </h6>

    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">
              {{ session('success') }}
              </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Oluşturma Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
             
               <tbody>
                @foreach($articles as $article)
                <tr>
                    <td><img src="{{  asset('uploads/').'/'.$article->image }}" width="200"></td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->getCategory->name }}</td>
                    <td>{{ $article->hit }}</td>
                    <td>{{ $article->created_at->diffForHumans() }}</td>
                    <td>
                      <a href='{{ route('admin.recover.article',$article->id) }}' title="Geri Yükle" class="btn btn-sm btn-success"><i class="fa fa-recycle"></i></a>
                      <a href='{{ route('admin.hard.delete.article',$article->id) }}' title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                    </td>
              
                 
                </tr>
                @endforeach
    
               </tbody>
            </table>
        </div>
    </div>
</div>

@endsection