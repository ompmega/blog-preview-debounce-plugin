<?php namespace Ompmega\BlogPreviewDebounce;

use Backend;
use System\Classes\PluginBase;
use Event;

/**
 * BlogPreviewDebounce Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * {@inheritDoc}
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Blog Preview Debounce',
            'description' => 'Adds debounce capability to the blog preview.',
            'author'      => 'Ompmega',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function boot()
    {
        Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
            /** @var \Backend\Classes\Controller $controller */
            if (!$controller instanceof \RainLab\Blog\Controllers\Posts) {
                return;
            }

            if ($action !== 'create' && $action !== 'update') {
                return;
            }

            $controller->addJs('/plugins/ompmega/blogpreviewdebounce/assets/js/blog-preview-debounce.js');
        });
    }
}
