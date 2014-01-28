<?php

require_once __DIR__.'/../vendor/autoload.php';

$loader = new Twig_Loader_Array(array(
    'test' => '|# This is a test #| My name is || name ||.'
));

$twig = new Twig_Environment($loader);

$lexer = new Twig_Lexer($twig, array(
    'tag_comment'     => array('|#', '#|'),
    'tag_block'       => array('|%', '%|'),
    'tag_variable'    => array('||', '||')
));

$twig->setLexer($lexer);

echo $twig->render('test', array('name' => 'Thibaud'));
