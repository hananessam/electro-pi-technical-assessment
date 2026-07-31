<?php

namespace Modules\Project\Enums;

enum ProjectStatus: string
{
    case Active = 'active';
    case Completed = 'completed';
    case Archived = 'archived';
}
