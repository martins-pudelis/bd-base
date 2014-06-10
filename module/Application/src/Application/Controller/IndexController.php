<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use BdAuthentication\Service\AuthService;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
//        $sl = $this->getServiceLocator();
//
//        $config = $sl->get('Config');
//
//        /** @var AuthService $authService */
//        $authService = $sl->get('AuthService');
//
//        echo '<pre>';
//        var_dump($config['bd_configuration']);
//        if ($authService->getIdentity()) {
//            var_dump($authService->getIdentity()->getUsername());
//        }
//        echo '</pre>';
        return new ViewModel();
    }

    public function secretAction()
    {

    }

    public function asAction()
    {

    }
}
