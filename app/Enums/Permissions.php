<?php


namespace App\Enums;


use MiladRahimi\Enum\Enum;

class Permissions extends Enum
{
    const VIDEOS_INDEX = 'videos-index';
    const VIDEOS_CREATE = 'videos-create';
    const VIDEOS_UPDATE = 'videos-update';
    const VIDEOS_DELETE = 'videos-delete';

    const EVENTS_INDEX = 'events-index';
    const EVENTS_CREATE = 'events-create';
    const EVENTS_UPDATE = 'events-update';
    const EVENTS_DELETE = 'events-delete';

    const IMAGES_INDEX = 'images-index';
    const IMAGES_CREATE = 'images-create';
    const IMAGES_UPDATE = 'images-update';
    const IMAGES_DELETE = 'images-delete';

    const USERS_INDEX = 'users-index';
    const USERS_CREATE = 'users-create';
    const USERS_UPDATE = 'users-update';
    const USERS_DELETE = 'users-delete';

    const ADVERTISEMENTS_INDEX = 'advertisements-index';
    const ADVERTISEMENTS_CREATE = 'advertisements-create';
    const ADVERTISEMENTS_UPDATE = 'advertisements-update';
    const ADVERTISEMENTS_DELETE = 'advertisements-delete';

    const LOGS_INDEX = 'logs-index';

    const PAYMENTS_INDEX = 'payments-index';

    const REPORTS_INDEX = 'reports-index';
}
