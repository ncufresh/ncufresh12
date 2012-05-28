<?php

class AboutController extends Controller
{
    /**
     * Displays about us, this just a static page.
     */
    public function actionIndex() {
        $this->render('index');
    }
}