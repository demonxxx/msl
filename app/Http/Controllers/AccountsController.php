<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Account;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Validator;
use Carbon\Carbon;
use App\Transaction;
use App\TransactionUser;
use Illuminate\Support\Facades\DB;


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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function load_list(Request $request)
    {
        $posts = get_post_datatable_new($request->all());
        $account = new User();
        $data = $account->get_all_accounts($posts);
        $length = $account->count_all($posts);
        $result = build_json_datatable_new($data, $length, $posts);
        return $result;
    }

    public function resetTransaction(Request $request)
    {
        $request->session()->forget('account_type');
        $request->session()->forget('transaction_type');
        $request->session()->forget('amount');
        $request->session()->forget('note');
        $request->session()->forget('transaction_customers');
        $request->session()->forget('transaction_date');
        $request->session()->forget('transaction_code');
        $request->session()->forget('admin');
    }

    public function transactionConfirm(Request $request)
    {
        if (empty($request->session()->get('admin'))){
            flash_message("Chưa tạo giao dịch!", "danger");
            return redirect('admin/transaction/create');
        }
        $account_type = $request->session()->get('account_type', 1);
        $transaction_type = $request->session()->get('transaction_type', 1);
        $amount = $request->session()->get('amount', 1);
        $note = $request->session()->get('note', 1);
        $transaction_customers_tmp = json_decode($request->session()->get('transaction_customers', []));
        $transaction_customers = array_unique($transaction_customers_tmp);
        $transaction_date = Carbon::now()->toDateTimeString();
        $admin_id = $request->session()->get('admin');
        $user = User::find($admin_id);
        $transaction_max = Transaction::max("id") + 1;
        $transaction_code = "GD-" . $transaction_max . "-" . Carbon::now()->year . "-" . Carbon::now()->month . "-" . Carbon::now()->day;
        $request->session()->put('transaction_date', $transaction_date);
        $request->session()->put('transaction_code', $transaction_code);
        return view("app.accounts.confirm", ["account_type"     => $account_type,
                                             "transaction_type" => $transaction_type,
                                             "amount"           => $amount,
                                             "note"             => $note,
                                             "transaction_date" => $transaction_date,
                                             "admin"            => $user,
                                             "total_amount"     => (int) count($transaction_customers) * (int) $amount,
                                             "total_user"       => count($transaction_customers),
                                             "transaction_code" => $transaction_code]);
    }

    public function getTransactionUsers(Request $request)
    {
        $transaction_customers_tmp = json_decode($request->session()->get('transaction_customers', []));
        $transaction_customers = array_unique($transaction_customers_tmp);
        $account_model = new Account;
        $transaction_user_info = $account_model->get_transaction_users($transaction_customers);
        return json_encode($transaction_user_info);
    }

    public function handleTransaction(Request $request){
//        dd("handle Transaction");
        $account_type = $request->session()->get('account_type');
        $transaction_type = $request->session()->get('transaction_type');
        $amount = $request->session()->get('amount');
        $note = $request->session()->get('note');
        $transaction_date = $request->session()->get('transaction_date');
        $transaction_code = $request->session()->get('transaction_code');
        $admin_id = $request->session()->get('admin');
        $transaction_customers_tmp = json_decode($request->session()->get('transaction_customers', []));
        $transaction_customers = array_unique($transaction_customers_tmp);
        $isSuccess = 1;
        DB::beginTransaction();
        try
        {
            $transaction = new Transaction;
            $transaction->code = $transaction_code;
            $transaction->creator_id = $admin_id;
            $transaction->amount = $amount;
            $transaction->transaction_type = $transaction_type;
            $transaction->account_type = $account_type;
            $transaction->note = $note;
            $transaction->transaction_date = $transaction_date;
            $transaction->save();
            foreach ($transaction_customers as $transaction_customer){
                $customer_account = Account::where("user_id", $transaction_customer)->first();
                if ($account_type == ACCOUNT_TYPE_MAIN){
                    if ($transaction_type == TRANSACTION_TYPE_ADD){
                        $customer_account->main = $customer_account->main + (int) $amount;
                    }else if($transaction_type == TRANSACTION_TYPE_SUB){
                        $customer_account->main = $customer_account->main - (int) $amount;
                    }else{
                        $isSuccess = 0;
                    }
                }else if ($account_type == ACCOUNT_TYPE_SECOND){
                    if ($transaction_type == TRANSACTION_TYPE_ADD){
                        $customer_account->second = $customer_account->second + (int) $amount;
                    }else if($transaction_type == TRANSACTION_TYPE_SUB){
                        $customer_account->second = $customer_account->second - (int) $amount;
                    }else{
                        $isSuccess = 0;
                    }
                }else {
                    $isSuccess = 0;
                }
                $customer_account->save();
                $transactionUser = new TransactionUser;
                $transactionUser->user_id = $transaction_customer;
                $transactionUser->transaction_id = $transaction->id;
                $transactionUser->save();
            }
            if ($isSuccess == 1){
                DB::commit();
            }
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            $isSuccess = 0;
        }
        if ($isSuccess == 1){
            flash_message("Giao dịch thành công!", "success");
            return redirect('admin/transaction/create');
        }else {
            flash_message("Giao dịch không thành công!", "danger");
            return redirect('admin/transaction/create');
        }
    }

    public function cancelTransaction(Request $request){
        $this->resetTransaction($request);
        flash_message("Hủy giao dịch thành công!", "success");
        return redirect('admin/transaction/create');
    }

    public function putTransaction(Request $request)
    {
        $this->resetTransaction($request);
        $validator = Validator::make($request->all(), [
            "account_type"          => "required|numeric",
            "transaction_type"      => "required|numeric",
            "amount"                => "required|integer|min:0",
            "note"                  => "required",
            "transaction_customers" => "required",
        ]);
        if ($validator->fails()) {
            flash_message("Tạo giao dịch không thành công!", "danger");
            return redirect('admin/transaction/create')->withErrors($validator)->withInput();
        }
        $user_ids = json_decode($request->transaction_customers);
        if (empty($user_ids)) {
            flash_message("Tạo giao dịch không thành công!", "danger");
            return redirect('admin/transaction/create')->withErrors("Không có người dùng nào!")->withInput();
        }
        $admin = Auth::user();
        if($admin->isAdmin()){
            $request->session()->put('account_type', $request->account_type);
            $request->session()->put('transaction_type', $request->transaction_type);
            $request->session()->put('amount', $request->amount);
            $request->session()->put('note', $request->note);
            $request->session()->put('transaction_customers', $request->transaction_customers);
            $request->session()->put('admin', $admin->id);
            return redirect('admin/transaction/confirm');
        }else {
            flash_message("Bạn không được phép thực hiện giao dịch này!", "danger");
            return redirect('admin/transaction/create');
        }
    }

    public function update_money(Request $request)
    {
        $acc = new Account();
        $account = $acc->where('user_id', $request->id)->first();
        if ($account != null) {
            if ($request->type == 1) {
                $account->main = $account->main + $request->money;
            } else {
                $account->main = $account->main - $request->money;
            }
            $account->save();
        } else {
            $acc->user_id = $request->id;
            if ($request->type == 1) {
                $acc->main = $request->money;
            } else {
                $acc->main = 0 - $request->money;
            }
            $acc->save();
        }
        flash_message("Giao dịch tài khoản thành công!");
    }
}