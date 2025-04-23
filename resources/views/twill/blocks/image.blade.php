@twillBlockTitle('Slika s tekstom')
@twillBlockTitleField('title')
@twillBlockIcon('image-text')

<x-twill::input
  :translated="true"
  name="title"
  label="Naslov"
  placeholder="Vnesite naslov"
  note="Opcijsko"
/>
<x-twill::medias
  name="image"
  label="Slika"
/>
<x-twill.wysiwyg
  :toolbar-options="[
    'bold',
    'italic',
    'underline',
    'link',
    'bullet',
    'clean',
  ]"
/>
