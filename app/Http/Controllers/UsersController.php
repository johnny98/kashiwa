<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
   public function index()
    {
        //キーワード受け取り
        $keyword = \Input::get('keyword');

        //クエリ生成
        $query = User::query();

        //もしキーワードがあったら
        if(!empty($keyword))
        {
            $query->where('email','like','%'.$keyword.'%')
                  ->orWhere('name','like','%'.$keyword.'%')
                  ->orWhere('addr','like','%'.$keyword.'%')
                  ->orWhere('ctry','like','%'.$keyword.'%');
        }
        
        // del_flgが０の場合
        $query->where('del_flg',0) ;

        //ページネーション
        $users = $query->orderBy('id','desc')->paginate(10);
        return view('users.index')->with('users',$users)
                                  ->with('keyword',$keyword);
    }
    
        public function create()
    {
        $ctry = \Config::get('define.ctry');
        //createに転送
        return view('users.create');
    }
    
        public function store(Request $request)
    {
        //バリデーション

        //評価対象
        $inputs = $request->all();

        //ルール
        $rules = [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'addr'=>'required',
            'ctry'=>'required',
        ];

        $messages = [
            'name.required'=>'名前は必須です。',
            'email.required'=>'emailは必須です。',
            'email.email'=>'emailの形式で入力して下さい。',
            'email.unique'=>'このemailは既に登録されています。',
            'addr.required'=>'住所は必須です。',
            'ctry.required'=>'国籍を選択してください。',
        ];

        $validation = \Validator::make($inputs,$rules,$messages);

        //エラー次の処理
        if($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        //バリデーションOKなら、今まで通り。


        //userオブジェクト生成
        $user = User::create();

        //値の登録
        $user->name = $request->name;
        $user->email = $request->email;
        $user->addr = $request->addr;
        $user->ctry = $request->ctry;

        //保存
        $user->save();

        //一覧にリダイレクト
        return redirect()->to('/users');
    }
    
        public function edit($id)
    {
        //レコードを検索
        $user = User::find($id);
        //検索結果をビューに渡す
        return view('users.edit')->with('user',$user);
    }
    
        public function update(Request $request, $id)
    {
        //レコードを検索
        $user = User::find($id);
        //値を代入
        $user->name = $request->name;
        $user->email = $request->email;
        $user->addr = $request->addr;
        $user->ctry = $request->ctry;
        //保存（更新）
        $user->save();
        //リダイレクト
        return redirect()->to('/users');
    }
    
        public function show($id)
    {
        //レコードを検索
        $user = User::find($id);
        //検索結果をビューに渡す
        return view('users.show')->with('user',$user);
    }
    
        public function destroy($id)
    {
        //削除対象レコードを検索
        $user = User::find($id);
        //アップデート
        $user->del_flg = 1;
        $user->save();
        //リダイレクト
        return redirect()->to('/users');
    }
}
