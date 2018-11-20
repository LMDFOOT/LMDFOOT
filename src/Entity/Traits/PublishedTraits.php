<?php

namespace App\Entity\Traits;

trait PublishedTraits {

    /**
     * @var boolean
     * @ORM\Column(type="boolean", options={"default": false})
     */
    protected $published = false;

    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }
}