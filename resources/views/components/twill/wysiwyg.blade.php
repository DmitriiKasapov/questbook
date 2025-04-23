<x-twill::wysiwyg
  :translated="true"
  :edit-source="true"
  :name="$name ?? 'text'"
  label="Tekst"
  placeholder="Vnesite tekst"
  :note="$note ?? ''"
  :toolbar-options="$toolbarOptions ?? [
    [ 'header' => [3, false] ],
    'bold',
    'italic',
    'underline',
    'link',
    'bullet',
    'table',
    'clean',
  ]"
/>
