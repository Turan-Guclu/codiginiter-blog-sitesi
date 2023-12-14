@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')
@section('css')
<link href="{{ asset('back/') }}/bootstraptoggle/bootstrap-toggle.min.css" rel="stylesheet"/>
@endsection

@section('js')
<script src="{{ asset('back/') }}/bootstraptoggle/bootstrap-toggle.min.js"></script>
<script>
  $(function(){
    $('.remove-click').click(function(){
      id= $(this)[0].getAttribute('category-id');
      count= $(this)[0].getAttribute('category-count');
      name= $(this)[0].getAttribute('category-name');
      $('#articleAlert').html(' ');
      $('#body').hide();
      $('#deleteId').val(id);
      if(id==1){

        $('#articleAlert').html(name+' Kategorisi Sabit Kategoridir. Silinen Diğer Kateogrilere Ait Makaleler Bu Kategoriye Eklenecektir');
        $("#deleteButton").hide();
        $('#body').show();

      }else{

        if(count>0){
        $('#articleAlert').html(name+' Kategorisine Ait '+count+' Makale Bulunmaktadır. Silmek İstediğnize Emin misiniz ?');
        $("#deleteButton").show();
        $('#body').show();

      }else{
        $('#articleAlert').html(name+' Kategorisini Silmek İstediğnize Emin misiniz ?');
        $("#deleteButton").show();
        $('#body').show();
      }
      }
      $('#removeModal').modal();
    })
  })

  $(function(){
    $('.edit-click').click(function(){
      id= $(this)[0].getAttribute('category-id');
      $.ajax({
        type:'GET',
        url:'{{ route('admin.category.getdata') }}',
        data:{id:id},
        success:function(data){
          $('#recId').val(data.id);
          $('#category').val(data.name);
          $('#editModal').modal();
        }
      })
    })
  })
      $(function() {
    $('.switch').change(function() {
      //alert('Toggle: ' + $(this).getAttribute('data'));
        id= $(this)[0].getAttribute('category-id');
        statu=$(this).prop('checked');
       $.get("{{ route('admin.category.status') }}",{id:id,statu:statu},function(data,status){});
    })
  })
</script>
@endsection
<div class="row">
  
  <div class="col-md-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
      </div>
      <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">
              {{ session('success') }}
              </div>
        @endif
                
      @if($errors->any())
        <div class="alert alert-danger">       
            @foreach($errors->all() as $error)
              {{ $error }}
            @endforeach      
        </div>
      @endif
        <form method="POST" action="{{ route('admin.category.create') }}">       
          @csrf   
        <div class="form-group">
          <label>Kategori Adı</label>
          <input type="text" class="form-control" name="category" required>
        </div>
        <div class="from-group">
          <button type="submit" class="btn btn-primary btn-block ">Ekle</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
      </div>
      <div class="card-body">
      
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                    <th>Kategori</th>
                    <th>Makale Sayısı</th>
                      <th>Durum</th>
                      <th>İşlemler</th>
                  </tr>
              </thead>
           
             <tbody>
              @foreach($categories as $category)
              <tr>

                  <td>{{ $category->name }}</td>
                  <td>{{ $category->articleCount() }}</td>
                  <td><input class="switch" category-id={{$category->id}} type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($category->status===1) checked @endif data-toggle="toggle"></td>
                  <td>
                      <a href='{{route('category',$category->slug)}}' target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                      <a category-id="{{ $category->id }}" title="Düzenle" class="btn btn-sm btn-primary edit-click"><i class="fa fa-pen"></i></a>
                      <a category-id="{{ $category->id }}" category-name="{{ $category->name }}"  category-count="{{ $category->articleCount() }}" title="Sil" class="btn btn-sm btn-danger remove-click"><i class="fa fa-times"></i></a>
                  </td>
            
               
              </tr>
              @endforeach
  
             </tbody>
          </table>
      </div>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Kategori Düzenle</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST" action="{{ route('admin.category.update') }}">       
          @csrf  
          <div class="form-group">
            <input id="recId"  type="hidden" class="form-control" name="id" required>
        </div> 
        <div class="form-group">
          <label>Kategori Adı</label>
          <input id="category" type="text" class="form-control" name="category" required>
        </div>
       
     
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-success "  >Kaydet</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="removeModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Kategori Düzenle</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
 
      <div id="body" class="modal-body">
        <div class="alert alert-danger" id="articleAlert"></div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
        <form method="POST" action="{{ route('admin.category.delete') }}" >
          @csrf
        <input type="hidden" name="id" id="deleteId"/>
        <button id="deleteButton"  type="submit" class="btn btn-success">Sil</button>
        </form>
      </div>
    </form>
    </div>
  </div>
</div>


@endsection

