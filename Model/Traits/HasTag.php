<?php

namespace TangoMan\FrontBundle\Model\Traits;

/**
 * Trait HasTag
 * Represents dom element with tag name, type, class, style,
 * attributes, data-attributes, aria role, and disabled attribute
 *
 * @requires TangoMan\FrontBundle\Model\Traits\HasTooltip
 * @package  TangoMan\FrontBundle\Model\Traits
 */
trait HasTag
{
    /**
     * Tag name
     * e.g.: input
     *
     * @var string
     */
    protected $tag;

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     *
     * @return $this
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }
}
