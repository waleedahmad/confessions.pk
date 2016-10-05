<?php

namespace App\Http\Controllers;

use App\Models\Confession;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class APIController extends Controller
{
    /**
     * Return all confessions
     * @return mixed
     */
    public function getConfessions(){
        return response()->json([
            'confessions'   =>  [
                Confession::all()
            ]
        ]);
    }

    /**
     * Post confession
     * @param Request $request
     * @return mixed
     */
    public function postConfession(Request $request){
        $validator = Validator::make($request->all(), [
            'text'  =>  'required',
            'category'  =>  'required',
            'mood'  =>  'required'
        ]);

        if($validator->passes()){

            $text = $request->input('text');
            $category = $request->input('category');
            $mood = $request->input('mood');

            $confession = new Confession([
                'confession'    =>  $text,
                'category'  =>  $category,
                'mood'  =>  $mood
            ]);

            if($confession->save()){
                return response()->json([
                    'success'   =>  'true',
                    'message'   =>  'Confessions posted'
                ]);
            }else{
                return response()->json([
                    'success'   =>  'false',
                    'message'   =>  'Error occurred'
                ]);
            }
        }else{
            return response()->json([
                'success'   =>  'false',
                'message'   =>  $validator->errors()
            ]);
        }
    }

    /**
     * Delete confession
     * @param Request $request
     * @return mixed
     */
    public function deleteConfession(Request $request){
        $validator = Validator::make($request->all(), [
            'id'  =>  'required',
        ]);

        if($validator->passes()){
            $id = $request->input('id');
            $confession = Confession::where('id', '=', $id);

            if($confession->count()){

                $confession = $confession->first();

                if($confession->delete()){
                    return response()->json([
                        'success'   =>  'true',
                        'message'   =>  'Confessions deleted'
                    ]);
                }else{
                    return response()->json([
                        'success'   =>  'false',
                        'message'   =>  'Unable to delete confession'
                    ]);
                }
            }else{
                return response()->json([
                    'success'   =>  'false',
                    'message'   =>  'Invalid confession id'
                ]);
            }


        }else{
            return response()->json([
                'success'   =>  'false',
                'message'   =>  $validator->errors()
            ]);
        }
    }

    /**
     * Update confession
     * @param Request $request
     * @return mixed
     */
    public function updateConfession(Request $request){
        $validator = Validator::make($request->all(), [
            'id'  =>  'required',
            'text'  =>  'required'
        ]);

        if($validator->passes()){
            $id = $request->input('id');
            $text = $request->input('text');

            $confession = Confession::where('id', '=', $id);

            if($confession->count()){

                $confession = $confession->first();

                if($confession->update([
                    'confession'    =>  $text
                ])){
                    return response()->json([
                        'success'   =>  'true',
                        'message'   =>  'Confessions updated'
                    ]);
                }else{
                    return response()->json([
                        'success'   =>  'false',
                        'message'   =>  'Unable to update confession'
                    ]);
                }
            }else{
                return response()->json([
                    'success'   =>  'false',
                    'message'   =>  'Invalid confession id'
                ]);
            }


        }else{
            return response()->json([
                'success'   =>  'false',
                'message'   =>  $validator->errors()
            ]);
        }
    }
}
