<?php

namespace Modules\Post\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.content'), function (Group $group) {
            $group->item('Colection', function (Item $item) {
                $item->icon('fa fa-newspaper-o');
                $item->weight(10);
                $item->route('admin.post.index');
                $item->authorize(
                    $this->auth->hasAnyAccess([
                        'admin.products.index',
                        'admin.categories.index',
                        'admin.attributes.index',
                        'admin.attribute_sets.index',
                        'admin.options.index',
                    ])
                );

            });
        });
    }
}
