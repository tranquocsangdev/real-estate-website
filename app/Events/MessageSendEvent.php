<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSendEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Message $message)
    {
        //
    }

    /**
     * Phát lên kênh public "chat".
     * Client chỉ cần lắng nghe channel 'chat' là nhận được.
     */
    public function broadcastOn(): Channel
    {
        return new Channel('chat');
    }

    /**
     * Tên event phía client sẽ nghe là ".MessageSentEvent"
     */
    public function broadcastAs(): string
    {
        return 'MessageSentEvent';
    }

    /**
     * Dữ liệu gửi kèm event (client nhận được)
     */
    public function broadcastWith(): array
    {
        return [
            'id'         => $this->message->id,
            'from_id'    => $this->message->from_id,
            'to_id'      => $this->message->to_id,
            'message'    => $this->message->message,
            'is_read'    => (bool) $this->message->is_read,
            'created_at' => optional($this->message->created_at)->toDateTimeString(),
        ];
    }
}
