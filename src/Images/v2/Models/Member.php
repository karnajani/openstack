<?php

namespace OpenStack\Images\v2\Models;

use OpenStack\Common\Resource\AbstractResource;
use OpenStack\Common\Resource\Creatable;
use OpenStack\Common\Resource\Deletable;
use OpenStack\Common\Resource\Listable;
use OpenStack\Common\Resource\Retrievable;
use OpenStack\Common\Resource\Updateable;

/**
 * @property \OpenStack\Images\v2\Api $api
 */
class Member extends AbstractResource implements Creatable, Listable, Retrievable, Deletable
{
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_PENDING  = 'pending';
    const STATUS_REJECTED = 'rejected';

    /** @var string */
    public $imageId;

    /** @var string */
    public $id;

    /** @var \DateTimeImmutable */
    public $createdAt;

    /** @var \DateTimeImmutable */
    public $updatedAt;

    /** @var string */
    public $schemaUri;

    /** @var string */
    public $status;

    protected $aliases = [
        'created_at' => 'createdAt',
        'updated_at' => 'updatedAt',
        'member_id'  => 'id',
        'image_id'   => 'imageId',
    ];

    public function create(array $userOptions)
    {
        $response = $this->executeWithState($this->api->postImageMembers());
        return $this->populateFromResponse($response);
    }

    public function retrieve()
    {
        $response = $this->executeWithState($this->api->getImageMember());
        $this->populateFromResponse($response);
    }

    public function delete()
    {
        $this->executeWithState($this->api->deleteImageMember());
    }

    public function updateStatus($status)
    {
        $this->status = $status;
        $this->executeWithState($this->api->putImageMember());
    }
}