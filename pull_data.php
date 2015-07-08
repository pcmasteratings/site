<?php
require_once "res/include.php";

echo GBApi::search('metroid prime', GBSearchType::Game, [
  'id',
  'name',
  'original_release_date',
  'image',
  'api_detail_url'
  ]);
