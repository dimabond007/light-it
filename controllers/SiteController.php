<?php


class SiteController
{

    public function actionIndex()
    {
        User::checkLogged();

    	$url = 'http://www.gismeteo.ua/city/daily/5093/';
        $file=file_get_contents($url);
        $doc=phpQuery::newDocument($file);
        $hentry=$doc->find('div.rframe#weather-daily');
        foreach ($hentry as $element)
        {
            pq($element)->find('.wtitle.h2')->remove();
            pq($element)->find('.section')->remove();
            pq($element)->find('.wtab')->remove();
            pq($element)->find('#tab_wdaily3')->remove();
            pq($element)->find('.wicon.wind7')->remove();
        }
        
        View::generate( '/views/site/index.php', ['hentry' => $hentry]);

        return true;
    }

}
