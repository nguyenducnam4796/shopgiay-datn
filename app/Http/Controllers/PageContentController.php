<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageContentController extends Controller
{
    //
    function getContent($content_id){

        return view('content.content',compact('content_id'));
    }
}
