<?php

use ASM\Foundation\BreadcrumbManager\Breadcrumb;
use ASM\Foundation\BreadcrumbManager\BreadcrumbConfigFactory;

class DashboardController extends BaseController {

    /*
     * @var
     */
    protected $breadcrumbConfig;

    public function __construct()
    {
        $this->breadcrumbConfig = BreadcrumbConfigFactory::create(Route::currentRouteName());
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $breadcrumb = new Breadcrumb($this->breadcrumbConfig, []);

        return View::make('dashboard.index', compact('breadcrumb'));
    }

}
