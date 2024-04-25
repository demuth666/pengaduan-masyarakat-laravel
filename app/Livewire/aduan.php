<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pengaduan;
use Livewire\WithFileUploads;


class Aduan extends Component
{
    public $aduan;
    public $user_id;
    public $tanggal;
    public $bukti;
    public $status;

    use WithFileUploads;

    public function store()
    {
        $rules = [
            'user_id' => 'nullable',
            'aduan' => 'required',
            'tanggal' => 'required',
            'bukti' => 'nullable|image|max:1024',
            'status' => 'nullable',
        ];
        $validated = $this->validate($rules);
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'Belum Ditinjau';
        $validated['bukti'] = $this->bukti->store('bukti', 'public');
        Pengaduan::create($validated);
        session()->flash('message', 'Aduan berhasil dikirim');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.pengaduan');
    }
}
