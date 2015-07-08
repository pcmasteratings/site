<?php
require('res/include.php');

$json = GBApi::search('halo 5',
GBSearchType::Game,
[
  'id',
  'name',
  'original_release_date',
  'image',
  'api_detail_url',
  'deck',
  'image',
  'platforms'
],
10);

echo $json;
