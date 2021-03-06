<?php
/**
 * Functionality for the navigation tree
 *
 * @package PhpMyAdmin-Navigation
 */
declare(strict_types=1);

namespace PhpMyAdmin\Navigation\Nodes;

use PhpMyAdmin\Html\Generator;
use PhpMyAdmin\Navigation\NodeFactory;
use PhpMyAdmin\Url;

/**
 * Represents a container for index nodes in the navigation tree
 *
 * @package PhpMyAdmin-Navigation
 */
class NodeIndexContainer extends Node
{
    /**
     * Initialises the class
     */
    public function __construct()
    {
        parent::__construct(__('Indexes'), Node::CONTAINER);
        $this->icon = Generator::getImage('b_index', __('Indexes'));
        $this->links = [
            'text' => Url::getFromRoute('/table/structure', [
                'server' => $GLOBALS['server'],
                'db' => '%2\$s',
                'table' => '%1\$s',
            ]),
            'icon' => Url::getFromRoute('/table/structure', [
                'server' => $GLOBALS['server'],
                'db' => '%2\$s',
                'table' => '%1\$s',
            ]),
        ];
        $this->realName = 'indexes';

        $newLabel = _pgettext('Create new index', 'New');
        $new = NodeFactory::getInstance(
            'Node',
            $newLabel
        );
        $new->isNew = true;
        $new->icon = Generator::getImage('b_index_add', $newLabel);
        $new->links = [
            'text' => Url::getFromRoute('/table/indexes', [
                'server' => $GLOBALS['server'],
                'create_index' => 1,
                'added_fields' => 2,
            ]) . '&amp;db=%3$s&amp;table=%2$s',
            'icon' => Url::getFromRoute('/table/indexes', [
                'server' => $GLOBALS['server'],
                'create_index' => 1,
                'added_fields' => 2,
            ]) . '&amp;db=%3$s&amp;table=%2$s',
        ];
        $new->classes = 'new_index italics';
        $this->addChild($new);
    }
}
