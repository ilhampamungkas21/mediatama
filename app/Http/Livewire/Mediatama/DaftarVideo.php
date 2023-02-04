<?php

namespace App\Http\Livewire\Mediatama;

use Livewire\Component;
use App\Models\ModelVideo;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class DaftarVideo extends Component
{

    use LivewireAlert;
    public $name_video,$url_video;
    public $video_id;
    public $deleteId = '';

    public function render()
    {
        return view('livewire.mediatama.daftar-video',[
            'video' => ModelVideo::all(),
        ]);
    }

    protected $rules = [
        'name_video' => 'required',
        'url_video' => 'required',
       
    ];

    public function tambah_video()
    {
       
        $this->validate();
    
        ModelVideo::Create([
            'name_video' => $this->name_video,
            'url_video' => $this->url_video,


        ]);


        $this->name_video = '';
        $this->url_video = '';


        $this->alert('success', 'Success', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
            'text' => 'Data berhasil di input',
           ]);
    }

    public function edit($id)
    {
        $video = ModelVideo::where('id',$id)->first();

         $this->video_id = $id;
         $this->name_video = $video->name_video;
         $this->url_video = $video->url_video;        
         
    }

     public function update_video()
     {
         $validatedDate = $this->validate([
            'name_video' => 'required',
            'url_video' => 'required',
         ]);
         if ($this->video_id) 
         {

        
                $video = ModelVideo::find($this->video_id);
                $video->update([
                    'name_video' => $this->name_video,
                    'url_video' => $this->url_video,
                    
                ]);

                $this->alert('success', 'Success', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'timerProgressBar' => true,
                    'text' => 'Data berhasil di update',
                   ]);


         }
     }


     public function deleteId($id)
     {
         $this->deleteId = $id;
     }


     public function delete()
     {
      ModelVideo::find($this->deleteId)->delete();
      $this->alert('success', 'Success', [
        'position' => 'top-end',
        'timer' => 3000,
        'toast' => true,
        'timerProgressBar' => true,
        'text' => 'Data berhasil di hapus',
       ]);
     }

}