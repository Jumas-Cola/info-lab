@twillRepeaterTitle('План развития проекта')
@twillRepeaterTrigger('Добвить пункт плана развития')

<x-twill::medias name="highlight" label="Highlight" />

<x-twill::input name="badge" label="Бейдж" />

<x-twill::input name="title" label="Заголовок" />

<x-twill::date-picker
    name="date"
    label="Дата релиза"
    :minDate="\Carbon\Carbon::now()->format('Y-m-d H:i')"
/>

<x-twill::browser
    module-name="pages"
    name="page"
    label="Статьи"
    :max="1"
/>
