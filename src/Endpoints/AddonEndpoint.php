<?php

namespace GmodStore\API\Endpoints;

use GmodStore\API\Collection;
use GmodStore\API\Endpoint;
use GmodStore\API\Models\Addon;

class AddonEndpoint extends Endpoint
{
    protected static $endpointPath = 'addons';

    protected static $model = Addon::class;

    public function get($id = null)
    {
        $data = parent::get($id);
        $data = $data['data'] ?? [];
        $model = new Collection();

        if (empty($id) && !empty($data)) {
            foreach ($data as $addon) {
                $model[] = new self::$model($addon);
            }
        }

        if (!empty($id)) {
            $model = new self::$model($data);
        }

        return $model;
    }
}