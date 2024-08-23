@twillRepeaterTitle('Test Question')

<x-twill::input
    name="question"
    label="Текст вопроса"
/>

<x-twill::medias
    name="highlight"
    label="Вопрос картинкой"
/>

<x-twill::checkbox
    name="multiple_choice"
    label="Несколько вариантов"
/>

<x-twill::repeater type="test_question_answer"/>

