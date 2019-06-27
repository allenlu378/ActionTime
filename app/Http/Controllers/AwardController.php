<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Award;
use Illuminate\Support\Facades\Auth;

class AwardController extends Controller
{

    public $view_path="backend/award/";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * display the awards created by
     *
     */
    public function list(){
        $awards = Award::where('owner', Auth::user()['id'])->orderBy('id','desc')->get();
        return view($this->view_path.'list', compact('awards'));

    }


    /**
     * edit
     * @param $award_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($award_id){
        $award = Award::find($award_id);
        return view($this->view_path.'edit',compact('award'));
    }

    /**
     *
     * display a task's form
     *
     */
    public function form(){
        return view($this->view_path.'form');
    }


    /**
     * @param Request $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $data){
        $data->validate([
            'name' => 'required|string|max:50|unique:award',
            'description' => 'required|string|max:255',
            'total_num' => 'required|numeric',
        ]);

        $data['remaining_num'] = $data['total_num'];

         Award::create($data->except(['_token','file_upload']));
         return redirect('award/list');
    }

    /**
     * @param Request $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $data){
        $data->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'total_num' => 'required|numeric',
        ]);
        $data['remaining_num'] = $data['total_num'];
        $result = Award::where('id',$data['id'])->update($data->except(['_token','file_upload','_method']));
        return redirect('award/list');
    }




    /**
     *
     * delete an award
     * @param $award_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($award_id){
        Award::where('id',$award_id)->delete();
        return redirect('award/list');

    }

}
