<div x-data="aiChatBtn">
    <button @click="formAiShow = !formAiShow" type="button" class="btn btn-primary rounded-circle btn-lg" id="btnAiChat">
        <i class="fas fa-comment"></i>
    </button>

    <div x-cloak x-show="formAiShow" class="chat-popup bg-body-tertiary p-3 rounded shadow" x-transition>
        <x-page.ai-chat />
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('aiChatBtn', () => ({
            formAiShow: false,
        }))
    })
</script>
