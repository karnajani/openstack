<?php

namespace OpenStack\Identity\v3\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\Creatable;
use OpenStack\Common\Resource\Listable;

/**
 * @property \OpenStack\Identity\v3\Api $api
 */
class Role extends AbstractResource implements Creatable, Listable
{
    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var array */
    public $links;

    public function create(array $data)
    {
        $response = $this->execute($this->api->postRoles(), $data);
        $this->populateFromResponse($response);
        return $this;
    }
} 