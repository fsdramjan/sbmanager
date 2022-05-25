<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function pageList()
    {
        $pages = Page::all();
        return view('backend.pages.page-list',compact('pages'));
    }

    public function pageCreate()
    {
        return view('backend.pages.page-create');
    }

    public function pageStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'details'=>'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        Page::create([
            'title'=>$request->title,
            'details'=>$request->details,
            'status'=>1,
        ]);

        return redirect()->back()->withToastSuccess('Page created successfully!!');
    }

    public function pageEdit(Page $page)
    {
        return view('backend.pages.page-edit',compact('page'));
    }

    public function pageUpdate(Request $request, Page $page)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'details'=>'required'
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $page->update([
            'title'=>$request->title,
            'details'=>$request->details,
        ]);

        return redirect()->route('admin.pageList')->withToastSuccess('Page updated successfully!!');
    }

    public function pageDelete(Request $request, Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pageList')->withToastSuccess('Page deleted successfully!!');
    }

    public function pageActive(Request $request, Page $page)
    {
        $page->status = 1;
        $page->save();

        return redirect()->route('admin.pageList')->withToastSuccess('Page activated successfully!!');
    }

    public function pageInactive(Request $request, Page $page)
    {
        $page->status = 0;
        $page->save();

        return redirect()->route('admin.pageList')->withToastSuccess('Page inactivated successfully!!');
    }
}
