@twillBlockTitle('Homepage')
@twillBlockIcon('text')
@twillBlockGroup('app')

<x-twill::input
    name="logo"
    label="Лого"
/>

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
