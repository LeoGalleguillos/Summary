<?php
namespace LeoGalleguillos\Summary\Model\Entity;

use LeoGalleguillos\Image\Model\Entity\Image as ImageEntity;

class Summary
{
    /**
     * @var string
     */
    public $body;

    /**
     * @var int
     */
    public $summaryId;

    /**
     * @var ImageEntity
     */
    public $thumbnail;

    /**
     * @var string
     */
    public $title;
}
