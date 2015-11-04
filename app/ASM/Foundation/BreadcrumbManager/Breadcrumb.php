<?php namespace ASM\Foundation\BreadcrumbManager;

class Breadcrumb {

    /**
     * @var array
     */
    public $links;

    /**
     * @var array
     */
    public $currentPage;

    /**
     * @param BreadcrumbConfigInterface $config
     * @param array $params
     */
    public function __construct(BreadcrumbConfigInterface $config, $params = [])
    {
        $parts = $config->getParts($params);
        $this->currentPage = array_pop($parts);
        $this->links = $parts;
    }

}