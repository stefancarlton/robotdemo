#!/usr/bin/env php
<?php
//check arg1 & 2 (environment & type)
if (!isset( $argv[1] )) {
  echo "\nUsage: " . basename( __FILE__ ) . " dataFileName\n\n";
  exit( 1 );
} else {
  $filename = $argv[1];
}


//set the autoloader up
require_once('./AutoLoader.php');
AutoLoader::setRootPath( '../' );
AutoLoader::registerRootPath();


$file_path = './Data/';

$environment = \robotdemo\Models\Environment::create( 5, 5 );

$instruction_translator = new \robotdemo\Models\Instructions\Translator();

$instructions = $instruction_translator->translateFile( $file_path . $filename );

foreach ($instructions as $instruction) {
  $output = $environment->issueInstruction( $instruction );

  if ($instruction instanceof \robotdemo\Models\Instructions\Report) {
    echo $output . "\n\n";
  }
}

