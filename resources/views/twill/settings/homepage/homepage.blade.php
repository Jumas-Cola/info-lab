@twillBlockTitle('Homepage')
@twillBlockIcon('text')
@twillBlockGroup('app')

<x-twill::input
    name="logo"
    label="Лого"
/>

<x-twill::repeater type="homepage_question"/>

<x-twill::repeater type="fun_facts"/>

<x-twill::wysiwyg
    name="footerText"
    label="Текст в подвале сайта"
    placeholder="Text"
    :toolbar-options="[
        'bold',
        'italic',
        ['list' => 'bullet'],
        ['list' => 'ordered'],
        [ 'script' => 'super' ],
        [ 'script' => 'sub' ],
        'link',
        'clean',
    ]"
/>
