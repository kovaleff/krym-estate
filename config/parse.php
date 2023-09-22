<?php

return [
  'developers_image_path' => 'developers/',
  'aparts_image_path' => 'aparts/',
  'move' => [
      'base_link' => 'https://krim.move.ru',
      'link' => 'https://krim.move.ru/companies/developers/?limit=100',
      'developer_container_class' => 'items-list',
      'aparts_container_expression' => "//*[contains(@class, 'items-list') and contains(@class, 'similar-novostroyki')]",
      'aparts_expression' => "//*[contains(@class, 'items-list') and contains(@class, 'similar-novostroyki')]",
      'developer_element_class' => 'items-list__line',
  ]
];
