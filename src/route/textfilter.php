<?php
/**
 * Textfilter specific routes.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Test textfilter
 */
$app->router->get('textfilter/test', function () use ($app) {
    $data = [
        'title' => "Test av textfilter"
    ];

    $textFilter = new \Joln\Content\TextFilter();

    $bbText = file_get_contents('../content/text/bbcode.txt');
    $data['bbText'] = $bbText;
    $data['bbTextFormatted'] = $textFilter->parse($bbText, ['bbcode']);

    $mcText = file_get_contents('../content/text/clickable.txt');
    $data['mcText'] = $mcText;
    $data['mcTextFormatted'] = $textFilter->parse($mcText, ['link']);

    $mdText = file_get_contents('../content/text/sample.md');
    $data['mdText'] = $mdText;
    $data['mdTextFormatted'] = $textFilter->parse($mdText, ['markdown']);

    $nbText = "Text\nText2";
    $data['nbText'] = $nbText;
    $data['nbTextFormatted'] = $textFilter->parse($nbText, ['nl2br']);

    $app->view->add('textfilter/test', $data);
    $app->page->render($data);
});
