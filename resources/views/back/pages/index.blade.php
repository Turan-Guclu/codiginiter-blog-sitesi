@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
@section('content')
@section('css')
<link href="{{ asset('back/') }}/bootstraptoggle/bootstrap-toggle.min.css" rel="stylesheet"/>
@endsection

@section('js')
<script src="{{ asset('back/') }}/sortablejs/jquery-ui.min.js"></script>
<script src="{{ asset('back/') }}/sortablejs/sortablejs.min.js"></script>
<script>
$('#orders').sortable({
  handle:'.handle',
  update:function(){
    var sorting = $('#orders').sortable('serialize');
    $.get("{{route('admin.pages.orders')}}?"+sorting,function(data,status){
       $('#orderSuccess').show();
       setTimeout(function() {
        $('#orderSuccess').hide();
       }, 1000); 
    });
  }
});
</script>

<script src="{{ asset('back/') }}/bootstraptoggle/bootstrap-toggle.min.js"></script>
<script>
      $(function() {
    $('.switch').change(function() {
      //alert('Toggle: ' + $(this).getAttribute('data'));
        id= $(this)[0].getAttribute('page-id');
        statu=$(this).prop('checked');
       $.get("{{ route('admin.pages.status') }}",{id:id,statu:statu},function(data,status){});
    })
  })
</script>
@endsection

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">

    <h6 class="m-0 font-weight-bold  text-primary">
       @yield('title')
    <span class="float-right"> {{$pages->count() }} Adet Sayfa Bulundu. </strong>
    </br>

  </span>
    </h6>

    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">
              {{ session('success') }}
              </div>
        @endif

        <div id="orderSuccess" style="display: none" class="alert alert-success">
            Sıralama Başarılı Bir Şekilde Güncellendi.
          </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th>Sıralama</th>
                      <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
             
               <tbody id="orders">
                @foreach($pages as $page)
                <tr id="page_{{$page->id}}">
                  <td width='1%'><i class="fas fa-ellipsis-v fa-2x handle" style="cursor: move"></i></td>
                    <td><img src="{{  asset('uploads/').'/'.$page->image }}" width="200"></td>
                    <td>{{ $page->title }}</td>
                    <td><input class="switch" page-id={{$page->id}} type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($page->status===1) checked @endif data-toggle="toggle"></td>
                     <td>
                      <a href='{{route('page',$page->slug)}}' target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                      <a href='{{ route('admin.pages.edit',$page->id) }}' title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                      <a href='{{ route('admin.pages.delete',$page->id) }}' title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a> 
                    </td>              
                </tr>
                @endforeach
    
               </tbody>
            </table>
        </div>
    </div>
</div>

@endsection