@twillBlockTitle('FAQ')
@twillBlockTitleField('title')
@twillBlockIcon('info')

<x-twill::input
  :translated="true"
  name="title"
  label="Naslov"
  placeholder="Vnesite naslov"
/>
<x-twill::repeater
  type="faq-item"
/>
