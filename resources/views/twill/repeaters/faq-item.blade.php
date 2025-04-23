@twillRepeaterTitle('Vprašanje')
@twillRepeaterTrigger('Dodaj vprašanje')
@twillRepeaterTitleField('title', ['hidePrefix' => true])

<x-twill::input
  :translated="true"
  name="title"
  label="Vprašanje"
  placeholder="Vnesite vprašanje"
/>
<x-twill.wysiwyg
  :toolbar-options="[
    'bold',
    'italic',
    'underline',
    'link',
    'bullet',
  ]"
/>
