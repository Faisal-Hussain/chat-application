<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use stdClass;

class MF extends Model
{
    //
    public static function Upload($file, $pid = 0)
    {
        //dd($file);
        $image = $file;
        $ext = $image->extension();
        $imageName = $image->getClientOriginalName();
        $size = 0;
        $user_id = Auth::user() ? Auth::user()->id : 0;
        $path = public_path('uploads/media/' . $user_id . '/' . date("Y_m_d"));
        $sort_path = $user_id . '/' . date("Y_m_d");

        $new_file = md5($imageName . time()) . '.' . $ext;
        if ($image->move($path, $new_file)) {
            $uploader = new MF();
            $uploader->name = $new_file;
            $uploader->pid = $pid;
            $uploader->uid = $user_id;
            $uploader->size = $size;
            $uploader->ext = $ext;
            $uploader->short_path = $sort_path;
            $uploader->original_name = $imageName;
            $uploader->save();
            return $uploader->id;
        } else {
            return false;
        }
    }

    public static function UploadFromUrl($url, $userId = false)
    {
        $client = new Client();
        $response = $client->get($url);
        if ($response->getStatusCode() == 200) {
            $contentType = $response->getHeader('Content-Type')[0];
            $extension = '';

            if (preg_match('/\/(.+)$/', $contentType, $matches)) {
                $extension = $matches[1];
            }
            $user_id = Auth::user() ? Auth::user()->id : ($userId ? $userId : 0);
            $path = 'media/' . $user_id . '/' . date("Y_m_d");
            $filename = uniqid() . '.' . $extension;
            $sort_path = $user_id . '/' . date("Y_m_d");
            if (Storage::disk('default_up')->put($path.'/'.$filename, $response->getBody())) {
                $uploader = new MF();
                $uploader->name = $filename;
                $uploader->pid = 0;
                $uploader->uid = $user_id;
                $uploader->size = 0;
                $uploader->ext = $extension;
                $uploader->short_path = $sort_path;
                $uploader->original_name = $filename;
                $uploader->save();
                return $uploader->id;
            } else {
                return null;
            }
        }
        return null;
        $ext_array = explode('.', $url);
        $file_ext = end($ext_array);
        $avatar_src = file_get_contents($url);
        $newname = md5(time() . $url);
        $newname .= '.' . $file_ext;
        $user_id = Auth::user() ? Auth::user()->id : ($userId ? $userId : 0);
        $path = public_path('uploads/media/' . $user_id . '/' . date("Y_m_d"));
        $sort_path = $user_id . '/' . date("Y_m_d");
        if (file_put_contents($path . '/' . $newname, $avatar_src)) {
            $uploader = new MF();
            $uploader->name = $newname;
            $uploader->pid = 0;
            $uploader->uid = $user_id;
            $uploader->size = 0;
            $uploader->ext = $file_ext;
            $uploader->short_path = $sort_path;
            $uploader->original_name = $newname;
            $uploader->save();
            return $uploader->id;
        } else {
            return false;
        }
    }

    public static function deleteFile($id)
    {
        $file_info = MF::find($id);

        if (unlink(public_path('uploads/media/' . $file_info->short_path . '/' . $file_info->name))) {
            $file_info->delete();
            return true;
        } else {
            return false;
        }
    }
    public function deleteFileUser($id)
    {
        $file_info = MF::find($id);
        if ($file_info->user_id != Auth::user()->id) return false;
        if (unlink(public_path('uploads/media/' . $file_info->short_path . '/' . $file_info->name))) {
            $file_info->delete();
            return true;
        } else {
            return false;
        }
    }
    public function get_media($last_id)
    {
        $data_o = MF::where('visible', 0)->where(function ($data_o) {
            if (Auth::user()->role_id != 10) {
                $data_o->where('user_id', Auth::user()->id);
            }
        })->where('id', '>', $last_id)->limit('30')->orderBy('created_at', 'DESC')->get();
        $out = [];
        foreach ($data_o as $k => $v) {
            $tout = array(
                "id"    =>  $v->id,
                "original_name" =>  $v->original_name,
                "file_extension"    =>  $v->ext,
                "size"  =>  $v->size,
                "name"  =>  $v->name,
                "user_id"   =>  $v->uid,
                "short_path"    =>  $v->short_path,
                "preview_url"   =>  url('/') . 'uploads/media/' . $v->short_path . '/' . $v->name,
                'date'  =>  $v->created_at,
            );
            $out[] = $tout;
        }
        return $out;
    }
    public static function GetMFVia($array, $json = false)
    {
        if ($json == true) {
            $array = json_decode($array, true);
        }
        $out = [];
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                $mf = MF::find($v);
                if ($mf) {
                    $o = new stdClass;
                    $o->url = asset('uploads/media') . '/' . $mf->short_path . '/' . $mf->name;
                    $o->name = $mf->name;
                    $o->status = 1;
                    $o->original_name = $mf->original_name;
                    $o->id = $mf->id;
                }
                if (isset($o)) $out[] = $o;
            }
        }
        return $out;
    }
    public static function GetMF($mf)
    {
        $mf = MF::find($mf);
        if (!$mf) return null;
        return ['status' => 1, 'url' => asset('uploads/media') . '/' . $mf->short_path . '/' . $mf->name, 'id' => $mf->id, 'name' =>  $mf->name, 'original_name' => $mf->original_name];
    }
    public static function GetMFSingle($array, $json = false)
    { //$array=json_decode($array,true);exit;
        if ($json == true) {
            $array = json_decode($array, true);
        }
        if (!$array) return null;
        $mf = MF::find($array[0]);
        if (!$mf) return null;
        $o = new stdClass;
        $o->url = asset('uploads/media') . '/' . $mf->short_path . '/' . $mf->name;
        $o->name = $mf->name;
        $o->status = 1;
        $o->original_name = $mf->original_name;
        $o->id = $mf->id;
        return $o;
        //return ['status'=>1,'url'=>asset('uploads/media').'/'.$mf->short_path.'/'.$mf->name,'id'=>$mf->id,'name' =>  $mf->name,'original_name'=>$mf->original_name];
    }

    public static function GetBladeMF($id, $is_profile = false)
    {
        $mf = MF::find($id);
        if (!$mf) {
            if ($is_profile == true) {
                return asset('img/avatar.png');
            }
            return asset('img/cover.jpg');
        }
        $o = new stdClass;
        $o->url = asset('uploads/media') . '/' . $mf->short_path . '/' . $mf->name;
        $o->name = $mf->name;
        $o->status = 1;
        $o->original_name = $mf->original_name;
        $o->id = $mf->id;
        return $o->url;
    }

    public static function GetBladeSingle($array, $json = false)
    {
        if ($json == true) {
            $array = json_decode($array, true);
        }

        if (!$array) return asset('img/cover.jpg');
        $mf = MF::find($array[0]);
        if (!$mf) return null;
        $o = new stdClass;
        $o->url = asset('uploads/media') . '/' . $mf->short_path . '/' . $mf->name;
        $o->name = $mf->name;
        $o->status = 1;
        $o->original_name = $mf->original_name;
        $o->id = $mf->id;
        return $o->url;

        //return ['status'=>1,'url'=>asset('uploads/media').'/'.$mf->short_path.'/'.$mf->name,'id'=>$mf->id,'name' =>  $mf->name,'original_name'=>$mf->original_name];
    }
}
