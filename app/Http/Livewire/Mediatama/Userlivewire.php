<?php

namespace App\Http\Livewire\Mediatama;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Userlivewire extends Component
{
    use LivewireAlert;
    public $name,$email,$password,$level;
    public $customer_id;
    public $deleteId = '';



    public function render()
    {
        return view('livewire.mediatama.user',[
            'user' => User::all(),
        ]);
    }

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'level' => 'required',
       
    ];

    public function tambah_customer()
    {
       
        $this->validate();
    
        User::Create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'level' => $this->level,

        ]);


        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->level = '';

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
        $customer = User::where('id',$id)->first();

         $this->customer_id = $id;
         $this->name = $customer->name;
         $this->email = $customer->email;
         $this->level = $customer->level;

         $this->password = '';
        
         
     }

     public function update_customer()
     {
         $validatedDate = $this->validate([
             'name' => 'required',
             'level' => 'required',
         ]);
         if ($this->customer_id) {
            if($this->password==''){

                //dd('tidak ada password');
                $customer = User::find($this->customer_id);
                $customer->update([
                    'name' => $this->name,
                    'level' => $this->level,
                    
                ]);

                $this->alert('success', 'Success', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'timerProgressBar' => true,
                    'text' => 'Data berhasil di update tidak dengan password',
                   ]);
            }

            if($this->password !=null){

                //dd(' ada password');
                $customer = User::find($this->customer_id);
                $customer->update([
                    'name' => $this->name,
                    'level' => $this->level,
                    'password' => $this->password,
                    
                ]);

                $this->alert('success', 'Success', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'timerProgressBar' => true,
                    'text' => 'Data berhasil di update beserta password',
                   ]);
            }

         }
     }


     public function deleteId($id)
     {
         $this->deleteId = $id;
     }


     public function delete()
     {
      User::find($this->deleteId)->delete();
      $this->alert('success', 'Success', [
        'position' => 'top-end',
        'timer' => 3000,
        'toast' => true,
        'timerProgressBar' => true,
        'text' => 'Data berhasil di hapus',
       ]);
     }


}
