<?php namespace ASM\Foundation\BreadcrumbManager;

class BreadcrumbConfigFactory {

    /**
     * Create a new breadcrumb object based on proper config file. You need to keep Route <-> Config mapping
     * updated in this file.
     *
     * @param $currentRoute
     * @param array $except
     *
     * @return Breadcrumb
     * @throws \Exception
     */
    public static function create($currentRoute, $except = [])
    {
        if (in_array($currentRoute, $except))
        {
            return null;
        }

        $configClass = implode('', array_map('ucfirst', explode('.', $currentRoute)));
        $configClass = 'ASM\Configs\Breadcrumbs\\' . $configClass;

        if (!class_exists($configClass))
        {
            throw new \Exception('Current route does not have a breadcrumb configuration class. Please define "'.$configClass.'".');
        }

        return \App::make($configClass);
    }

}