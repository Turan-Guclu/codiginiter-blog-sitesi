<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use  Validator ;

// Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;
use Mail;
class Homepage extends Controller
{

    public function __construct(){
        if(Config::find(1)->active==0){
            return redirect()->to('offline')->send();
        }
        view()->share("pages",Page::whereStatus(1)->orderBy('order','ASC')->get());
        view()->share('categories',Category::whereStatus(1)->inRandomOrder()->get());
    }
    public function index(){
        $data['articles']=Article::with('getCategory')->orderBy('created_at','DESC')->where('status',1)
        ->whereHas('getCategory',function($query){
            $query->where('status',1);
        })
        ->paginate(10);
        $data['articles']->withPath(url('sayfa'));
        return view("front.homepage",$data);
    }

    public function single($category,$slug){

       $category= Category::whereStatus(1)->whereSlug($category)->first() ?? abort(404,'Böyle Bir Kategori Bulunamadı');

        $article=Article::whereStatus(1)->whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(404,'Böyle Bir Yazı Bulunamadı');
        $article->increment('hit');
        $data['article']=$article;
        return view("front.single",$data);
    }

    public function category($slug){
        $category= Category::whereStatus(1)->whereSlug($slug)->first() ?? abort(404,'Böyle Bir Kategori Bulunamadı');
        $data['category']= $category;
        $data['articles']=Article::whereStatus(1)->where('category_id',$category->id)->orderBy('created_at','DESC')->where('status',1)->paginate(1);
        $data['articles']->withPath(url('sayfa'));
        return view("front.category",$data);
    }

    
    public function page($slug){
        $page=Page::whereStatus(1)->whereSlug($slug)->first();
        if(!$page){ return redirect()->route('homepage');}
        $data['page']=$page;
        return view("front.page",$data);
    }

    public function contact(){
        return view("front.contact");
    }
    
    public function contactpost(Request $request){
        $rules=[
            'name'=>'required|min:5',
            'email'=> 'required|email',
            'topic'=>'required',
            'message'=>'required|min:10'
        ];
        $validate=Validator::make($request->post(),$rules);
        if($validate->fails()){
            return redirect()->route('contact')->withErrors($validate)->withInput();
        };
   
    

        $contact = new Contact;
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->topic=$request->topic;
        $contact->message=$request->message;
        $contact->save();
        return redirect()->route('contact')->with('success','Mesajiniz Bize İletildi Teşekkür Ederiz');
    }
}
