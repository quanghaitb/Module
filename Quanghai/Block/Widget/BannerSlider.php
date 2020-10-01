<?php
/**

 */

namespace Module\Quanghai\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class BannerSlider extends Template implements BlockInterface
{
    /**
     * @var \Module\Quanghai\Model\BannerFactory
     */
    protected $bannerFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Module\Quanghai\Model\BannerFactory $bannerFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Module\Quanghai\Model\BannerFactory $bannerFactory,
        array $data = []
    ) {
        $this->bannerFactory = $bannerFactory;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve the banners slider
     *
     * @param \Module\Quanghai\Model\Banner[]
     */
    public function getBanners()
    {
        $groupId = (int)$this->getGroupId();
        $collection = $this->bannerFactory->create()->getCollection()->addFieldToFilter(
            'id', $groupId
        )->addFieldToFilter(
            'status', \Module\Quanghai\Model\Banner::STATUS_ENABLED
        )->setOrder('main_table.order', 'ASC');
        return $collection;
    }
}
