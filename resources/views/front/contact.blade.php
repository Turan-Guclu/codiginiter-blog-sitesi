@extends('front.layouts.master')
@section('title','İletişim')
@section('bg',asset('front/assets/img/contact-bg.jpg'))
@section('content')

<div class="col-md-6">
  @if(session('success'))
  <div class="alert alert-success">
        {{ session('success') }}
        </div>
  @endif

  @if($errors->any())
  <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
           <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
  @endif
    <p>Bizimle İletişime Geçebilirsiniz</p>
    <div class="my-5">

        <form method="post" action="{{ route('contact.post') }}" >
            @csrf
            <div class="form-floating">
                <input class="form-control" id="name" name="name" value="{{ old('name') }}" type="text" required placeholder="Ad Soyad Giriniz..." />
                <label for="name">Ad Soyad</label>
                <div class="invalid-feedback" data-sb-feedback="name:required">Ad Soyad Alanı Zorunludur.</div>
            </div>
            <div class="form-floating">
                <input class="form-control" id="email" required name="email" value="{{ old('email') }}" type="email"
                    placeholder="E-posta Adresi Giriniz..." />
                <label for="email">E-Posta </label>
                <div class="invalid-feedback" data-sb-feedback="email:required">E-Posta Alanı Zorunludur.</div>
                <div class="invalid-feedback" data-sb-feedback="email:email">Alan E-Posta İçermelidir.</div>
            </div>

            <div class="form-floating">
                <div class="from-group">
                    <label for="topic">Konu</label>
                    <select required class="form-control border-bottom-1"
                        style="border-top: 0;  border-right: 0; border-left: 0; border-radius: 0;" name="topic">
                        <option @if(old('topic')=="Bilgi" ) selected @endif>Bilgi</option>
                        <option @if(old('topic')=="Destek" ) selected @endif>Destek</option>
                        <option @if(old('topic')=="Genel" ) selected @endif>Genel</option>
                    </select>

                    <div class="invalid-feedback" data-sb-feedback="name:required">Konu Alanı Zorunludur.</div>
                </div>
            </div>
            <div class="form-floating">
                <textarea class="form-control" required id="message"   name="message" placeholder="Mesaj Giriniz..."
                    style="height: 12rem">{{ old('message') }}</textarea>
                <label for="message">Mesaj</label>
                <div class="invalid-feedback" data-sb-feedback="message:required">Mesaj Alanı Zorunludur.</div>
            </div>
            <br />

           
            <!-- Submit Button-->
            <button class="btn btn-primary text-uppercase " id="submitButton" type="submit">Gönder</button>
        </form>
    </div>
</div>
<div class="col-md-4">
<h2>İletişim Bilgileri</h2>
<ul class="list-unstyled pl-md-5 mb-5">
<li class="d-flex text-black mb-2">
<span class="mr-3"></span>Ankara İzmir Yolu 8.Km Bir Eylül Kampüsü,   <br>  Merkez / UŞAK
</li>
<li class="d-flex text-black mb-2"><span class="mr-3"></span></span> +90 276 221 21 21 </li>
<li class="d-flex text-black"><span class="mr-3"></span>  usak@usak.edu.tr </li>
</ul>
</div>
@endsection