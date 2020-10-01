<?php
/**

 */

namespace Module\Quanghai\Model\ResourceModel;

class Group extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('module_quanghai_group', 'id');
    }
}
