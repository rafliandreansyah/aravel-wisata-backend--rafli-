<?php

namespace App\Enum;

enum ProductStatus: string
{
    case Draft = 'draft';
    case Publish = 'publish';
    case Archived = 'archived';
}
