<div x-data="test_{{ $block->id }}" class="prose">
    <div class="fs-3">{{ $block->input('title') }}</div>
    <ul class="list-group list-group-numbered">
        <template x-for="(question, questionIndex) in questions" :key="question.id">
            <li class="list-group-item">
                <div class="w-75 d-inline-flex align-items-center justify-content-between mb-2">
                    <div>
                        <template x-if="question.question !== null">
                            <div x-html="question.question"></div>
                        </template>
                        <template x-if="question.question_image !== null">
                            <img :src="question.question_image" alt="" class="border border-1"
                                style="max-width: 350px">
                        </template>
                    </div>

                    <div>
                        <div x-show="results[question.id] === false">
                            <div class="d-flex bg-danger text-white rounded-pill p-2">
                                <i class="bi bi-x-octagon me-1"></i> Неправильно
                            </div>
                        </div>
                        <div x-show="results[question.id] === true">
                            <div class="d-flex bg-success text-white rounded-pill p-2">
                                <i class="bi bi-check-circle me-1"></i> Правильно
                            </div>
                        </div>
                    </div>
                </div>
                <template x-if="errors[question.id] !== undefined">
                    <div class="alert alert-danger mt-2" role="alert" x-text="errors[question.id]">
                    </div>
                </template>
                <template x-for="(answer, answerIndex) in question.answers" :key="answer.id">
                    <div class="form-check">
                        <template x-if="!question.multiple_choice">
                            <input class="form-check-input border border-1 border-primary" type="radio"
                                :value="answer.id" :name="`answer-${testId}-${question.id}`"
                                :id="`check-${answer.id}`" @input="setAnswer(question.id, answer.id, 'radio')">
                        </template>
                        <template x-if="question.multiple_choice">
                            <input class="form-check-input border border-1 border-primary" type="checkbox"
                                :value="answer.id" :name="`answer-${testId}-${question.id}`"
                                id="`check-${answer.id}`" @input="setAnswer(question.id, answer.id, 'checkbox')">
                        </template>
                        <label class="form-check-label" for="`check-${answer.id}`" x-text="answer.answer">
                        </label>
                        <template x-if="answer.answer_image !== null">
                            <img :src="answer.answer_image" alt="" class="border border-1"
                                style="max-width: 350px">
                        </template>
                    </div>
                </template>
            </li>
        </template>
    </ul>
    <div x-show="allAnswered" class="form-group">
        <button class="btn btn-lg btn-primary" @click="checkAnswers">Проверить</button>
        <div class="fs-4" x-show="stats">
            <span class="text-success">
                <span x-text="stats.correctPercentage"></span>%
                правильно
            </span>
            /
            <span class="text-danger">
                <span x-text="stats.incorrectPercentage"></span>%
                неправильно
            </span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('test_{{ $block->id }}', () => ({
            answers: {},
            errors: {},
            results: {},
            checkAnswersUrl: "{{ route('test-check') }}",
            allAnswered: false,
            testId: {{ $block->id }},
            questions: @json($block->questions),
            init() {
                this.questions = JSON.parse(this.questions);
                for (let question of this.questions) {
                    this.answers[question.id] = [];
                }
            },
            checkAnswers() {
                this.errors = {};
                for (let [id, answer] of Object.entries(this.answers)) {
                    if (answer.length === 0) {
                        this.errors[id] = 'Вы не выбрали ни одного ответа';
                        return;
                    }
                }

                const testCheck = new TestCheckApi(this.checkAnswersUrl);
                const results = testCheck.checkAnswers(this.testId, this.answers);

                results.then(res => {
                    this.results = res.data.results;
                    this.stats = res.data.stats;
                });
            },
            checkAllAnswered() {
                for (let [id, answer] of Object.entries(this.answers)) {
                    if (answer.length === 0) {
                        return false;
                    }
                }
                return true;
            },
            setAnswer(questionId, answerId, type) {
                this.errors[questionId] = undefined;
                if (this.answers[questionId] !== undefined) {
                    if (type === 'radio') {
                        this.answers[questionId] = [answerId]
                    } else if (type === 'checkbox') {
                        if (this.answers[questionId].includes(answerId)) {
                            this.answers[questionId] = this.answers[questionId].filter(id => id !==
                                answerId);
                        } else {
                            this.answers[questionId].push(answerId)
                        }
                    }
                } else {
                    this.answers[questionId] = [answerId]
                }

                this.allAnswered = this.checkAllAnswered();
            }
        }))
    })
</script>
