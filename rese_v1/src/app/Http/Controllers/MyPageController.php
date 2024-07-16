<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        // フォームデータのバリデーションを実行し、検証済みデータを取得
        $validatedData = $request->validated();

        // ユーザーがログインしているか確認
        if (Auth::check()) {
            try {
                // トランザクションを開始
                \DB::beginTransaction();

                // 予約情報を作成して保存
                $reservation = new Reservation();
                $reservation->user_id = Auth::id();
                $reservation->restaurant_id = $validatedData['restaurant_id'];
                $reservation->reservation_date = $validatedData['reservation_date'];
                $reservation->reservation_time = $validatedData['reservation_time'];
                $reservation->party_size = $validatedData['party_size'];
                $reservation->save();

                // トランザクションをコミット
                \DB::commit();
                
                Session::forget('reservation_data');
                // 成功時の処理
                return redirect()->route('reservation.done')->with('success', '予約が完了しました。');
            } catch (\Exception $e) {
                // トランザクションをロールバック
                \DB::rollBack();

                // エラーが発生した場合はエラーメッセージをセッションに保存してリダイレクト
                return redirect()->route('reservation.done')->with('error', '予約の保存中にエラーが発生しました。');
            }
        } else {
            // ログインしていない場合はログインページにリダイレクト
            return redirect()->route('login')->with('error', '予約をするにはログインが必要です。');
        }
    }

    public function done()
    {
        return view('done');
    }

    public function destroy($id)
    {
        // ユーザーがログインしているか確認
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', '予約を削除するにはログインが必要です。');
        }

        // 予約を取得して所有者を確認するかどうか（例えば、ユーザーが予約の所有者であることを確認する）
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return redirect()->back()->with('error', '指定された予約が見つかりませんでした。');
        }

        // ユーザーが予約の所有者でない場合はエラーを返す
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->back()->with('error', '他のユーザーの予約を削除することはできません。');
        }

        // 予約を削除する
        $reservation->delete();

        // 成功時のメッセージを返す
        return redirect()->back()->with('success', '予約が正常に削除されました。');
    }

       public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('updateReservation', compact('reservation'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'party_size' => 'required|integer|min:1',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->reservation_date = $request->input('reservation_date');
        $reservation->reservation_time = $request->input('reservation_time');
        $reservation->party_size = $request->input('party_size');
        $reservation->save();

        return redirect()->route('mypage')->with('success', '予約内容が更新されました');
    }
}
