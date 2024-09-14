@twillRepeaterTitle('Вопрос - ответ')
@twillRepeaterTrigger('Добвить вопрос и ответ')

<x-twill::input name="question" label="Текст вопроса" />

<x-twill::wysiwyg name="answer" label="Текст ответа" placeholder="Text" :toolbar-options="[
    'bold',
    'italic',
    ['list' => 'bullet'],
    ['list' => 'ordered'],
    ['script' => 'super'],
    ['script' => 'sub'],
    'link',
    'clean',
]" />
