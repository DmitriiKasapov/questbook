@twillBlockTitle('Gumbi')
@twillBlockTitleField('title')
@twillBlockIcon('b-button')

<x-twill::input
  :translated="true"
  name="title"
  label="Naslov"
  placeholder="Vnesite naslov"
/>
<x-twill::repeater
  type="link"
/>
