<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\PreviousSearch;

class SearchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $previous = PreviousSearch::orderBy('created_at', 'desc')->paginate(10);

        $data = array(
            'title' => 'Here are your search history...',
            'searched' => $previous
        );

        return view('searches.history')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'word' => 'required'
        ]);

        $word = $request->input('word');

        // check the db if it's already there...
        $wordExists = PreviousSearch::where('word', $word)->count();

        if (!$wordExists)
        {
            // TODO: Have a credit card ready to be able to subscribe to wordsapi on RapidAPI then subscribe to the API: https://rapidapi.com/dpventures/api/wordsapi/endpoints
            
            // $response = Http::withHeaders([
            //     'x-rapidapi-host' => 'wordsapiv1.p.rapidapi.com',
            //     'x-rapidapi-key' => 'd5fb032d6fmshbbd026352210b35p1f7b16jsnc7df14a6155e',
            //     'useQueryString' => true
            // ])->get('https://wordsapiv1.p.rapidapi.com/words/' . $word . '/definitions')->json();

            $response = Http::withHeaders([
                'x-rapidapi-host' => 'aplet123-wordnet-search-v1.p.rapidapi.com',
                'x-rapidapi-key' => 'd5fb032d6fmshbbd026352210b35p1f7b16jsnc7df14a6155e',
                'useQueryString' => true
            ])->get('https://aplet123-wordnet-search-v1.p.rapidapi.com/master', ['word' => $word])->json();

            $search = new PreviousSearch;
            $search->word = $word;
            $search->definition = $response['definition'];
            $search->save();
        }

        return redirect('/search/' . $word)->with('success', 'Search complete!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($word)
    {
        // this means, that it's already in the database
        $data = array(
            'word' => $word,
            'definition' => ""
        );

        if (!empty($word))
        {
            $searched = PreviousSearch::where('word', $word)->first();

            if ($searched)
            {
                $data['definition'] = $searched->definition;
                $data['success'] = 'Search Complete!';
            }
            else
            {
                $data['error'] = 'The word does not exist in our database.';
            }
        }

        return view('searches.search')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
