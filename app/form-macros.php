<?php
// Checkbox list of all capabilities
Form::macro('chooseCapabilities', function($name, $selected = [], $options = array())
{
    $selected = is_null($selected) ? [] : $selected;
    $capabilities = ASM\Contexts\Capabilities\Capability::get();
    $capabilityCategories = ASM\Contexts\Capabilities\Capability::groupBy('category')->get()->lists('category');
    $markup = '<div class="border1 pdng10" style="height: 250px; overflow-y: scroll;">';

    foreach ($capabilityCategories as $category)
    {
        $categoryLabel = ucwords(str_replace('_', ' ', $category));
        $categoryCapabilities = $capabilities->filter(function($cap) use ($category)
        {
           return $cap->category == $category;
        });

        $markup .= '<div class="capabilities-container">';
        $markup .= '<h5>';
        $markup .= '<strong><i class="fa fa-fw fa-check text-success"></i> '.$categoryLabel.'</strong>';
        $markup .= '<span class="pull-right"><a href="javascript:;" class="font12" data-toggle="select-capabilities">Select All</a></span>';
        $markup .= '</h5>';

        foreach ($categoryCapabilities as $capability)
        {
            $capabilityLabel = ucwords(str_replace('_', ' ', $capability->name));
            $markup .= '<div>';
            $markup .= '<label class="font-normal">';
            $markup .= Form::checkbox($name, $capability->id, in_array($capability->id, $selected), $options) . ' ' . $capabilityLabel;
            $markup .= '</label>';
            $markup .= '</div>';
        }
        $markup .= '</div>';
    }

    $markup .= '</div>';

    return $markup;
});
