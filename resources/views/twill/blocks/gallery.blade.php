@twillBlockTitle('Galerija')
@twillBlockTitleField('title')
@twillBlockIcon('image')

<x-twill::input
  :translated="true"
  name="title"
  label="Naslov"
  placeholder="Vnesite naslov"
  note="Opcijsko"
/>
<x-twill::medias
  name="square"
  label="Slike"
  :max="10"
/>
