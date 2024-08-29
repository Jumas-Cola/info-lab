@twillBlockTitle('CodeRunner')
@twillBlockIcon('text')
@twillBlockGroup('app')

<x-twill::input
    type="textarea"
    name="default_input"
    label="Default Input"
/>

<x-twill::input
    type="textarea"
    name="default_code"
    label="Default Code"
    placeholder="Code"
/>

<x-twill::repeater type="test_case"/>
