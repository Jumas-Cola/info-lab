@twillRepeaterTitle('Вопрос теста')
@twillRepeaterTrigger('Добвить вопрос теста')

<x-twill::wysiwyg name="question" label="Текст вопроса" placeholder="Текст вопроса" :toolbar-options="[
    ['header' => [2, 3, 4, 5, 6, false]],
    'bold',
    'italic',
    'underline',
    'strike',
    'blockquote',
    'code-block',
    'ordered',
    'bullet',
    'hr',
    'code',
    'link',
    'clean',
    'table',
    'align',
]" />

<x-twill::medias name="highlight" label="Вопрос картинкой" />

<x-twill::checkbox name="multiple_choice" label="Несколько вариантов" />

<x-twill::repeater type="test_question_answer" />
