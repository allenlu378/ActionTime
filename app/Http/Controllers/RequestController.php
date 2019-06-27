<?php

namespace App\Http\Controllers;

use App\Http\Model\Assignment;
use Illuminate\Http\Request;
use App\Http\Model\AuditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    //
    /**
     * Create a new controller instance
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * display a task's form
     * @param $aid assigment_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function form($aid)
    {
        $assignment =Assignment::find($aid);

        return view('request/form',compact('assignment'));
    }

    /**
     * display the audit_request for auditing
     *
     */
    public function list_audit()
    {
        $auditRequests = AuditRequest::where('auditor', Auth::user()['id'])->orderBy('id', 'desc')->get();
        return view('request/list_audit', compact('auditRequests'));
    }

    /**
     * display the audit_request for user
     *
     */
    public function list_user()
    {
        $auditRequests = AuditRequest::where('created_by', Auth::user()['id'])->orderBy('id', 'desc')->get();

        return view('request/list_user', compact('auditRequests'));
    }


    /**
     * edit the audit_request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $auditRequest = AuditRequest::find($id);

        return view('request/edit', compact('auditRequest'));
    }


    /**
     * @param Request $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $data)
    {

        $data->validate([
            'description' => 'required|string|max:255',
            'add_value' => 'required|numeric',
        ]);
        $request = $data->except('_token');
        $assigment  = Assignment::find($request['assignment_id']);
        //fill data;
        $request['created_by'] = Auth::user()['id'];
        $request['task_id'] = $assigment['task_id'];
        $request['auditor'] = $assigment['task']['audited_by'];

        if(isset($request['audit_code'])){
            //audit by code;
            $user = DB::table('user')->where('id',$assigment['task']['created_by'])->first();
            //dump($user);
           // dump($request);
            if($request['audit_code']==$user->audit_passwd){
                //pass audit
                //1. update assignment
                $assigment['current_value'] += $request['add_value'];
                $assigment['percent'] = $assigment['current_value'] / ($assigment['task']['total_value']);

                if($assigment['percent']>=1){
                    $assigment['finish_flag'] = 1;
                }
                $assigment->save();
                //2. update sort
                $as = Assignment::where('task_id',$assigment['task']['id'])->orderBy('current_value','desc')->get();
                for($i=1;$i<=count($as);$i++){
                    $as[$i]['sort']=$i;
                    $as[$i]->save();
                }
                $request['feedback'] ="audit through audit_code";
                $request['result'] = "1";
                AuditRequest::create($request);
                return redirect('/assignment/list');
            }else{
                return back()->withErrors(['audit_code'=>['Error audit code']])->with('old',$request);
            }
        }else{
            //audit by website;
            $request['result'] = "0";
            dump($request);
            AuditRequest::create($request);
            return redirect('request/list/user');
        }
    }


    public function audit($rid,$c){
        $auditRequest = AuditRequest::find($rid);
        $assignment = Assignment::find($auditRequest['assignment_id']);
        if($c=='1'){
            //pass audit
            //1. update assignment
            $assignment['current_value'] += $auditRequest['add_value'];
            $assignment['percent'] = $assignment['current_value'] / ($assignment['task']['total_value']);

            if($assignment['percent']>=1){
                $assignment['finish_flag'] = 1;
            }
            $assignment->save();

            //2. update sort
            $as = Assignment::where('task_id',$assignment['task']['id'])->orderBy('current_value','desc')->get();
            for($i=0;$i<count($as);$i++){
                $as[$i]['sort']=$i+1;
                $as[$i]->save();
            }
            $auditRequest['feedback'] ="Approve";
            $auditRequest['result'] = $c;
        }else{
            $auditRequest['feedback'] ="Refuse";
            $auditRequest['result'] = $c;
        }
        $auditRequest->save();
        return redirect(route('request.list.audit'));
    }


    /**
     * @param Request $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $data)
    {
        $data->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'total_num' => 'required|numeric',
        ]);
        $data['remaining_num'] = $data['total_num'];
        $result = Award::where('id', $data['id'])->update($data->except(['_token', 'file_upload', '_method']));
        return redirect('award/list');
    }


    /**
     *
     * delete an award
     * @param $award_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        AuditRequest::destroy($id);
        return redirect('request/list/user');

    }

}
