@twillBlockTitle('Video')
@twillBlockTitleField('title')
@twillBlockIcon('video')

<x-twill::input
  :translated="true"
  name="title"
  label="Naslov"
  placeholder="Vnesite naslov"
  note="Opcijsko"
/>
<p>
  Primer <u><b>ID</b></u> videa iz povezave:<br>
  <span style="font-size:80%;">https://www.youtube.com/watch?v=</span><u><b>WzHPcv9MIEI</b></u><span style="font-size:80%;">&query=...</span>
</p>
<x-twill::input
  name="yt_id"
  label="ID videa"
  placeholder="Vnesite ID videa"
/>
