<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HomepageEntry;
use Dotenv\Parser\Entry;
use Illuminate\Http\Request;

class HomepageSettingController extends Controller
{
    public function indexHomepageEntry(){
        $entries = HomepageEntry::all();
        return response()->json($entries);
    }
    public function cratetHomePageEntry(Request $request){
        $request->validate([
            'title' => 'required|min:10|max:20',
            'text'  => 'required|min:10|max:35',
            'icon' => 'required',
            'popularity' => 'integer',
        ]);

        $data = $request->all();

        HomepageEntry::create($data);    
    }

    public function updateHomePageEntry(Request $request,HomepageEntry $homepage_entry){
        $homepage_entry->update(
            $request->validate([
                'title' => 'required|min:10|max:20',
                'text'  => 'required|min:10|max:35',
                'icon' => 'required',
                'popularity' => 'integer',
            ])
        );
    }
}
