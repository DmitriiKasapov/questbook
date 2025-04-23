{{-- Example array:
  //Form
  $form = [
    //Fieldset
    [
      //Inputs
      'class' => 'some-class another-one',
      'legend' => 'legendary'
      'inputs' => [
          'component' => 'checkbox', //component value corresponds to blade name in form-items
          'label' => 'Domena',
          'name' => 'domain',
      ],
      [
          'component' => 'checkbox',
          'label' => 'Gostovanje',
          'name' => 'hosting',
      ]
    ],

    //Fieldset
    [
      //Inputs
      'inputs' => [
          'component' => 'checkbox',
          'label' => 'Spletna trgovina',
          'name' => 'shop',
      ]
    ]
  ]
--}}

<form wire:submit.prevent="{{ $submit ?? 'submit' }}">
  @foreach ($form as $fieldset)
    <fieldset @class([$fieldset['class'] ?? ''])>
      @if ($fieldset['legend'] ?? '')
        <legend>{{ $fieldset['legend'] }}</legend>
      @endif
      @foreach ($fieldset['inputs'] as $input)
        <?php
          $component = $input['component'] ?? '' ? 'form-items.' . $input['component'] : 'form-items.text-input';
          $label = $input['label'] ?? '';
          $name = $input['name'] ?? '';
          $options = $input['options'] ?? '';
          $placeholder = $input['placeholder'] ?? '';
          $type = $input['type'] ?? '';

          /* Select specific */
          $initval = $input['initval'] ?? '';
        ?>
        <x-dynamic-component :$component :$name :$options :$placeholder :$type :$initval>
          {{ $label }}
        </x-dynamic-component>
      @endforeach
    </fieldset>
  @endforeach
  {{ $slot }}
  <x-button>
    {{ $button }}
  </x-button>
</form>
