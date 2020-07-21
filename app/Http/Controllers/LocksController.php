<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lock;
use Illuminate\Support\Facades\Storage;

class LocksController extends Controller
{
    public function create(Request $request)
    {
        $lock = new Lock();



        if(strlen($request->input('latitude')) > 0) {
            $lock->user_id = $request->input('user_id') ?? 1;
            $lock->latitude = $request->input('latitude') ?? null;
            $lock->longitude = $request->input('longitude') ?? null;
            $lock->date_locked = $request->input('date_locked') ?? null;
            $lock->names = $request->input('names') ?? null;
            $lock->lock_icon = $request->input('lock_icon') ?? null;
            //$lock->lock_image_url = $request->input('lock_image_url') ?? null;
            $lock->message = $request->input('message') ?? null;
            $lock->status = 1;


            $lock->save();

            if ($request->input('lock_image')) {

                $file_data = $request->input('lock_image');
                //generating unique file name;
                $file_name = 'lock_images/lock_image_'. $lock->id . '_' . time().'.png';

                if($file_data!=""){
                    if(Storage::disk('s3')->put($file_name,base64_decode($file_data))){
                        $lock->lock_image_url = Storage::disk('s3')->url($file_name);
                    }
                }
            }

            $lock->save();

            return response($lock->toJson(), 200);
        }else{
            return response("Date can not be null", 404);
        }
    }

    public function get(Request $request, $lock_id = null)
    {
        if($lock_id){
            $lock = Lock::find($lock_id);

            if($lock){
                return response($lock->toJson(), 200);
            }else{
                return response("Lock not found.", 404);
            }
        }

        $user_id = $request->input('user_id');
        $limit = $request->input('limit');
        $offset = $request->input('offset', 0);

        $locks = Lock::query();

        if($limit && $offset){
            $locks->limit($limit)->offset($offset);
        }

        if($user_id){
            $locks->where('created_by', $user_id);
        }


        $locks = $locks->get();

        return response($locks->toJson(), 200);
    }

    public function update(Request $request, $lock_id)
    {


        $lock = Lock::find($lock_id);

        if(strlen($request->input('latitude')) > 0) {
            $lock->user_id = $request->input('user_id') ?? 1;
            $lock->latitude = $request->input('latitude') ?? null;
            $lock->longitude = $request->input('longitude') ?? null;
            $lock->date_locked = $request->input('date_locked') ?? null;
            $lock->names = $request->input('names') ?? null;
            $lock->lock_icon = $request->input('lock_icon') ?? null;
            //$lock->lock_image_url = $request->input('lock_image_url') ?? null;
            $lock->message = $request->input('message') ?? null;
            $lock->user_id = $request->input('user_id') ?? null;
            $lock->status = 1;


            $lock->save();

            if ($request->input('lock_image')) {

                $file_data = $request->input('lock_image');
                //generating unique file name;
                $file_name = 'lock_images/lock_image_' . $lock->id . '_' . time() . '.png';

                if ($file_data != "") {
                    if (Storage::disk('s3')->put($file_name, base64_decode($file_data))) {
                        $lock->lock_image_url = Storage::disk('s3')->url($file_name);
                    }
                }
            }

            $lock->save();
        }

        return response($lock->toJson(), 200);
    }

    public function delete(Request $request, $lock_id)
    {
        $force_delete = $request->input('force_delete');

        if($force_delete == true){
            $lock = Lock::find($lock_id);

            $lock->forceDelete();
        }else{
            $lock = Lock::destroy($lock_id);
        }

        return response("", 204);
    }
}
