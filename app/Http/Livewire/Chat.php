<?php

namespace App\Http\Livewire;

use App\Events\NewMessageEvent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public Message $message;

    public $messages;

    public $textMessage;

    public function render()
    {
        $this->messages = array_reverse(Message::latest()->limit(10)->get()->toArray());

        return view('livewire.chat');
    }

    public function sendMessage(){
        $this->message = new Message();
        $this->message->user_id = 1;
        $this->message->text =  $this->textMessage;

        $this->message->save();
                
        broadcast(new NewMessageEvent($this->message))->toOthers();

        $this->textMessage = "";
    }

}
