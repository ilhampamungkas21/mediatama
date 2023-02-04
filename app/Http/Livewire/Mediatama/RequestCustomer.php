<?php

namespace App\Http\Livewire\Mediatama;

use Livewire\Component;
use App\Models\ModelCustomerRequest;
use App\Models\User;
use App\Models\ModelVideo;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;


class RequestCustomer extends Component
{
    use LivewireAlert;

    public $id_user,$id_video,$status,$acces_start,$acces_end;
    //public $request_id;


    public $user_id;
    public $video_id;


    protected $rules = [
        'user_id' => 'required',
        'video_id' => 'required',
        'acces_start' => 'required',
        'acces_end' => 'required',
       
    ];

    public function render()
    {
        return view('livewire.mediatama.request-customer',[
            'request' => ModelCustomerRequest::all(),
            'time_now' => Carbon::now(),
            'customer' => User::all(),
            'video' => ModelVideo::all(),
        ]);
    }

    public function close_modal()
    {
         $this->acces_start = '';
        $this->acces_end = '';
        $this->resetErrorBag();
    }


    public function tambah_akses()
    {

        if (ModelCustomerRequest::select('*')
        ->where('id_user', '=', $this->user_id,)
        ->where('id_video', '=', $this->video_id)
        ->exists())
        {
            $this->alert('info', 'Halo Sobat Mediatama', [
                'position' => 'center',
                'timer' => '4000',
                'toast' => true,
                'text' => 'Permintaan customer untuk bisa akses video ini sudah ada, silahkan di atur kembali',
               ]);
        }
        else
        {
            $this->validate();
            ModelCustomerRequest::Create([
               'id_user' => $this->user_id,
               'id_video' => $this->video_id,
               'acces_start' => $this->acces_start,
               'acces_end' => $this->acces_end,
   
           ]);
           $this->acces_start = '';
           $this->acces_end = '';
           $this->alert('success', 'Success', [
               'position' => 'top-end',
               'timer' => 3000,
               'toast' => true,
               'timerProgressBar' => true,
               'text' => 'Data berhasil di input',
              ]);
        }
 

    }

    public function edit($id)
    {
        $request = ModelCustomerRequest::where('id',$id)->first();

         $this->request_id = $id;
         //$this->status = $request->status;
         $this->id_user = $request->user->name;
         $this->id_video = $request->video->url_video;
         $this->acces_start = $request->acces_start;
         $this->acces_end = $request->acces_end;

     }

     public function update_request()
     {
         $validatedDate = $this->validate([
            'status' => 'required',
            'acces_start' => 'required',
            'acces_end' => 'required',


         ]);
         if ($this->request_id) 
         {

                $video = ModelCustomerRequest::find($this->request_id);
                $video->update([
                    'status' => $this->status,
                    'acces_start' => $this->acces_start,
                    'acces_end' => $this->acces_end,
                    
                ]);

                $this->alert('success', 'Success', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'timerProgressBar' => true,
                    'text' => 'Berhasil di konfirmasi',
                   ]);


         }
     }

     public function deleteId($id)
     {
         $this->deleteId = $id;
     }


     public function delete()
     {
        ModelCustomerRequest::find($this->deleteId)->delete();
      $this->alert('success', 'Success', [
        'position' => 'top-end',
        'timer' => 3000,
        'toast' => true,
        'timerProgressBar' => true,
        'text' => 'Data berhasil di hapus',
       ]);
     }
}
