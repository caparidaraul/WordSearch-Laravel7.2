<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'Welcome to the Word Search Test for CoDev';

        $data = array(
            'title' => 'Welcome to the Word Search Test for CoDev',
            'word' => ''
        );

        return view('pages.index')->with($data);
    }

    public function history()
    {
        $data = array(
            'title' => 'Here are your search history...',
            'searched' => ['test1', 'test2']
        );

        return view('search.history')->with($data);
    }
}
