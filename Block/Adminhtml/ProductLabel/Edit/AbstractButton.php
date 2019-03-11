<?php
/**
 *
 * @category  Smile
 * @package   Smile\ProductLabel
 * @author    Houda EL RHOZLANE <hoelr@smile.fr>
 * @copyright 2019 Smile
 */

namespace Smile\ProductLabel\Block\Adminhtml\ProductLabel\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Smile\ProductLabel\Api\ProductLabelRepositoryInterface;

/**
 * Adminhtml block: Abstract Button
 *
 * @category  Smile
 * @package   Smile\ProductLabel
 * @author    Houda EL RHOZLANE <hoelr@smile.fr>
 * @copyright 2019 Smile
 */
abstract class AbstractButton  implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var ProductLabelRepositoryInterface
     */
    protected $repository;

    /**
     * AbstractButton constructor.
     *
     * @param Context                         $context
     * @param ProductLabelRepositoryInterface $repository
     */
    public function __construct(
        Context $context,
        ProductLabelRepositoryInterface $repository
    ) {
        $this->context = $context;
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    abstract public function getButtonData();

    /**
     * Return object ID.
     *
     * @return int|null
     */
    public function getObjectId()
    {
        try {
            $modelId = (int) $this->context->getRequest()->getParam('product_label_id');

            /** @var \Smile\ProductLabel\Api\Data\ProductLabelInterface $model */
            $model = $this->repository->getById($modelId);

            return $model->getProductLabelId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters.
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
