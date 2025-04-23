@twillBlockTitle('Meta')

<x-twill::input
  :translated="true"
  name="title"
  label="Naslov"
  placeholder="Vnesite naslov"
  :maxlength="60"
/>
<x-twill::input
  :translated="true"
  type="textarea"
  name="description"
  label="Opis"
  placeholder="Vnesite opis"
  :maxlength="160"
  :rows="3"
/>
<x-twill::input
  :translated="true"
  type="textarea"
  name="keywords"
  label="Ključne besede"
  placeholder="Vnesite ključne besede"
  note='Ločeno z ","'
  :rows="2"
/>
<x-twill::medias
  name="free"
  label="Slika"
/>
