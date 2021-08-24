<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Category::all()->where('type',1);
        $data = Article::all();
        return view('owner_view.article.index',compact('data','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all()->where('type',1);
        return view('owner_view.article.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('image') && $request->image) {
            $article = Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'image' => $request->image,
            ]);
            $namaGambar =$article->id.'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move('article/images', $namaGambar);
            //---------------------------
            Article::find($article->id)->update([
                'image' => 'article/images/'.$namaGambar,
            ]);
            return redirect()->route('article.index')->with('success', 'Article berhasil ditambahkan!');
        }else{
            return back()->with('danger', 'Harap cek kembali gambar yang digunakan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $data = Article::all();
        $katalog = Category::all()->where('type',0);
        return view('customer_view.read_article',compact('data','article','katalog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $category = Category::all()->where('type',1);
        return view('owner_view.article.edit',compact('article','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        if($request->hasFile('image') && $request->image) {
            $namaGambar =$article->id.'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move('article/images', $namaGambar);
            //---------------------------
            Article::find($article->id)->update([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'image' => 'article/images/'.$namaGambar,
            ]);
        }else{
            Article::find($article->id)->update($request->all());
        }
        return redirect()->route('article.index')->with('success', 'Article berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Article::destroy($article->id);
        return back()->with('success', 'Article berhasil dihapus!');
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Category::create([
            'nama' => $request->nama,
            'type' => 1,
        ]);
        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function updateKategori(Category $kategori, Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Category::find($kategori->id)->update($request->all());
        return back()->with('success', 'Data berhasil diubah');
    }

    public function destroyKategori(Category $kategori)
    {
        Category::destroy($kategori->id);
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function indexUser()
    {
        $data = Article::all();
        $category = Category::all()->where('type',1);
        $katalog = Category::all()->where('type',0);
        return view('customer_view.article',compact('data','category','katalog'));
    }
}
