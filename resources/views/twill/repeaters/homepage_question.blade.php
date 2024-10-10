@twillRepeaterTitle('Вопрос - ответ')
@twillRepeaterTrigger('Добавить вопрос и ответ')

<x-twill::input name="question" label="Текст вопроса" />

<x-twill::wysiwyg name="answer" label="Текст ответа" placeholder="Text" :toolbar-options="[
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
