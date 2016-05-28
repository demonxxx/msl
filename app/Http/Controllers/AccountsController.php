<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Account;


class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.accounts.index');
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
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    
    public function load_list(Request $request) {
        $posts = get_post_datatable_new($request->all());
        $account = new User();
        $data = $account->get_all_accounts($posts);
        $length = $account->count_all($posts);
        $result = build_json_datatable_new($data, $length, $posts);
        return $result;
    }
    
    public function update_money(Request $request)
    {
        $acc = new Account();
        $account = $acc->where('user_id', $request->id)->first();
        if ($account != null) {
            if ($request->type == 1) {
                $account->main = $account->main + $request->money ;
            }
            else {
                $account->main = $account->main - $request->money;
            }
            $account->save();
        }
        else {
            $acc->user_id = $request->id;
            if ($request->type == 1) {
                $acc->main = $request->money ;
            }
            else {
                $acc->main = 0 - $request->money;
            }
            $acc->save();
        }
        flash_message("Giao dịch tài khoản thành công!");
    }
}