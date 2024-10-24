<x-main-layout>
    <div class="container mt-3">
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">AI помощник</h5>
                <div class="container">
                    <div x-data="aiChat">
                        <div class="card-body">
                            <div id="scrollArea" class="overflow-auto" style="height: 400px;">
                                <template x-for="(msg, index) in chatMessages" :key="index">
                                    <div>
                                        <template x-if="msg.isTeacher">
                                            <div class="d-flex flex-row justify-content-start mb-4">
                                                <img class="bg-primary rounded-circle h-100 p-1" :src="teacherAvatar"
                                                    alt="avatar 1" style="width: 45px;">
                                                <div class="p-3 ms-3"
                                                    style="border-radius: 15px;  max-width: 75%; background-color: rgba(57, 192, 237,.2);">
                                                    <p class="small mb-0" x-html="msg.text"></p>
                                                </div>
                                            </div>
                                        </template>

                                        <template x-if="!msg.isTeacher">
                                            <div class="d-flex flex-row justify-content-end mb-4">
                                                <div class="p-3 me-3 border bg-body-tertiary"
                                                    style="border-radius: 15px; max-width: 75%;">
                                                    <p class="small mb-0" x-text="msg.text"></p>
                                                </div>
                                                <img class="rounded-circle h-100" :src="userAvatar" alt="avatar 1"
                                                    style="width: 45px;">
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>

                            <div class="d-flex justify-content-center align-items-center mt-3">
                                <div x-show="loading" class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <div class="form-outline d-flex mt-3">
                                <textarea x-model="message" @keyup.enter="send" class="form-control bg-body-tertiary border-1" id="textAreaExample"
                                    rows="4"></textarea>
                                <div class="d-flex justify-content-center align-items-center">
                                    <button class="btn btn-primary rounded-circle ms-2" type="button" @click="send">
                                        <i class="bi bi-send"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('aiChat', () => ({
                message: null,
                scrollArea: null,
                loading: false,
                aiClient: null,
                aiChatUrl: "{{ route('activity.ai-teacher.chat') }}",
                teacherAvatar: "{{ Vite::asset('resources/images/service-03.png') }}",
                userAvatar: "{{ Vite::asset('resources/images/placeholder.jpg') }}",
                chatMessages: [{
                    text: "Привет, ты можешь задать мне любой вопрос по информатике, и я постараюсь на него ответить.",
                    date: "2022-01-01 12:00:00",
                    isTeacher: true
                }, ],
                init() {
                    this.aiClient = new AiTeacherApi(this.aiChatUrl);
                    this.scrollArea = document.getElementById('scrollArea');
                },
                send() {
                    this.message = `${this.message}`.trim();
                    if (this.message?.length > 0) {
                        this.chatMessages.push({
                            text: this.message,
                            date: new Date().toLocaleString(),
                            isTeacher: false
                        })
                        this.scrollArea.scrollTo(0, this.scrollArea.scrollHeight);

                        this.loading = true;
                        this.aiClient.send(this.message).then(res => {
                            this.chatMessages.push({
                                text: marked.parse(res?.data.text),
                                date: new Date().toLocaleString(),
                                isTeacher: true
                            })
                        }).finally(() => {
                            this.scrollArea.scrollTo(0, this.scrollArea.scrollHeight);
                            this.loading = false;
                        });

                        this.message = null;
                    }
                },
            }))
        })
    </script>
</x-main-layout>
