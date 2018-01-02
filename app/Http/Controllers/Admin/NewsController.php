<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Province;
use App\User;
use App\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input('title') == '' && $request->input('date_from') == '' && $request->input('date_until') == '' || $request->input('title') == null && $request->input('date_from') == null && $request->input('date_until') == null){
            $news = News::with('user')->paginate(10);
        }else{
            $title = '%'.$request->input('title').'%';

            if($request->input('date_from') != '' && $request->input('date_until') != ''){
                $date_from = Carbon::createFromFormat('Y-m-d', $request->input('date_from'))->addDays(-1);
                $date_until = Carbon::createFromFormat('Y-m-d', $request->input('date_until'));

                $news = News::with('user')
                    ->where('title', 'like', $title)
                    ->whereBetween('created_at', [$date_from , $date_until])
                    ->paginate(10);
            }else {
                $date_from = '%'.$request->input('date_from').'%';
                $date_until = '%'.$request->input('date_until').'%';

                $news = News::with('user')
                    ->where('title', 'like', $title)
                    ->whereDate('created_at', 'like', $date_from)
                    ->whereDate('created_at', 'like', $date_until)
                    ->paginate(10);
            }
        }

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsStoreRequest $request)
    {
        $news = News::create([
        'title' => $request->get('title'),
        'content' => $request->get('content'),
        'user_id' =>$request->user()->id
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Data berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin.news.preview', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */ 
    public function edit(News $news)
    {

        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, News $news)
    {

        $news->update([
        	'title' => $request->get('title'),
        	'content' => $request->get('content'),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Data berhasil dihapus.');
    }
}
