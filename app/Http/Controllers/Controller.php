<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function per_page(Request $request)
    {
        $per_page = $request->input('per_page', 20);
        Cookie::queue('per_page', $per_page, 60 * 24 * 30);

        return back();
    }
    public function status(Request $request)
    {
        $ids    = $request->input('ids', []);
        $status = $request->input('status', 1);

        // convert to array
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $list = [];
        foreach ($ids as $id) {
            $list[] = (int) $id;
        }

        $this->model->whereIn('id', (array) $list)->update(['status' => (int) $status]);

        $message = [
            'error'  => 0,
            'status' => 'success',
            'msg'    => 'Đã cập nhật trạng thái!',
        ];

        if ($request->ajax()) {
            return response()->json($message);
        } else {
            return back()->with('message', $message);
        }
    }
    public function delete(Request $request)
    {
        $ids = $request->input('ids', []);

        // chuyển sang kiểu array
        if (!is_array($ids)) {
            $ids = [$ids];
        }

        $list = [];
        foreach ($ids as $id) {
            $list[] = (int) $id;
        }

        $number = $this->model->destroy($list);

        $message = [
            'error'  => 0,
            'status' => 'success',
            'msg'    => "Đã xóa $number bản ghi!",
        ];

        if ($request->ajax()) {
            return response()->json($message);
        } else {
            return back()->with('message', $message);
        }
    }
    public function action(Request $request)
    {
        $method = $request->input('method', '');
        if ($method == 'delete') {
            return $this->delete($request);
        } elseif ($method == 'status') {
            return $this->status($request);
        } elseif ($method == 'special') {
            return $this->special($request);
        } elseif ($method == 'per_page') {
            return $this->per_page($request);
        } elseif ($method == 'assigned_staff') {
            return $this->assigned_staff($request);
        }
        return back();
    }
    protected static function jsonSuccess($data=[], $msg = "Thành công!", $info=[], $logs = []) {
        return response()->json(['success' => true, 'msg' => $msg, 'data' => $data, 'info' => $info], 200);
    }
    protected static function jsonError($reason = "Không thành công!", $data = [], $logs = []) {
        return response()->json(['success' => false, 'msg' => $reason, 'data' => $data], 200);
    }
}
