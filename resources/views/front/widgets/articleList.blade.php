
<div class="col-md-9 col-lg-8 col-xl-7">
@if(count($articles)>0)
@foreach($articles as $article)

<div class="post-preview">
    <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
        <h2 class="post-title">{{$article->title}}</h2>
        <img src="{{asset('uploads/'.$article->image)}}"/>
        <h3 class="post-subtitle">{!! str_limit($article->content,150) !!}</h3>
    </a>
    <p class="post-meta">
        Kategori:
        <a href="{{$article->getCategory->slug}}">{{$article->getCategory->name}}</a>
        <br />
        <span class="float-end"> {{$article->created_at->diffForHumans()}} </span>
    </p>
</div>
<!-- Divider-->
<hr class="my-4" />
@endforeach

{{$articles->links()}}

    @else
    <div class="alert alert-danger">
        <h2>Bu Kategoriye Ait Yazı Bulunamadı</h2>
    </div>

    @endif
</div>