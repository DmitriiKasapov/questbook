<?php

return [

    'required' => 'Поле :attribute обязательно для заполнения.',
    'max' => [
        'string' => 'Поле :attribute не должно превышать :max символов.',
    ],
    'exists' => 'Выбранное значение для поля :attribute недопустимо.',
    'in' => 'Значение поля :attribute должно быть одним из доступных вариантов.',
    'string' => 'Поле :attribute должно быть строкой.',
    'integer' => 'Поле :attribute должно быть числом.',

    // Можно добавить кастомные названия полей
    'attributes' => [
        'story_id' => 'история',
        'branch_id' => 'ветка',
        'type' => 'тип',
        'content' => 'текст сцены',
        'choice_1_text' => 'выбор 1',
        'choice_2_text' => 'выбор 2',
        'choice_1_target_scene_id' => 'целевая сцена 1',
        'choice_2_target_scene_id' => 'целевая сцена 2',
    ],
];
