<x-twill::input
  :translated="true"
  name="meta.title"
  label="Naslov"
  placeholder="Vnesite naslov"
  :maxlength="60"
/>
<x-twill::input
  :translated="true"
  type="textarea"
  name="meta.description"
  label="Opis"
  placeholder="Vnesite opis"
  :maxlength="160"
  :rows="2"
/>
<x-twill::input
  :translated="true"
  type="textarea"
  name="meta.keywords"
  label="Ključne besede"
  placeholder="Vnesite ključne besede"
  note='Ločeno z ","'
  :rows="2"
/>
