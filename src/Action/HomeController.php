<?php

namespace Felipecwb\Catho\Action;

class HomeController extends Controller
{
    public function indexPage()
    {
        return $this->getTwig()->render('position.php');
    }
}
