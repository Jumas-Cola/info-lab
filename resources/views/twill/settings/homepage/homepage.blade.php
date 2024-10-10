@twillBlockTitle('Homepage')
@twillBlockIcon('text')
@twillBlockGroup('app')

<x-twill::input name="logo" label="Лого" />

<x-twill::repeater type="homepage_question" />

<x-twill::repeater type="fun_facts" />

<x-twill::repeater type="site_faces" />

<x-twill::repeater type="roadmap_items" />

<x-twill::wysiwyg name="footerText" label="Текст в подвале сайта" placeholder="Text" :toolbar-options="[
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
