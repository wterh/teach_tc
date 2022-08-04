<?php
declare(strict_types=1);

return [
    /**
     * For cron
     */
    'check_redirects' => [
        'controller' => 'admin',
        'action' => 'checkRedirects',
    ],

    /**
     * Home page
     */
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    '/' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    'index.html' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    'index.php' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'knowledge' => [
        'controller' => 'main',
        'action' => 'knowledge',
    ],
    'knowledge/add' => [
        'controller' => 'main',
        'action' => 'addKnowledge',
    ],
    'knowledge/edit/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'editKnowledge',
    ],
    'knowledge/delete/{id:\d+}' => [
        'controller' => 'main',
        'action' => 'deleteKnowledge',
    ],
];