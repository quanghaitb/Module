<?php
/**

 */

namespace Module\Quanghai\Controller\Adminhtml\Banner;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends \Magento\Backend\App\Action
{
    /** @var JsonFactory  */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $bannerId) {
                    /** @var \Module\Quanghai\Model\Banner $model */
                    $model = $this->_objectManager->create('Module\Quanghai\Model\Banner');
                    $model->load($bannerId);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$bannerId]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithBannerId(
                            $model,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add banner name to error message
     *
     * @param \Module\Quanghai\Model\Banner $banner
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithBannerId(\Module\Quanghai\Model\Banner $banner, $errorText)
    {
        return '[Banner ID: ' . $banner->getId() . '] ' . $errorText;
    }

    /**
     * Authorization level of a basic admin session
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Module_Quanghai::banner_create') ||
        $this->_authorization->isAllowed('Module_Quanghai::banner_update');
    }
}
