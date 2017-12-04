<?php
namespace App\Event;

use App\Entity\Player;
use App\Event\AppEvent;
use App\Event\PlayerEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PlayerSubscriber implements EventSubscriberInterface
{
    private $em;

    /**
     * PlayerSubscriber constructor.
     * @param $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::PLAYER_ADD => 'playerAdd',
            AppEvent::PLAYER_EDIT => 'playerEdit'
        );
    }

    public function playerAdd(PlayerEvent $playerEvent){
        $player = $playerEvent->getPlayer();
        /** @var $player Player */
        $player->setCreatedAt(new \DateTime('now'));
        $player->setUpdateAt(new \DateTime('now'));
        $this->em->persist($player);
        $this->em->flush();
        echo 'ok ajout player';
    }

    public function playerEdit(PlayerEvent $playerEvent){
        $player = $playerEvent->getPlayer();
        /** @var $player Player */
        $player->setUpdateAt(new \DateTime('now'));
        $player->setMoney($playerEvent->getMoney());
        $player->setExperience($playerEvent->getExp());

        $this->em->persist($player);
        $this->em->flush();
        echo 'ok ajout player';
    }

}