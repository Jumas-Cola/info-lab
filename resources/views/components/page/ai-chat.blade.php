<div>
    <div x-data="aiChat">
        <div class="card-body">
            <div id="scrollArea" class="overflow-auto" style="height: 400px;">
                <template x-for="(msg, index) in renderedChatMessages" :key="index">
                    <div>
                        <template x-if="msg.isTeacher">
                            <div class="d-flex flex-row justify-content-start mb-4">
                                <img class="bg-primary rounded-circle h-100 p-1" :src="teacherAvatar" alt="avatar 1"
                                    style="width: 45px;">
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
                                    <p class="small mb-0" x-html="msg.text" style="white-space: pre;"></p>
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
                <textarea autofocus maxlength="1000" x-model="message" @keyup.shift.enter="send"
                    class="form-control bg-body-tertiary border-1" id="promptTextArea" rows="4" x-bind:disabled="loading"></textarea>
                <div class="d-flex justify-content-center align-items-center">
                    <div>
                        <div>
                            <button title="Отправить сообщение" class="btn btn-primary rounded-circle ms-2"
                                type="button" @click="send" x-bind:disabled="loading">
                                <i class="bi bi-send"></i>
                            </button>
                        </div>
                        <div class="mt-1">
                            <button title="Сбросить контекст" class="btn btn-secondary rounded-circle ms-2"
                                type="button" @click="resetContext" x-bind:disabled="loading">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <label class="mt-1 text-muted" for="promptTextArea">
                Отправить Shift + Enter
            </label>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('aiChat', () => ({
                message: "",
                scrollArea: null,
                textArea: null,
                loading: false,
                aiClient: null,
                aiChatUrl: "{{ route('activity.ai-teacher.chat') }}",
                teacherAvatar: "{{ Vite::asset('resources/images/service-03.png') }}",
                userAvatar: "{{ Vite::asset('resources/images/placeholder.jpg') }}",
                initChatMessages: [{
                    text: "Привет, ты можешь задать мне любой вопрос по информатике, и я постараюсь на него ответить.",
                    date: "2022-01-01 12:00:00",
                    isTeacher: true
                }, ],
                chatMessages: null,
                renderedChatMessages: null,
                stripTags(html) {
                    const div = document.createElement("div");
                    div.innerHTML = html;
                    return div.textContent || div.innerText || "";
                },
                init() {
                    this.aiClient = new AiTeacherApi(this.aiChatUrl);
                    this.scrollArea = document.getElementById('scrollArea');
                    this.textArea = document.getElementById('promptTextArea');
                    this.resetContext();
                },
                resetContext() {
                    this.chatMessages = [...this.initChatMessages];
                    this.renderedChatMessages = [...this.initChatMessages];
                },
                send() {
                    this.message = `${this.message}`.trim();
                    const md = markdownit({
                        html: true,
                        highlight: function(str, lang) {
                            if (lang && hljs.getLanguage(lang)) {
                                try {
                                    return '<pre><code class="hljs">' +
                                        hljs.highlight(str, {
                                            language: lang,
                                            ignoreIllegals: true
                                        }).value +
                                        '</code></pre>';
                                } catch (__) {}
                            }

                            return '<pre><code class="hljs">' + md.utils.escapeHtml(str) +
                                '</code></pre>';
                        }
                    }).use(tm, {
                        engine: katex,
                        delimiters: "dollars",
                        katexOptions: {
                            macros: {
                                "\\RR": "\\mathbb{R}",
                            }
                        }
                    });
                    if (!this.loading && this.message?.length > 0) {
                        let messageObj = {
                            text: this.stripTags(this.message),
                            date: new Date().toLocaleString(),
                            isTeacher: false
                        };
                        this.chatMessages.push(messageObj);
                        messageObj.text = messageObj.text.replaceAll('\n', '<br>');
                        this.renderedChatMessages.push(messageObj);
                        this.scrollArea.scrollTo(0, this.scrollArea.scrollHeight);

                        this.loading = true;
                        this.aiClient.send(this.chatMessages).then(res => {
                            this.chatMessages.push({
                                text: res?.data.text,
                                date: new Date().toLocaleString(),
                                isTeacher: true
                            })
                            this.renderedChatMessages.push({
                                text: md.render(res?.data.text).replaceAll('\n', '<br>'),
                                date: new Date().toLocaleString(),
                                isTeacher: true
                            })
                        }).catch((err) => {
                            if (err?.response?.status === 429) {
                                Toastify.error('Слишком много запросов',
                                    'Пожалуйста, попробуйте через минуту');
                            }
                        }).finally(() => {
                            this.scrollArea.scrollTo(0, this.scrollArea.scrollHeight);
                            this.loading = false;
                            setTimeout(() => {
                                this.textArea.focus({
                                    focusVisible: true
                                });
                            }, 100);
                        });

                        this.message = "";
                    }
                },
            }))
        })
    </script>
</div>
