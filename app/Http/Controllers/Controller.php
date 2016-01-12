<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];

    /**
     * Controller constructor.
     * @param array $data
     */
    public function __construct()
    {
        $this->data['meta'] = $this->metaDataCollection();

        view()->share($this->data);
    }

    private function metaDataCollection()
    {
        return [
            'page_meta_title' => config('settings.site_name', 'Amith Gotamey'),
            'page_meta_canonical' => null,
            'page_meta_description' => null,
            'page_title' => null,
        ];
    }

    protected function setMetaTitle($page_title = null, $meta_title = null, $description = null, $icon = null)
    {
        if ($meta_title && $meta_title != config('settings.site_name', 'Amith Gotamey')) {
            $this->data['meta']['page_meta_title'] = $meta_title . ' &#8211; ' . config('settings.site_name', 'Amith Gotamey');
        }
        if ($page_title) {
            if (!$meta_title) {
                $this->data['meta']['page_meta_title'] = $page_title . ' &#8211; ' . config('settings.site_name', 'Amith Gotamey');
            }
            $this->data['meta']['page_title'] = $page_title;
        }
        if ($description) {
            $this->data['meta']['page_meta_description'] = $description;
        }

        if ($icon) {
            $this->data['meta']['header_icon'] = $icon;
        }

        view()->share($this->data);
    }
}
