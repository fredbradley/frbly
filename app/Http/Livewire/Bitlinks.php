<?php

namespace App\Http\Livewire;

use App\Actions\Bitly\DeleteBitlink;
use App\Models\Bitlink;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Bitlinks extends Component
{
    use AuthorizesRequests;
    public $updateMode = false;
    public $bitlinks, $title, $body;
    public $deleteId;

    public function render()
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Bitlink Deleted Successfully.',
        ]);

        $this->bitlinks = Bitlink::latest()->get();
        return view('livewire.bitlinks');
    }

    public function resetInputFields()
    {

    }

    public function setDeleteId($id)
    {
        $this->authorize('delete', Bitlink::find($id));
        $this->deleteId = $id;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'long_url' => 'required',
            'domain' => 'required',
        ]);

        Bitlink::create($validatedData);

        session()->flash('message', 'Bitlink Created Successfully.');

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Bitlink::findOrFail($id);
        $this->id = $id;
        $this->long_url = $post->title;
        $this->body = $post->body;

        $this->updateMode = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @return void
     */
    public function delete(): void
    {
        $this->authorize('delete', Bitlink::find($this->deleteId));

        (new DeleteBitlink())->delete(Bitlink::find($this->deleteId));

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Bitlink Deleted Successfully.',
        ]);
        session()->flash('message', 'Bitlink Deleted Successfully.');
    }
}
