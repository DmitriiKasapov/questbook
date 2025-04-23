@twillRepeaterTitle('Gumb')
@twillRepeaterTrigger('Dodaj gumb')
@twillRepeaterTitleField('title', ['hidePrefix' => true])

<x-twill::checkbox
  name="hidden"
  label="Skrij?"
/>
<x-twill::select
  name="icon"
  label="Ikona"
  placeholder="Izberite ikono"
  :options="[]"
  :searchable="true"
/>
<x-twill::input
  :translated="true"
  name="title"
  label="Naslov"
  placeholder="Vnesite naslov"
/>
<x-twill::input
  :translated="true"
  name="link"
  label="Povezava"
  placeholder="Vnesite povezavo"
  type="url"
/>
<x-twill::checkbox
  name="new_window"
  label="Odpri v novem oknu?"
/>
