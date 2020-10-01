<?php
/**

 */

namespace Module\Quanghai\Model\ResourceModel\Group;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'group_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Module\Quanghai\Model\Group', 'Module\Quanghai\Model\ResourceModel\Group');
    }
}
