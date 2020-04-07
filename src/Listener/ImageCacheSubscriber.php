<?php

namespace App\Listener;

use App\Entity\Servant;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber{
    
    private $cacheManager;

    private $helper;

    public function __construct(CacheManager $cacheManager, UploaderHelper $helper)
    {
        $this->cacheManager = $cacheManager;
        $this->helper = $helper;
    }

    public function getSubscribedEvents()
    {
        return [
            'preRemove',
            'preUpdate'
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Servant) {
            return;
        }
        $this->cacheManager->remove($this->helper->asset($entity, 'imagefile'));
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if(!$entity instanceof Servant)
        {
            return;
        }
        if($entity->getImageFile() instanceof UploadedFile)
        {
            $this->cacheManager->remove($this->helper->asset($entity, 'imagefile'));
        }
    }

}