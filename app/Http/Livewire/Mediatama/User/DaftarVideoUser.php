<?php

namespace App\Http\Livewire\Mediatama\User;

use Livewire\Component;
use App\Models\ModelVideo;
use App\Models\ModelCustomerRequest;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DaftarVideoUser extends Component
{
    use LivewireAlert;
    public $detail = false;
    public $detail_name_video;
    public $detail_created_at;
    public $detail_id;
    public $detail_status;
    public $detail_url_video;
    public $id_video;
    public $date_now;
    public $date_end;



    public function render()
    {
        return view('livewire.mediatama.user.daftar-video-user',[
            'video' => ModelVideo::all(),
        ]);
    }

    public function detail($id)
    {
        $detail_first = ModelVideo::where('id',$id)->first();

        $this->detail_id = $detail_first->id;
        $this->detail_name_video = $detail_first->name_video;
        $this->detail_created_at = $detail_first->created_at;
        //$this->detail_url_video= $detail_first->url_video;
        $this->detail =true;
        $this->id_video = $detail_first ->id;

      

        if ($detail_request = ModelCustomerRequest::select('*')
        ->where('id_user', '=', Auth::id() )
        ->where('id_video', '=', $this->detail_id)
        ->exists())
        {
            $cek_status = ModelCustomerRequest::select('*')
            ->where('id_user', '=', Auth::id() )
            ->where('id_video', '=', $this->id_video)->first();

            $this->detail_status = $cek_status->status;
            $this->date_end=$cek_status->acces_end;

            $this->date_now = Carbon::now()->format('Y-m-d H:i:m');


            // if($this->date_end < $this->date_now){
            //     dd($this->detail_url_video= $detail_first->url_video,'kudune wis entek');
            // }

            if($this->date_end < $this->date_now){
                //waktu dah habis
                $this->detail_url_video= 'habis';
            }
            elseif($this->date_end > $this->date_now)
            {
                //waktu belom habis
                $this->detail_url_video= $detail_first->url_video;
            }


          

        }



    }

    public function detail_back()
    {

        $this->detail =false;
        //ketika ditekan back detail status tereset
        $this->detail_status='';
       // $this->$detail_url_video='';
    
    

    }


    public function request_video()
    {

        if (ModelCustomerRequest::select('*')
        ->where('id_user', '=', Auth::id() )
        ->where('id_video', '=', $this->detail_id)
        ->exists()) {
            $this->alert('info', 'Halo Sobat Mediatama', [
                'position' => 'center',
                'timer' => '4000',
                'toast' => true,
                'text' => 'Permintaan kamu sedang diproses , mohon bersabar.Terimakasih',
               ]);
         }
         else{

            ModelCustomerRequest::Create([
                'id_video' => $this->detail_id,
                'id_user' => Auth::id(),
            ]);
    
            $this->alert('success', 'Success', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
                'text' => 'Berhasil meminta request video harap menunggu',
               ]);

         }
       

    }



}
