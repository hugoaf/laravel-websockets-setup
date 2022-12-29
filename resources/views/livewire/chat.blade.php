<div class="grid w-full">
    <h1 class="text-lg p-4">Chat</h1>
    <div x-data="{ 'messages': @entangle('messages') }" x-init="window.addEventListener('load', () => {
        Echo.channel('test-public-channel')
            .listen('NewMessageEvent', (e) => {
                messages.push(e.message)
            });
    });" class="p-8 bg-gray-100">
        <template x-for="message in messages" :key="message.id">
            <div class="flex flex-col mb-2 max-w-lg bg-white p-2 rounded">
                <span x-text="message.created_at" class="text-xs text-gray-400"></span>
                <span x-text="message.text" class="text-sm"></span>
            </div>
        </template>
    </div>
    <form wire:submit.prevent="sendMessage" class="flex fixed bottom-0 space-x-2 w-full bg-gray-400 p-6">
        <textarea type="text" wire:model.defer="textMessage" class="m-2 p-4 text-xl w-full" autofocus></textarea>
        <button class="bg-blue-500 p-2 px-4 my-2 rounded text-white ">Enviar</button>
    </form>
</div>
